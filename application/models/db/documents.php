<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Documents class
*
* @package		kcms
* @subpackage	Models
* @category	    Documents
*/
class Documents extends MY_Model
{
	public $editors = array(
		'Основное' => array(
			'id' => array('id', 'hidden'),
			'name' => array('Заголовок', 'text', 'trim|htmlspecialchars|name', 'require'),
			'is_active' => array('Активна', 'checkbox'),
			'doc_type' => array('Тип', 'doc_type', '', ''),
			'manufacturer_id' => array('Производитель', 'select', '', ''),
			'document2category' => array('Категория', 'document2category', '', ''),
			'sort' => array('Сортировка', 'hidden'),
			'description' => array('Описание', 'tiny', 'trim')
		),
		'Файл' => array(
			'url' => array('ссылка', 'text', ''),
			'upload_file' =>  array('Загрузка файла', 'upload_file', 'upload_file'),
		),
		'Изображения' => array(
			'upload_image' => array('Загрузить изображение', 'image_gallery', 'img')
		),
	);
	
	public $admin_left_column = array(
		"items_tree" => "documents_tree", //дерево для списка элементов
		"item_tree" => "documents_tree", //дерево для страницы редактирования элемента
	);
	
	function __construct()
	{
        parent::__construct();
	}
	
	public function get_doc_by_manufacturer($id)
	{
		$result = $this->db->get_where($this->_table, array("manufacturer_id" => $id))->result();
		
		return $result;
	}
	
	public function get_by_filter($manufacturer_id, $category = FALSE, $doc_type = FALSE)
	{	
		if($category)
		{
			$category_parent = $this->table2table->get_parent_ids("category2category", "category_parent_id", "child_id", $category->id);
			if($category_parent[0] == 0)
			{
				$child_ids = $this->table2table->get_parent_ids("category2category", "child_id", "category_parent_id", $category->id);
				
				$documents_ids = array();
				if($child_ids) foreach($child_ids as $id)
				{
					$documents_ids = array_merge($documents_ids, $this->table2table->get_parent_ids("document2category", "document_id", "category_id", $id));
				}
			}
			else
			{
				$documents_ids = $this->table2table->get_parent_ids("document2category", "document_id", "category_id", $category->id);
			}
		}
		/*my_dump($manufacturer_id);
		my_dump($category);
		my_dump($documents_ids);*/

		$this->db->where("manufacturer_id", $manufacturer_id);
		if(!empty($documents_ids)) $this->db->where_in("id", $documents_ids);
		if($doc_type && $doc_type <> "all") $this->db->like("doc_type", $doc_type);
		$this->db->order_by('sort', 'asc');
		$documents = $this->db->get($this->_table)->result();
		
		//sort($documents);
		
		return $documents;
	}
		
	function prepare($item)
	{
		if(!empty($item))
		{
			$file = $this->files->get_item_by(array("object_id" => $item->id, "object_type" => "documents"));
			if($file)
			{
				$file = $this->files->prepare($file);
				$item->full_url = $file->full_url;
			}
			else
			{
				$item->full_url = $item->url;
			}
			
			$item->type_icon = 'pdf';

			if ($item->files && unserialize($item->files))
			{
				$item->type_icon = 'folder';
			} elseif (strstr($item->url, '.xls'))
			{
				$item->type_icon = 'xls';
			} elseif (strstr($item->url, '.doc'))
			{
				$item->type_icon = 'doc';
			}
			
			
			$item->images = $this->images->prepare_list($this->images->get_list(array('object_type' => 'documents', 'object_id' => $item->id)));
			
			$categories_ids = $this->table2table->get_parent_ids("document2category", "category_id", "document_id", $item->id);
			/*$parent_categories_ids = $this->table2table->get_parent_ids("category2category", "child_id", "category_parent_id", 0);
			$categories_ids = array_diff ($categories_ids, $parent_categories_ids);*/
			
			$item->categories = array();
	
			if($categories_ids)
			{
				$this->db->where_in("id", $categories_ids);
				$item->categories = $this->db->get("categories")->result();
			}
			return $item;
		}
	}
}