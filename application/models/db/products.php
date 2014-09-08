<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Products extends MY_Model
{
	public $editors = array(
		'Основное' => array(
			'id' => array('id', 'hidden'),
			'parent_id' => array('Категория', 'select'),
			'is_active' => array('Активна', 'checkbox'),
			'title' => array('Заголовок', 'text'),
			'price' => array('Цена', 'text'),
			'description' => array('Описание', 'tiny'),
			'publish_date' => array('Дата публикации', 'hidden')
		),
		'SEO' => array(
			'meta_title' => array('Meta title страницы', 'text'),
			'meta_keywords' => array('Ключевые слова страницы', 'text'),
			'meta_description' => array('Описание страницы', 'text'),
			'url' => array('url страницы', 'text')		
		)
	);
	
	private $full_url = array();
	
	function __construct()
	{
        parent::__construct();
		$this->load->database();
	}
	
	public function get_url($url)
	{
		$this->full_url = NULL;
		$item = $this->products->get_item_by(array("url" => $url));
		$this->make_full_url($item);
		$this->full_url[] = base_url();
		$full_url = implode("/", array_reverse($this->full_url));
		return $full_url;		
	}
	
	private function make_full_url($item)
	{
		$this->full_url[] = $item->url;
		if ($item->parent_id <> 0)
		{
			$item = $this->categories->get_item_by(array("id" => $item->parent_id));
			$this->make_full_url($item);
		}
		else
		{
			$this->full_url[] = 'catalog';
		}
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