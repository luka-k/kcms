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
			'url' => array('url', 'text', 'trim|htmlspecialchars|substituted[name]')
		),
		'Изображения' => array(
			'upload_image' => array('Загрузить изображение', 'image_gallery', 'img')
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
	
	public function get_sub_products($id)
	{
		$this->sub_products = array();
		$sub_products = $this->products->get_list(array("parent_id" => $id, "is_active" => 1), 0, 0, 'name');
		if($sub_products) foreach($sub_products as $product_item)
		{
			$this->sub_products[] = $product_item;
		}
		
		$this->_sub_products($id);	
		return $this->sub_products;
	}
	
	//Возвращает товары из всех подкатегорий категории
	function _sub_products($id)
	{
		$sub_categories = $this->categories->get_list(array("parent_id" => $id));
		
		if($sub_categories )foreach($sub_categories as $item)
		{
			$sub_products = $this->products->get_list(array("parent_id" => $item->id, "is_active" => 1));
			if($sub_products) foreach($sub_products as $product_item)
			{
				$this->sub_products[] = $product_item;
			}
			$this->_sub_products($item->id);
		}
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
		
		$root = array(
			$this->config->item('works_id') => $this->config->item('works_url'),
			$this->config->item('catalog_id') => $this->config->item('catalog_url')
		);

		$iterator = 0;
		while($iterator < 15 && !array_key_exists($item->parent_id, $root))
		{
			$parent_id = $item->parent_id;
			$item = $this->get_item($parent_id);
			$item_url[] = $item->url;
			$iterator++;
		}

		$item_url[count($item_url)] = $root[$item->parent_id];
		if($this->uri->segment(1) == "articles") $item_url[count($item_url)-1] = "articles";

		return $item_url;
	}	
	
	function prepare($item)
	{
		if(!empty($item))
		{
			$imgs = $this->images->get_images(array('object_type' => 'categories', 'object_id' => $item->id));
			if ($imgs[0]->is_cover)
			{
				$item->img[0] = $imgs[0];
				$item->img[1] = $imgs[1];
			} else {
				$item->img[1] = $imgs[0];
				$item->img[0] = $imgs[1];
			}
			$item->full_url = $this->get_url($item);
			return $item;
		}
	}
}