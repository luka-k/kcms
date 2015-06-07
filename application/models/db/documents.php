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
				$item->full_url = $file->url;
			}
			return $item;
		}
	}
}