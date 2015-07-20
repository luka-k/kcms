<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Seo class
*
* @package		kcms
* @subpackage	Models
* @category	    Seo
*/
class Seo extends MY_Model
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
			'url' => array('Ссылка', 'text', 'trim|htmlspecialchars|name', 'require'),
			'is_active' => array('Активна', 'checkbox'),
			'sort' => array('Сортировка', 'text'),
			'meta_title' => array('meta title', 'text'),
			'meta_description' => array('meta description', 'text'),
			'description' => array('Описание', 'tiny'),
			'meta_keywords' => array('meta keywords', 'text')
		)
	);
	
	
	function __construct()
	{
        parent::__construct();
	}
	
}