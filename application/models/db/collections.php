<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Collections class
*
* @package		kcms
* @subpackage	Models
* @category	    Collections
*/
class Collections extends MY_Model
{
	/**
	* $editors = array(
	* 	"Наименование вкладки в админке" = array(
	*		"имя поля в базе" => array("Наименование поля для отображения", "наименования отображения", "условия для функции editors_post()", "условия для js валидации")
	*	)
	* )
	* 
	* "условия для функции editors_post" - функции php принимающие на вход один параметр + функции из библиотеки My_form_validation
	*
	* "условия для js валидации" - поддерживается три условия
	*	reqiure - обязателоно для заполнения
	*	email - коректный email
	*	matches[имя поля] - совпадение со значением поля имя которого указано
	* можно указывать сразу несколько условий разделяя их вертикальной чертой - |
	* валидация функцией editors_post убрана полность. 
	* позднее расширю js валидацию.
	*/
	public $editors = array(
		'Основное' => array(
			'id' => array('id', 'hidden'),
			'name' => array('Заголовок', 'text', 'trim|htmlspecialchars|name', 'require'),
			'parent_id' => array('Родительская категория', 'select'),
			'manufacturer_id' => array('Производитель', 'select'),
			'is_collection' => array('Колекция', 'checkbox'),
			'sort' => array('Сортировка', 'text'),
			'description' => array('Описание', 'tiny')
		),
		'SEO' => array(
			'meta_title' => array('Meta title страницы', 'text', 'trim|htmlspecialchars'),
			'meta_keywords' => array('Ключевые слова страницы', 'text', 'trim|htmlspecialchars'),
			'meta_description' => array('Описание страницы', 'text', 'trim|htmlspecialchars'),
			'url' => array('url', 'text', 'trim|htmlspecialchars|substituted[name]'),
			'changefreq' => array('changefreq', 'text'),
			'priority' => array('priority', 'priority'),
			'lastmod' => array('lastmod', 'hidden')
		)
	);
	
	public $admin_left_column = array(
		'items_tree' => 'collections_tree',
		'item_tree' => 'collections_tree',
	);
	
	function __construct()
	{
        parent::__construct();
	}
	
	/**
	*
	*/
	public function get_tree($ids = FALSE, $selected = array())
	{
		if(!$ids) $ids = $this->catalog->get_products_ids($this->products->get_list(FALSE));

		$filtred_ids = array();
		
		$this->db->where_in('child_id', $ids);
		$result = $this->db->get('product2collection')->result();
		foreach($result as $r)
		{
			$filtred_ids[] = $r->collection_parent_id;
		}
		
		$tree = $this->_get_tree(0, $filtred_ids, $selected);
		
		return $tree;
	}
	
	private function _get_tree($parent_id, $filtred_ids, $selected)
	{
		if(!isset($selected['collection_checked'])) $selected['collection_checked'] = array();//костыли костылики
		
		/*$this->db->where('parent_id', $parent_id);
		$this->db->order_by('name', 'asc');
		$this->db->order_by('manufacturer_id', 'asc');
		$this->db->order_by('is_collection', 'asc');
		$branches = $this->db->get()-.result();*/
		$branches = $this->get_list(array('parent_id' => $parent_id), FALSE, FALSE, 'name', 'asc');
		
		$branches = $this->prepare_list($branches);

		if ($branches) foreach ($branches as $i => $b)
		{
			$sub_tree = $this->_get_tree($b->id, $filtred_ids, $selected);
			if(!empty($sub_tree) || in_array($b->id, $filtred_ids) || in_array($b->id, $selected['collection_checked']))
			{
				$branches[$i]->childs = $sub_tree;
			}
			else
			{
				unset($branches[$i]);
			}
		}		
		return $branches;
	}
                                                                                                                                                       
	function prepare($item)
	{
		return $item;
	}
}