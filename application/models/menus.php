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

		$this->admin_menu = array(
			'main' => array("Главная", base_url()."admin", 0),
			'articles' => array("Статьи", "#", 0, array(
				0 => array('Новости', base_url()."admin/content/items/articles/3", 0),
				1 => array('Блог', base_url()."admin/content/items/articles/1", 0),
				2 => array('Основные', base_url()."admin/content/items/articles/8", 0)
			)),
			'categories' => array('Каталог', "#", 0, array(
				0 => array('Категории', base_url()."admin/content/items/categories", 0),
				1 => array('Создать категорию', base_url()."admin/content/item/categories", 0),
				2 => array('Товары', base_url()."admin/content/items/products", 0),
				3 => array('Создать товар', base_url()."admin/content/item/products", 0)				
			)),
			'orders' => array('Заказы', base_url()."admin/admin_orders/", 0),
			'settings' => array('Настройки', "#", 0, array(
				0 => array('Настройки сайта', base_url()."admin/content/item/settings/1", 0),
				1 => array('Письма', base_url()."admin/mails", 0),
			)),
			'menus' => array('Меню', base_url()."admin/menu_module/menus", 0),
			'users' => array('Пользователи', base_url()."admin/content/items/users", 0)
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