<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu extends MY_Model
{
	public $editors = array(
		'Основное' => array(
			'id' => array('id', 'hidden'),
			'name' => array('Заголовок', 'text', 'name'),
			'manufacturer_id' => array('Поставщик', 'select'),
			'school_id' => array('Школа', 'select')
		)	
	);
	
	function __construct()
	{
        parent::__construct();
	}
	
	public function get_menu_by_school($school_id)
	{
		$menu = $this->menu->get_item_by(array('school_id' => $school_id));
	
		$menu->categories = $this->categories->get_list(array('menu_id' => $menu->id));
		
		foreach($menu->categories as $i => $category)
		{
			$menu->categories[$i]->products = $this->products->get_list(array('category_id' => $category->id) );
		}
		
		return $menu;
	}
	
	public function get_products_by_menu($menu_id)
	{
		$products = array();
		$result = $this->db->get_where('categories', array('menu_id' => $menu_id))->result();
		
		if(!empty($result))
		{
			$categories_ids = array();
			foreach($result as $r)
			{
				$categories_ids[] = $r->id;
			}
		
			$this->db->where_in('category_id', $categories_ids);
			$products = $this->db->get('products')->result();
		}
		
		return $products;
	}
}