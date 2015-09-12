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
}