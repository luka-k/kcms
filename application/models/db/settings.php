<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings extends MY_Model
{
	public $editors = array(
		'Основное' => array(
			'id' => array('id', 'hidden', ''),
			'site_title' => array('Название сайта', 'text', 'trim|htmlspecialchars'),
			'admin_email' => array('e-mail Администратора', 'text', 'trim|htmlspecialchars'),
			'admin_name' => array('Имя Администратора', 'text', 'trim|htmlspecialchars'),
			'order_string' => array('Сообщение об оформлении заказа', 'text', 'trim|htmlspecialchars')
		),
		'SEO' => array(
			'site_description' => array('Описание сайта', 'text'),
			'site_keywords' => array('Ключевые слова', 'text')
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