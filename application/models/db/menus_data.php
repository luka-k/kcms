<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menus_data extends MY_Model
{
	public $editors = array(
		'Основное' => array(
			'id' => array('id', 'hidden'),
			'menu_id' => array('id меню', 'hidden'),
			'title' => array('Наименование', 'text'),
			'parent_id' => array('Родительский пункт', 'select'),
			/*'item_type' => array('Тип ссылки', 'radio', array('Страница', 'Категория')),*/
			'hidden' => array('Скрыть', 'checkbox'),
			'url' => array('url', 'hidden')
		)
	);

	function __construct()
	{
        parent::__construct();
		$this->load->database();
	}
	

}