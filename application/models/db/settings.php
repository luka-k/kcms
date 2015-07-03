<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Settings class
*
* @package		kcms
* @subpackage	Models
* @category	    Settings
*/
class Settings extends MY_Model
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
			'site_title' => array('Название сайта', 'text', 'trim|htmlspecialchars'),
			'admin_email' => array('e-mail Администратора', 'text', 'trim|htmlspecialchars'),
			'admin_name' => array('Имя Администратора', 'text', 'trim|htmlspecialchars'),
			'site_description' => array('Описание сайта', 'textarea', 'trim'),
			'catalog_h1' =>  array('Заголовок каталога', 'text', 'trim'),
			'catalog_description' =>  array('Текст на главной каталога', 'tiny', 'trim'),
			'vendors_h1' =>  array('Заголовок производителей', 'text', 'trim'),
			'vendors_description' =>  array('Текст на главной производителей', 'tiny-2', 'trim'),
			'contractor_h1' =>  array('Заголовок подрядчиков', 'text', 'trim'),
			'contractor_description' =>  array('Текст на главной подрядчиков', 'tiny-3', 'trim'),
			'order_string' => array('Сообщение об оформлении заказа', 'text', 'trim|htmlspecialchars')
		),
		'SEO' => array(
			'site_keywords' => array('Ключевые слова', 'text'),
			'lastmod' => array('lastmod', 'hidden')
		),
		'Изображение' => array(
			'upload_image' => array('Изображение по умолчанию', 'image', 'img')
		)
	);
	
	function __construct()
	{
        parent::__construct();
	}
}