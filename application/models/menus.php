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
			"catalog" => array("Каталог", base_url(), 0, array(
				0 => array('Продавцы', base_url()."", 0),
				1 => array('Подрядчики', base_url()."", 0),
				2 => array('Производители', base_url()."", 0),			
			)),
			"shop" => array("Магазин", base_url()."shop", 0),
			"brigtbild" => array("bрайтbилd", base_url()."catalog", 0),
			"contact" => array("Контакты", base_url()."pages/blog", 0),
			"repository" => array("Складские остатки", base_url()."pages/blog", 0)
		);	

		$this->admin_menu = array(
			'main' => array("Главная", base_url()."admin/admin_main", 0),
			/*'parts' => array('Разделы', "#", 0, array(
				0 => array('Редактировать разделы', base_url()."admin/items/parts", 0),
				1 => array('Блог', base_url()."admin/items/blog", 0),
				2 => array('Новости', base_url()."admin/items/news", 0)
			)),*/
			'categories' => array('Каталог', "#", 0, array(
				0 => array('Категории', base_url()."admin/items/categories", 0),
				1 => array('Создать категорию', base_url()."admin/item/categories", 0),
				2 => array('Товары', base_url()."admin/items/products", 0),
				3 => array('Создать товар', base_url()."admin/item/products", 0)				
			)),
			'manufacturer' => array('Производители', base_url()."admin/items/manufacturer", 0),
			//'orders' => array('Заказы', base_url()."admin/orders", 0),
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