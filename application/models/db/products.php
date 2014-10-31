<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Products extends MY_Model
{
	public $editors = array(
		'Основное' => array(
			'id' => array('id', 'hidden', 'integer'),
			'parent_id' => array('Категория', 'select', 'integer'),
			'is_active' => array('Активна', 'checkbox', 'integer'),
			'name' => array('Заголовок', 'text', 'url', 'trim|required|htmlspecialchars'),
			'price' => array('Цена', 'text', 'trim|required|htmlspecialchars'),
			'description' => array('Описание', 'tiny', 'trim|htmlspecialchars')
		),
		'SEO' => array(
			'meta_title' => array('Meta title страницы', 'text', 'trim|htmlspecialchars'),
			'meta_keywords' => array('Ключевые слова страницы', 'text', 'trim|htmlspecialchars'),
			'meta_description' => array('Описание страницы', 'text', 'trim|htmlspecialchars'),
			'url' => array('url', 'text', 'trim|htmlspecialchars')		
		),
		'Изображения' => array(
			'upload_image' => array('Загрузить изображение', 'image_gallery', 'img')
		)
	);
	
	public $full_url = array();
	
	function __construct()
	{
        parent::__construct();
		$this->load->database();
	}
	
	public function get_url($url)
	{
		$this->categories->full_url = NULL;
		$item = $this->products->get_item_by(array("url" => $url));
		
		$this->categories->make_full_url($item);
		
		$this->categories->full_url[] = base_url();
		$full_url = implode("/", array_reverse($this->categories->full_url));
		return $full_url;		
	}
	
	public function get_urls($info)
	{
		foreach($info as $item)
		{
			$item->full_url = $this->get_url($item->url);
		}
		return $info;
	}
}
