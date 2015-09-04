<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//Модель работы с изображениями
class Menus extends MY_Model 
{
	public $top_menu = array();
	public $admin_menu = array();
	
    function __construct()
	{
        parent::__construct();

		$this->admin_menu = array(
			'main' => array("<i class='icon-home'></i>", base_url()."admin", 0),
			'articles' => array("Статьи", "#", 0, array(
				0 => array('Все статьи', base_url()."admin/content/items/articles/", 0),
				1 => array('О компании', base_url()."admin/content/items/articles/1", 0),
				2 => array('Новости', base_url()."admin/content/items/articles/3", 0)
			)),
			'categories' => array('Каталог', "#", 0, array(
				0 => array('Категории', base_url()."admin/content/items/categories", 0),
				1 => array('Создать категорию', base_url()."admin/content/item/edit/categories", 0),
				2 => array('Товары', base_url()."admin/content/items/products", 0),
				3 => array('Создать товар', base_url()."admin/content/item/edit/products", 0)				
			)),
			'modules' => array('Дополнительно', "#", 0, array(
				0 => array('Партнеры', base_url()."admin/content/items/partners", 0),
			)),
			'settings' => array('Настройки', "#", 0, array(
				0 => array('Настройки сайта', base_url()."admin/content/item/edit/settings/1", 0),
			)),
			'emails' => array('Рассылки', "#", 0, array(
				0 => array("Шаблоны", base_url()."admin/content/items/emails/2", 0),
				1 => array("Рассылки", base_url()."admin/mailouts_module/", 0),
				2 => array("Системные письма", base_url()."admin/content/items/emails/1", 0)
			)),
			'menus' => array('Меню', base_url()."admin/menu_module/menus", 0),
			'users' => array('Пользователи', "#", 0, array(
				0 => array('Пользователи', base_url()."admin/users_module/", 0),
				1 => array('Группы пользователей', base_url()."admin/content/items/users_groups/", 0)
			))
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