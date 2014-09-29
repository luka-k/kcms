<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//Модель работы с изображениями
class Menus extends MY_Model 
{
	public $top_menu = array();
	public $admin_menu = array();
	
    function __construct()
	{
        parent::__construct();
		$total_price = "0";
		$this->top_menu = array(
			"registration" => array("<span class='chec'>Log in/Register</span>", base_url()."pages/news", "0"),
			"help" => array("Help", base_url()."pages/news", "0"),
			"sitemap" => array("Sitemap", base_url()."catalog", "0"),
			"contact_us" => array("Contact us", base_url()."pages/blog", "0"),
			"cart" => array("Cart <span class='chec'><span class='total_qty'></span></span> items <span class='chec'><span class='total_price'></span> €</span>", base_url()."pages/blog", "0"),
			"checkout" => array("<span class='chec'>Checkout</span>", base_url()."pages/blog", "0"),
		);	
		
		$this->footer_menu = array(
			"home" => array("Home", base_url(), "0"),
			"catologue" => array("Catologue", base_url()."catalog", "0"),
			"order_and_delivery" => array("Order and Delivery", base_url()."catalog", "0"),
			"contact_us" => array("Contact us", base_url()."pages/blog", "0"),
			"about_us" => array("About us", base_url()."pages/blog", "0"),
			"registration" => array("<span class='chec'>Log in/Register</span>", base_url()."pages/news", "0"),
			"cart" => array("Cart <span class='chec'><span class='total_qty'></span></span> items <span class='chec'><span class='total_price'></span> €</span>", base_url()."pages/blog", "0"),
			"checkout" => array("<span class='chec'>Checkout</span>", base_url()."pages/blog", "0"),
		);	
		
		$this->admin_menu = array(
			'main' => array("Главная", base_url()."admin/admin_main", 0),
			'parts' => array('Разделы', "#", 0, array(
				0 => array('Редактировать', base_url()."admin/items/parts", 0),
				1 => array('Страницы', base_url()."admin/pages", 0)
			)),
			'categories' => array('Каталог', "#", 0, array(
				0 => array('Категории', base_url()."admin/items/categories", 0),
				1 => array('Создать категорию', base_url()."admin/item/categories", 0),
				2 => array('Товары', base_url()."admin/items/products", 0),
				3 => array('Создать товар', base_url()."admin/item/products", 0)				
			)),
			'orders' => array('Заказы', base_url()."admin/orders", 0),
			'settings' => array('Настройки', "#", 0, array(
				0 => array('Настройки сайта', base_url()."admin/settings", 0),
				1 => array('Письма', base_url()."admin/mails", 0),
			)),
			'users' => array('Пользователи', base_url()."admin/users", 0)
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