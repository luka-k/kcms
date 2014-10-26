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
	
	public function set_filters($filters)
	{
		if(!empty($filters['categories_checked'])) $this->db->where_in('parent_id', $filters['categories_checked']);
		if(!empty($filters['manufacturer_checked'])) $this->db->where_in('manufacturer_id', $filters['manufacturer_checked']);
		
		foreach($filters['attributes_range'] as $name => $item)
		{
			if(!empty($item->from)&&!empty($item->to))
			{
				$where = "{$name} BETWEEN {$item->from} AND {$item->to}";
				$this->db->where($where);
			}
			else
			{
				!empty($item->from)?$this->db->where("{$name} >", $item->from):$filters['attributes_range'][$name]->from = "";
				!empty($item->to)?$this->db->where("{$name} <", $item->to):$filters['attributes_range'][$name]->to = "";
			}	
		}
		
		foreach($filters['attributes'] as $name => $item)
		{
			!empty($item)?$this->db->where("{$name}", $item):$filters['color'] = "";
		}
		
		return $filters;
	}
}
