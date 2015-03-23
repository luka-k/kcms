<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Categories extends MY_Model
{
	//Третий параметр параметры валидации и обработки для функции editors_post
	//Параметры валидации класса валидации codeignighter
	//+ можно указывать  функции php которые принимают один параметр
	//+ хочу расширить класс валмдации на две функции
	//url - автоматически подставлять значени поля в url если он пуст
	//и для обработки чекбоксов
	//вообще расширая класс валидации можно легко делать обработку любых данных
	//Параметр 'img' используется для обработки изображений
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
	
	//items_tree - дерево для списка элементов
	//item_tree - дерево для страницы редактирования элемента
	public $admin_left_column = array(
		"items_tree" => "categories_tree",
		"item_tree" => "categories_tree",
	);
	
	function __construct()
	{
        parent::__construct();
	}
	
	public function get_url($item)
	{
		$item_full_url = $this->make_full_url($item);
		$full_url = implode("/", array_reverse($item_full_url));
		$full_url = base_url().$full_url;
		return $full_url;		
	}
	
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