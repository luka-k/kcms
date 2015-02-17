<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Products extends MY_Model
{
	public $editors = array(
		'Основное' => array(
			'id' => array('id', 'hidden', ''),
			'name' => array('Заголовок', 'text', 'trim|required|htmlspecialchars|name'),
			'parent_id' => array('Категория', 'select', 'integer'),
			'is_active' => array('Активна', 'checkbox', 'integer'),
			'is_new' => array('Новинка', 'checkbox', 'integer'),
			'is_good_buy' => array('Выгодное предложение', 'checkbox', 'integer'),
			'article' => array('Артикул', 'text', 'trim|required|htmlspecialchars'),
			'warrant' => array('Гарантия<br/><i>Пример: 1 год</i>', 'text', 'trim|htmlspecialchars'),
			'price' => array('Цена', 'text', 'trim|required|htmlspecialchars'),
			'discount' => array('Скидка<br/><i>В процентах</i>', 'text', 'trim|htmlspecialchars|max_length[2]'),
			'video' => array('Видео', 'text', ''),
			'short_description' => array('Краткое описание', 'tiny', ''),
			'description' => array('Описание', 'tiny-2', '')
		),
		'SEO' => array(
			'meta_title' => array('Meta title страницы', 'text', 'trim|htmlspecialchars'),
			'meta_keywords' => array('Ключевые слова страницы', 'text', 'trim|htmlspecialchars'),
			'meta_description' => array('Описание страницы', 'text', 'trim|htmlspecialchars'),
			'url' => array('url', 'text', 'trim|htmlspecialchars|substituted[name]')		
		),
		'Изображения' => array(
			'upload_image' => array('Загрузить изображение', 'image_gallery', 'img')
		),
		'Характеристики' => array(
			'characteristics' => array('Редактировать характеристики', 'characteristics', 'ch')
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
	}
	
	public function get_url($item)
	{
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
	
	function prepare($item, $cover = 1)
	{
		if(!empty($item))
		{
			if(!is_object($item)) $item = (object)$item;
			$item->full_url = $this->get_url($item);
			$item->img = $this->images->get_images(array('object_type' => 'products', 'object_id' => $item->id), $cover);
			$item = $this->set_sale_price($item);
			return $item;
		}			
	}	
}
