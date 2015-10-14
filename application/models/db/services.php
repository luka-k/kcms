<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Services class
*
* @package		kcms
* @subpackage	Models
* @category	    Services
*/
class Services extends MY_Model
{
	public $editors = array(
		'Основное' => array(
			'id' => array('id', 'hidden'),
			'name' => array('Заголовок', 'text', 'trim|htmlspecialchars|name', 'require'),
			'parent_id' => array('Родитель', 'select'),
			'is_active' => array('Активна', 'checkbox'),
			'sort' => array('Сортировка', 'text')
		),
		'SEO' => array(
			'url' => array('url', 'text', 'trim|htmlspecialchars|substituted[name]'),
			'meta_title' => array('Meta title страницы', 'text', 'trim|htmlspecialchars'),
			'meta_keywords' => array('Ключевые слова страницы', 'text', 'trim|htmlspecialchars'),
			'meta_description' => array('Описание страницы', 'text', 'trim|htmlspecialchars'),
			'seo_text' => array('seo_text', 'tiny')
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
	
	function prepare($item)
	{
		$item->img = $this->images->get_cover(array('object_type' => 'services', 'object_id' => $item->id));
		return $item;
	}
}