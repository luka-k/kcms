<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Characteristics_type class
*
* @package		kcms
* @subpackage	Models
* @category	    Characteristics_type
*/
class Characteristics_type extends MY_Model
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
			'id' => array("id", "hidden"),
			'name' => array("Название типа", "text", "trim|htmlspecialchars|name", 'require'),
			'view_type' => array("Тип отображения", "simple_select"),
			'url' => array("Тип фильтра", "hidden", "substituted[name]")
		)
	);
	
	function __construct()
	{
        parent::__construct();
	}
	
	/**
	* Получение списка фильтров
	*
	* @return array
	*/
	public function get_filters()
	{
		$characteristics_type = $this->get_list(FALSE);

		foreach($characteristics_type as $item)
		{
			$filters[$item->url] = (object)array(
				"name" => $item->name,
				"editor" => $item->view_type
			);
			if($item->view_type == "multy" || $item->view_type == "single")
			{
				$this->db->distinct();
				$this->db->select("value");
				$this->db->where("type", $item->url);
				$query = $this->db->get("characteristics");
				$values = array();
				foreach($query->result_array() as $result)
				{
					$values[] = $result['value'];
				}
				
				$filters[$item->url]->values = $values;
			}
		}
		return $filters;
	}
}