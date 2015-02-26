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
			"cambridge" => array("Cambridge", base_url()."category/cambridge", "0"),
			"ielts" => array("IELTS", base_url()."category/ielts", "0"),
			"pearson" => array("Pearson", base_url()."category/pearson", "0"),
			"study" => array("Study", base_url().'category/study', "0"),
			"book_store" => array("Book Store", base_url().'category/book-store', "0"),
		);	

		$this->admin_menu = array(
			'main' => array("Главная", base_url()."admin", 0),
			'articles' => array("Статьи", "#", 0, array(
				0 => array('Создать новую', base_url()."admin/content/item/articles/", 0),
				1 => array('Cambridge', base_url()."admin/content/items/articles/1", 0),
				2 => array('IELTS', base_url()."admin/content/items/articles/2", 0),
				3 => array('Pearson', base_url()."admin/content/items/articles/3", 0),
				4 => array('Study', base_url()."admin/content/items/articles/4", 0),
				5 => array('Book store', base_url()."admin/content/items/articles/5", 0),
				6 => array('Контакты', base_url()."admin/content/items/articles/6", 0)
			)),
			'news' => array('Новости', base_url()."admin/content/items/news/", 0,),
			'slider' => array('Slider', base_url()."admin/content/items/slider/", 0,),
			'settings' => array('Настройки', "#", 0, array(
				0 => array('Настройки сайта', base_url()."admin/content/item/settings/1", 0),
				1 => array('Письма', base_url()."admin/mails", 0),
			)),
			'menus' => array('Меню', base_url()."admin/menu_module/menus", 0),
			'users' => array('Пользователи', base_url()."admin/content/items/users", 0, array(
				0 => array('Группы пользователей', base_url()."admin/content/items/users_groups/", 0),
				1 => array('Пользователи', base_url()."admin/users_module", 0),
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