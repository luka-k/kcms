<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//Модель работы с изображениями
class Menus extends MY_Model 
{
	public $top_menu = array();
	public $admin_menu = array();
	
    function __construct()
	{
        parent::__construct();
		$this->top_menu = array(
			"main" => array("Главная", base_url(), "0"),
			"catalog" => array("Каталог", base_url()."catalog", "0"),
			"cart" => array("Корзина", base_url()."cart", "0"),
			"wishlist" => array("Вишлист", base_url().'wishlist', "0")
		);			
	}
	
	public function set_active($menu, $active)
	{
		foreach ($menu as $key => $item)
		{
			if ($key == $active)
			{
				$item[2] = '1';
			}
			$menu[$key] = $item;
		}
		return $menu;
	}

}