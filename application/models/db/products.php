<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Products extends MY_Model
{
	public $editors = array(
		'Основное' => array(
			'id' => array('id', 'hidden', ''),
			'parent_id' => array('Категория', 'select', 'integer'),
			'is_active' => array('Активна', 'checkbox', 'integer'),
			'new' => array('Новинка', 'checkbox', "null"),
			'name' => array('Заголовок', 'text', 'trim|required|htmlspecialchars|name'),
			'sku' => array('Артикул', 'text', 'trim|required|htmlspecialchars'),
			'number' => array('Номер на скриншоте', 'text', 'trim|required|htmlspecialchars'),
			'weight' => array('Вес', 'text', 'trim|htmlspecialchars'),
			'manufacturer' => array('Производитель', 'text', 'trim|required|htmlspecialchars'),
			'price' => array('Цена', 'text', 'trim|required|htmlspecialchars'),
			'discount' => array('Скидка', 'text', 'trim|htmlspecialchars|max_length[2]'),
			'description' => array('Описание', 'tiny', 'trim|htmlspecialchars'),
			'description_short' => array('Краткое описание', 'tiny', 'trim|htmlspecialchars')
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
		"items_tree" => "products_tree",
		"item_tree" => "products_tree",
	);
	
	function __construct()
	{
        parent::__construct();
		$this->load->database();
	}
	
	public function get_url($item)
	{
		//$item = $this->products->get_item_by(array("url" => $url));
		
		$item_full_url = $this->categories->make_full_url($item);
		
		$full_url = implode("/", array_reverse($item_full_url));
		$full_url = base_url().$full_url;
		return $full_url;		
	}
	
	public function set_sale_price($item)
	{
		if(!empty($item->discount))
		{
			$item->sale_price = $item->price*(100 - $item->discount)/100;
		}	
		return $item;
	}
	
	function prepare($item)
	{
		if(!is_object($item)) $item = (object)$item;
		if(isset($item->id))
		{
			$item->img = $this->images->get_images(array('object_type' => 'products', 'object_id' => $item->id), 1, "product");
			$item->imgs = $this->images->get_images(array('object_type' => 'products', 'object_id' => $item->id), false);
			if(isset($item->url)) $item->full_url = $this->get_url($item);
			$item = $this->set_sale_price($item);
		}
		return $item;
			
	}
}
