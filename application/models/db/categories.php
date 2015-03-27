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
	public $editors = array(
		'Основное' => array(
			'id' => array('id', 'hidden', ''),
			'name' => array('Заголовок', 'text', 'trim|required|htmlspecialchars|name'),
			'parent_id' => array('Родительская категория', 'select', ''),
			'is_active' => array('Активен', 'checkbox', 'integer'),
			'sort' => array('Сортировка', 'text', ''),
			'description' => array('Описание', 'tiny', '')
		),
		'SEO' => array(
			'meta_title' => array('Meta title страницы', 'text', 'trim|htmlspecialchars'),
			'meta_keywords' => array('Ключевые слова страницы', 'text', 'trim|htmlspecialchars'),
			'meta_description' => array('Описание страницы', 'text', 'trim|htmlspecialchars'),
			'url' => array('url', 'text', 'trim|htmlspecialchars|substituted[name]'),
			'changefreq' => array('changefreq', 'text', ''),
			'priority' => array('priority', 'priority', ''),
			'lastmod' => array('lastmod', 'hidden', '')
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