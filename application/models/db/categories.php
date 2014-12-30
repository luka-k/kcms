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
			'upload_image' => array('Загрузить изображение', 'image', 'img')
		)
	);
	
	private $sub_products= array();
	
	function __construct()
	{
        parent::__construct();
		$this->load->database();
	}
	
	public function url_parse($segment_number, $parent = FALSE)
	{
		$url = $this->uri->segment($segment_number);
		
		if(!$url) return FALSE;
		
		$child = $this->get_item_by(array('url' => $url, 'parent_id' => isset($parent->id) ? $parent->id : 0));
		if(!$child)
		{
			
			$product = $this->products->get_item_by(array('url' => $url));
			if ($product)
			{
				$this->breadcrumbs->add($url, $product->name);
				$parent->product = $product;
				return $parent;
			}
			else
			{
				return '404';
			}
		}
		else
		{
			$this->add_active($child->id);
			$this->breadcrumbs->add($url, $child->name);
			$child->parent = $parent;
		
			if ($this->uri->segment($segment_number+1))
			{
				return $this->url_parse($segment_number + 1, $child);
			}
			else 
			{
				$child->products = $this->get_sub_products($child->id);
				var_dump($child);
				return $child;
				
			}		
		}	
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
	
	public function get_url($url)
	{
		$item = $this->get_item_by(array("url" => $url));
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
			$item = $this->get_item_by(array("id" => $parent_id));
			$item_url[] = $item->url;
		}
		$item_url[] = 'catalog';
		return $item_url;
	}	
	
	function prepare($item)
	{
		$item->img = $this->images->get_images(array('object_type' => 'categories', 'object_id' => $item->id), "catalog_mid", "1");
		$item->full_url = $this->get_url($item->url);
		return $item;
	}
}