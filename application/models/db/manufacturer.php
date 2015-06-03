<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manufacturer extends MY_Model
{
	public $editors = array(
		'Основное' => array(
			'id' => array('id', 'hidden'),
			'name' => array('Заголовок', 'text', "name"),
			'is_active' => array('Включено', 'checkbox'),
			'phone' => array('Телефон', 'text'),
			'email' => array('email', 'text'),
			'country' => array('Страна', 'text'),
			'city' => array('city', 'text'),
			'link' => array('Ссылка на сайт', 'text'),
			'manufacturer2category' => array('Категория', 'manufacturer2category'),
			'manufacturer2categorygoods' => array('Категория товаров', 'manufacturer2category'),
			'manufacturer2manufacturer' => array('Продавцы', 'manufacturer2manufacturer'),
		),	
		'SEO' => array(
			'meta_title' => array('Meta title страницы', 'text', 'trim|htmlspecialchars'),
			'meta_keywords' => array('Ключевые слова страницы', 'text', 'trim|htmlspecialchars'),
			'meta_description' => array('Описание страницы', 'text', 'trim|htmlspecialchars'),
			'url' => array('Url', 'text'),
			'seo_text' => array('seo_text', 'tiny'),
		),		
		'Изображения' => array(
			'upload_image' => array('Загрузить изображение', 'image', 'img')
		)
	);
	
	function __construct()
	{
        parent::__construct();
		$this->load->database();
	}
	
	public function get_tree($products = FALSE, $selected = array())
	{
		if(!$products) $products = $this->products->get_list(FALSE);
		
		$manufacturer = array();
		$m_ids = array();
		$sku = array();
		
		if($products)
		{
			foreach($products as $p)
			{
				$m_ids[] = $p->manufacturer_id;
				$sku[$p->manufacturer_id][] = $p->sku;
			}
		
			if(isset($selected['manufacturer_checked'])) array_merge($m_ids, $selected['manufacturer_checked']);
		
			foreach($sku as $i => $articls)
			{
				asort($articls, SORT_STRING);
				$sku[$i] = $articls;
			}
		
		
			$this->db->order_by("name", "asc"); 
			if(!empty($m_ids)) $this->db->where_in("id", array_unique($m_ids));
			$manufacturer = $this->db->get($this->_table)->result();
		
			if(isset($selected["sku_checked"])) foreach($selected["sku_checked"] as $sk)
			{	
				$product = $this->products->get_item_by(array("sku" => $sk));	
				$sku[$product->manufacturer_id][] = $sk; 
			}
		
			foreach($manufacturer as $i => $m)
			{
				$manufacturer[$i]->sku = $sku[$m->id];
			}
		}
		return $manufacturer;
	}
	
	public function prepare($item)
	{
		if(!empty($item))
		{
			$item->img = $this->images->get_cover(array('object_type' => 'manufacturer', 'object_id' => $item->id));
			return $item;
		}
	}
}