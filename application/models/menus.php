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
			"about" => array("О компании", base_url()."pages/about", "0"),
			"price" => array("Услуги и цены", base_url()."pages/price", "0"),
			"works" => array("Наши работы", base_url()."pages/works", "0"),
			"consult" => array("Консультации", base_url()."pages/consult", "0"),
			"vacancy" => array("Вакансии", base_url()."pages/vacancy", "0"),
			"contacts" => array("Контакты", base_url()."pages/contacts", "0"),
		);	

		$this->admin_menu = array(
			'main' => array("Главная", base_url()."admin/admin_main", 0),
			'works' => array("Работы", base_url()."admin/pages/works", 0),
			'calculator' => array("Калькулятор", base_url()."admin/pages/calculator", 0),
			'partners' => array("Партнеры", base_url()."admin/pages/partners", 0),
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