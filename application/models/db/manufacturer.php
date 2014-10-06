<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manufacturer extends MY_Model
{
	public $editors = array(
		'Основное' => array(
			'id' => array('id', 'hidden'),
			'name' => array('Заголовок', 'text', "non_requrrent"),
			'url' => array('Url', 'text'),
			'phone' => array('Телефон', 'text'),
			'link' => array('Ссылка на сайт', 'text')
		),		
		'Изображения' => array(
			'upload_image' => array('Загрузить изображение', 'upload_image', "unset"),
			'view_image' => array('Изображение', 'view_image', "unset")
		)
	);
	
	function __construct()
	{
        parent::__construct();
		$this->load->database();
	}
}