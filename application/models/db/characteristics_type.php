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
			'id' => array('id', 'hidden'),
			'name' => array('Название типа', 'text', 'trim|htmlspecialchars|name', 'require'),
			'view_type' => array('Тип отображения', 'simple_select'),
			'url' => array('Тип фильтра', 'hidden', 'substituted[name]')
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
	public function get_filters($products = 'all', $selected = FALSE)
	{
		$this->benchmark->mark('code_start');
		$filters = array();
		$this->db->where_in('url', array('color', 'material', 'turn', 'finishing'));
		$characteristics_type = $this->db->get('characteristics_type')->result();

		if(!empty($products)) foreach($characteristics_type as $item)
		{
			$this->db->distinct();
			$this->db->order_by('value', 'asc'); 
			$this->db->select('value');
			$this->db->where('type', $item->url);

			if($products <> 'all')
			{	
				$ids = array();
				foreach($products as $p)
				{
					$ids[] = $p->id;
				}
				$this->db->where_in('object_id', $ids);
			}
			
			$results = $this->db->get('characteristics')->result_array();
			
			$values = array();

			foreach($results as $result)
			{
				$values[] = $result['value'];
			}
			
			if(!empty($values))
			{
				$filters[$item->url] = (object)array(
					'name' => $item->name,
					'editor' => $item->view_type,
					'values' => $values
				);
			
			}
			
			if(isset($selected[$item->name]) && isset($filters[$item->url]))
			{				
				$filters[$item->url]->values = array_merge($filters[$item->url]->values , $selected[$item->name]);
				$filters[$item->url]->values = array_unique($filters[$item->url]->values);
			}
		}

		return $filters;
	}
}