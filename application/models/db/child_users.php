<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Child_users extends MY_Model
{
	public $editors = array(
		'Основное' => array(
			'id' => array('id', 'hidden'),
			'first_name' => array('Фамилия', 'text', 'name'),
			'last_name' => array('Имя', 'text'),
			'middle_name' => array('Отчество', 'text'),
			'parent_id' => array('Родитель', 'select'),
			'school_id' => array('Школа', 'select'),
			'class' => array('Класс', 'text'),
			'card_number' => array('Номер карты', 'text'),
			'birthday' => array('Дата', 'date'),
			'phone' => array('Номер телефона', 'text'),
			'dinner_sms_enabled' => array('Оповещения об обедах', 'checkbox'),
			'dinner_sms_enabled_date' => array('Дата включения оповещения', 'date'),
			'visit_sms_enabled' => array('Оповещение о посещаемости', 'checkbox'),
			'visit_sms_enabled_date' => array('Дата включения оповещения', 'date'),
			'image_blob' => array('Аватар', 'image', 'img')
		),
		'Продукты' => array(
			'child2products' => array('Разрешенные продукты', 'child2products')
		)
	);
	
	function __construct()
	{
        parent::__construct();
	}
}