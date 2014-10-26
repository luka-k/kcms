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
			if(!empty($item->0)&&!empty($item->1))
			{
				$where = "{$name} BETWEEN {$item[0]} AND {$item[0]}";
				$this->db->where($where);
			}
			else
			{
				!empty($item->0)?$this->db->where("{$name} >", $item->0):$filters['attributes_range'][$name]->0 = "";
				!empty($item->1)?$this->db->where("{$name} <", $item->1):$filters['attributes_range'][$name]->1 = "";
			}	
		}
		/*//Ширина (их бы упростить еще бы надо как нить)

		if(!empty($filters['width_from'])&&!empty($filters['width_to']))
		{
			$where = "width BETWEEN {$filters['width_from']} AND {$filters['width_to']}";
			$this->db->where($where);
		}
		else
		{
			!empty($filters['width_from'])?$this->db->where('width >', $filters['width_from']):$filters['width_from'] = "";
			!empty($filters['width_to'])?$this->db->where('width <', $filters['width_to']):$filters['width_to'] = "";
		}
		//Высота
		if(!empty($filters['height_from'])&&!empty($filters['height_to']))
		{
			$where = "height BETWEEN {$filters['height_from']} AND {$filters['height_to']}";
			$this->db->where($where);
		}
		else
		{
			!empty($filters['height_from'])?$this->db->where('height >', $filters['height_from']):$filters['height_from'] = "";
			!empty($filters['height_to'])?$this->db->where('height <', $filters['height_to']):$filters['height_to'] = "";
		}
		//Глубина
		if(!empty($filters['depth_from'])&&!empty($filters['depth_to']))
		{
			$where = "depth BETWEEN {$filters['depth_from']} AND {$filters['depth_to']}";
			$this->db->where($where);
		}
		else
		{
			!empty($filters['depth_from'])?$this->db->where('depth >', $filters['depth_from']):$filters['depth_from'] = "";
			!empty($filters['depth_to'])?$this->db->where('depth <', $filters['depth_to']):$filters['depth_to'] = "";
		}	*/
	
		!empty($filters['color'])?$this->db->where('color', $filters['color']):$filters['color'] = "";
		!empty($filters['material'])?$this->db->where('material', $filters['material']):$filters['material'] = "";
		!empty($filters['finishing'])?$this->db->where('finishing', $filters['finishing']):$filters['finishing'] = "";
		!empty($filters['turn'])?$this->db->where('turn', $filters['turn']):$filters['turn'] = "";	
		
		return $filters;
	}
}
