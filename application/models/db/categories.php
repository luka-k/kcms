<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Categories class
*
* @package		kcms
* @subpackage	Models
* @category	    Categories
*/
class Categories extends MY_Model
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
	* валидация функцией editors_post убрана полность. 
	* позднее расширю js валидацию.
	*/	
	public $editors = array(
		'Основное' => array(
			'id' => array('id', 'hidden'),
			'name' => array('Заголовок', 'text', 'trim|htmlspecialchars|name', 'require'),
			'parent_id' => array('Родительская категория', 'select'),
			'is_active' => array('Активен', 'checkbox'),
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
		),
		'Изображения' => array(
			'upload_image' => array('Загрузить изображение', 'image', 'img')
		)
	);
	
	public $admin_left_column = array(
		"items_tree" => "categories_tree", //дерево для списка элементов
		"item_tree" => "categories_tree", //дерево для страницы редактирования элемента
	);
	
	function __construct()
	{
        parent::__construct();
	}
	
	/**
	* Удаление категории
	* 
	* @param integer $id
	* @return bool
	*/
	public function delete($id)
	{
		$this->db->where("id", $id);
		$this->db->delete($this->_table);
		
		$this->db->where("parent_id", $id);
		$this->db->delete("products");
		
		$sub_categories = $this->get_list(array("parent_id" => $id));
		if($sub_categories) foreach($sub_categories as $item)
		{
			$this->delete($item->id);
		}
	}
	
	/**
	* Получение url категории
	*
	* @param object $item
	* @return string
	*/
	public function get_url($item)
	{
		$item_full_url = $this->make_full_url($item);
		$full_url = implode("/", array_reverse($item_full_url));
		$full_url = base_url().$full_url;
		return $full_url;		
	}
	
	/**
	* Формирование полного url к категории
	*
	* @param object $item
	* @return array
	*/
	public function make_full_url($item)
	{
		$item_url = array();
		$item_url[] = $item->url;
		while($item->parent_id <> 0)
		{
			$parent_id = $item->parent_id;
			$item = $this->get_item($parent_id);
			$item_url[] = $item->url;
		}
		$item_url[] = 'catalog';
		return $item_url;
	}	
	
	/**
	* 
	*
	* @param object $item
	* @return object
	*/
	function prepare($item)
	{
		if(!empty($item))
		{
			$item->img = $this->images->get_cover(array('object_type' => 'categories', 'object_id' => $item->id));
			$item->full_url = $this->get_url($item);
			return $item;
		}
	}
}