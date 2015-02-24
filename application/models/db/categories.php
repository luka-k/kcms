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
		$sub_products = $this->products->get_list(array("parent_id" => $id, "is_active" => 1));
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
		
		if($this->uri->segment(1) == $this->CI->config->item('works_url')) $stop_parent_id = $this->CI->config->item('works_id');
		if($this->uri->segment(1) == $this->CI->config->item('catalog_url')) $stop_parent_id = $this->CI->config->item('catalog_id');
		if(!$this->uri->segment(1)) $stop_parent_id = $this->CI->config->item('works_id');
		
		

		while($item->parent_id <> $stop_parent_id)
		{
			$parent_id = $item->parent_id;
			$item = $this->get_item($parent_id);
			$item_url[] = $item->url;
		}
		
		//Это костыль, но я пока не придумал лучше способа различать двери в каталоге и двери в наших работах.
		//вообще надо бы закрыть глюк возникающий при одинаковых урлах.
		//мысли у меня есть на днях о пробую потому что это актуально.
		$item_url[] = $this->uri->segment(1) ? $this->uri->segment(1) : $this->config->item('works_url');
		return $item_url;
	}	
	
	function prepare($item)
	{
		if(!empty($item))
		{
			$item->img = $this->images->get_images(array('object_type' => 'categories', 'object_id' => $item->id));
			$item->full_url = $this->get_url($item);
			return $item;
		}
	}
}