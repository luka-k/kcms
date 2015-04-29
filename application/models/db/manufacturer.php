<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manufacturer extends MY_Model
{
	public $editors = array(
		'Основное' => array(
			'id' => array('id', 'hidden'),
			'name' => array('Заголовок', 'text', "name"),
			'url' => array('Url', 'text'),
			'phone' => array('Телефон', 'text'),
			'link' => array('Ссылка на сайт', 'text')
		),		
		'Изображения' => array(
			'upload_image' => array('Загрузить изображение', 'upload_image', "unset"),
			'view_image' => array('Изображение', 'view_image', "unset")
		)
	);
	
	function __construct()
	{
        parent::__construct();
		$this->load->database();
	}
	
	public function get_tree($products = FALSE)
	{
		if(!$products) $products = $this->products->get_list(FALSE);
		
		$m_ids = array();
		$sku = array();
		foreach($products as $p)
		{
			$m_ids[] = $p->manufacturer_id;
			$sku[$p->manufacturer_id][] = $p->sku;
		}
		
		foreach($sku as $i => $articls)
		{
			asort($articls, SORT_STRING);
			$sku[$i] = $articls;
		}
		
		
		$manufacturer = array();
		$this->db->order_by("name", "asc"); 
		$this->db->where_in("id", array_unique($m_ids));
		$manufacturer = $this->db->get($this->_table)->result();
		
		foreach($manufacturer as $i => $m)
		{
			$manufacturer[$i]->sku = $sku[$m->id];
		}
		return $manufacturer;
	}
}