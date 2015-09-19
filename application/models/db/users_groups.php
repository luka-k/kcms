<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Users_groups class
*
* @package		kcms
* @subpackage	Models
* @category	    Users_groups
*/
class Users_groups extends MY_Model
{
	/**
	* $editors = array(
	* 	"Наименование вкладки в админке" = array(
	*		"имя поля в базе" => array("Наименование поля для отображения", "наименования отображения", "условия для функции editors_post()", "условия для js валидации")
	*	)
	* )
	* 
	* "условия для функции editors_post" - функции php принимающие на вход один параметр + функции из библиотеки My_form_validation
	*
	* "условия для js валидации" - поддерживается три условия
	*	reqiure - обязателоно для заполнения
	*	email - коректный email
	*	matches[имя поля] - совпадение со значением поля имя которого указано
	* валидация функцией editors_post убрана полность. 
	* позднее расширю js валидацию.
	*/
	public $editors = array(
		'Основное' => array(
			'id' => array('id', 'hidden'),
			'name' => array('Заголовок', 'text', 'trim|htmlspecialchars|name', 'require'),
			'users_group2manufacturer' => array('Производители', 'u_g2m', 'users_group2manufacturer')
		)
	);
	
	function __construct()
	{
        parent::__construct();
	}
	
	public function access_by_manufacturer($user)
	{
		$module_enable = array('content');
		$table_enable = array('products', 'manufacturers', 'menu', 'categories');
		
		$uri = $this->uri->segment_array();
		if(count($uri) < 2) return TRUE;
		
		$user_groups = $this->table2table->get_parent_ids("users2users_groups", "users_group_id", "user_id", $user['id']);
		
		$manufacturer_access = array();
		foreach($user_groups as $group)
		{
			$manufacturer_access = array_merge($manufacturer_access, $this->table2table->get_parent_ids("users_group2manufacturer", "manufacturer_id", "user_group_id", $group));
		}
		
		//if(empty($manufacturer_access)) return TRUE;

		if(in_array($uri[2], $module_enable))
		{	
			if(isset($uri[4]) && $uri[4] == 'save') return TRUE;
			if(isset($uri[6]) && in_array($uri[5], $table_enable))
			{
				switch($uri[5])
				{
					case "manufacturers":
						$manufacturer_id = $this->uri->segment(6);
						break;
					case "products":
						$category_id = $this->products->get_item($this->uri->segment(6))->category_id;
						$menu_id = $this->categories->get_item($category_id)->menu_id;
						$manufacturer_id = $this->menu->get_item($menu_id)->manufacturer_id;
						break;
					case "menu":
						$manufacturer_id = $this->menu->get_item($this->uri->segment(6))->manufacturer_id;
						break;
					case "categories":
						$menu_id = $this->categories->get_item($this->uri->segment(6))->menu_id;
						$manufacturer_id = $this->menu->get_item($menu_id)->manufacturer_id;
						break;	
					
				}
				if(!in_array($manufacturer_id, $manufacturer_access)) return FALSE;
			}
			else
			{	
				if($uri[2] == "users_module")
				{
					if(isset($uri[4]) && $user['id'] <> $uri[4]) return FALSE; 
				}
				else
				{
					if(isset($uri[4]) && !in_array($uri[4], $table_enable)) return FALSE;
				}
			}
			return TRUE;
		}
	}
}