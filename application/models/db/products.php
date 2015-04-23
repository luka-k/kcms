<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Products extends MY_Model
{
	public $editors = array(
		'Основное' => array(
			'id' => array('id', 'hidden'),
			'parent_id' => array('Категория', 'select_2'),
			'manufacturer_id' => array('Производитель', 'select_3'),
			'is_active' => array('Активна', 'checkbox'),
			'name' => array('Заголовок', 'text', 'url'),
			'article' => array('Ариткул', 'text'),
			'collection' => array('Колекция', 'text'),
			'price' => array('Цена', 'text'),
			'discount' => array('Скидка', 'text'),
			'location' => array('Наличие', 'text'),
			'description' => array('Описание', 'tiny')
		),
		'Характеристики' => array(
			'width' => array('Ширина', 'text'),
			'height' => array('Высота', 'text'),
			'depth' => array('Глубина', 'text'),
			'color' => array('Цвет', 'text'),
			'material' => array('Материал', 'text'),
			'finishing' => array('Отделка', 'text'),
			'turn' => array('Разворот', 'text'),
		),
		'Изображения' => array(
			'upload_image' => array('Загрузить изображение', 'upload_image'),
			'view_image' => array('Изображение', 'view_image')
		),
		'SEO' => array(
			'meta_title' => array('Meta title страницы', 'text'),
			'meta_keywords' => array('Ключевые слова страницы', 'text'),
			'meta_description' => array('Описание страницы', 'text'),
			'url' => array('url страницы', 'text')		
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
		
		$full_url = implode("/", array_reverse($this->categories->full_url));
		$full_url = base_url().$full_url;
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
	
	public function set_filters($filters)
	{
		if(!empty($filters['categories_checked'])) 
		{
			$this->db->where_in('parent_id', $filters['categories_checked']);
		}
		
		
		if(!empty($filters['manufacturer_checked'])) $this->db->where_in('manufacturer_id', $filters['manufacturer_checked']);
		
		
		if(!empty($filters['collection_checked'])) $this->db->where_in('collection', $filters['collection_checked']);
		if(!empty($filters['sku_checked'])) $this->db->where_in('article', $filters['sku_checked']);
		if(!empty($filters['color_checked'])) $this->db->where_in('color', $filters['color_checked']);
		if(!empty($filters['material_checked'])) $this->db->where_in('material', $filters['material_checked']);
		
		
		$this->range_filter("width", $filters['width_from'], $filters['width_to']);
		$this->range_filter("height", $filters['height_from'], $filters['height_to']);
		$this->range_filter("depth", $filters['depth_from'], $filters['depth_to']);
		
		$this->attributes_filter("color", $filters['color']);
		$this->attributes_filter("material", $filters['material']);
		$this->attributes_filter("finishing", $filters['finishing']);
		$this->attributes_filter("turn", $filters['turn']);
		
		$this->like_filter("collection", $filters['collection']);
		$this->like_filter("article", $filters['article']);
		$this->like_filter("name", $filters['name']);
		$this->like_filter("description", $filters['description']);
		
		return $filters;
	}
	
	private function range_filter($param, $item_from, $item_to)
	{
		$item_from = trim($item_from);
		$item_to = trim($item_to);
		if(!empty($item_from)&&!empty($item_to))
		{
			$where = "{$param} BETWEEN {$item_from} AND {$item_to}";
			$this->db->where($where);
		}
		else
		{
			if(!empty($item_from)) $this->db->where("{$param} >", $item_from);
			if(!empty($item_to))$this->db->where("{$param} <", $item_to);
		}	
	}
	
	private function attributes_filter($param, $item)
	{
		if(!empty($item)) $this->db->where("{$param}", $item);
	}
	
	private function like_filter($param, $item)
	{
		$this->db->like($param, $item);
	}
}
