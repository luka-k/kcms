<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Collections class
*
* @package		kcms
* @subpackage	Models
* @category	    Collections
*/
class Collections extends MY_Model
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
	* можно указывать сразу несколько условий разделяя их вертикальной чертой - |
	* валидация функцией editors_post убрана полность. 
	* позднее расширю js валидацию.
	*/
	public $editors = array(
		'Основное' => array(
			'id' => array('id', 'hidden'),
			'name' => array('Заголовок', 'text', 'trim|htmlspecialchars|name', 'require'),
			'parent_id' => array('Родительская категория', 'select'),
			'sort' => array('Сортировка', 'text'),
			'description' => array('Описание', 'tiny')
		),
		'SEO' => array(
			'meta_title' => array('Meta title страницы', 'text', 'trim|htmlspecialchars'),
			'meta_keywords' => array('Ключевые слова страницы', 'text', 'trim|htmlspecialchars'),
			'meta_description' => array('Описание страницы', 'text', 'trim|htmlspecialchars'),
			'url' => array('url', 'text', 'trim|htmlspecialchars|substituted[name]'),
			'changefreq' => array('changefreq', 'text'),
			'priority' => array('priority', 'priority'),
			'lastmod' => array('lastmod', 'hidden')
		)
	);
	
	public $admin_left_column = array(
		"items_tree" => "collections_tree",
		"item_tree" => "collections_tree",
	);
	
	function __construct()
	{
        parent::__construct();
	}
	
	/**
	*
	*/
                                                                                                                                                       
	
	function prepare($item)
	{
		return $item;
	}
}