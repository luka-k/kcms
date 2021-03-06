<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Dynamic_menus class
*
* @package		kcms
* @subpackage	Models
* @category	    Dynamic_menus
*/
class Dynamic_menus extends MY_Model
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
			'description' => array('Описание', 'text', 'trim|htmlspecialchars')
		)
	);
	
	function __construct()
	{
        parent::__construct();
	}
	
	/**
	* Получение меню по id
	*
	* @param integer $id
	* @return object
	*/
	public function get_menu($id)
	{
		$menu = new stdClass();
		$menu->info = $this->get_item($id);
		
		$menu->items = $this->menus_items->menu_tree($id);

		return $menu;
	}
}