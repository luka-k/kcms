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
			"news" => array("Новости", base_url()."pages/news", "0"),
			"catalog" => array("Каталог", base_url()."catalog", "0"),
			"blog" => array("Блог", base_url()."pages/blog", "0"),
		);	

		$this->admin_menu = array(
			'main' => array("Главная", base_url()."admin/admin_main", 0),
			'parts' => array('Разделы', "#", 0, array(
				0 => array('Редактировать', base_url()."admin/parts/0", 0),
				1 => array('Страницы', base_url()."admin/pages", 0)
			)),
			'catalog' => array('Каталог', "#", 0, array(
				0 => array('Категории', base_url()."admin/categories", 0),
				1 => array('Создать категорию', base_url()."admin/category", 0),
				2 => array('Товары', base_url()."admin/cat_pages", 0),
				3 => array('Создать товар', base_url()."admin/cat_page", 0)				
			)),
			'settings' => array('Настройки', base_url()."admin/settings", 0),
			'users' => array('Пользователи', base_url()."registration/users", 0)
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