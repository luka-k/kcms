<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings extends MY_Model
{
	public $editors = array(
		'Основное' => array(
			'id' => array('id', 'hidden', ''),
			'site_title' => array('Название сайта', 'text', 'trim|htmlspecialchars'),
			'admin_email' => array('e-mail Администратора', 'text', 'trim|htmlspecialchars'),
			'admin_name' => array('Имя Администратора', 'text', 'trim|htmlspecialchars'),
			'description' => array('Продукция от компании redBTR', 'tiny', 'trim')/*,
			'site_offline' => array('Сайт выключен', 'checkbox', "null"),
			'offline_text' => array('Оффлайн сообщение', 'text')*/
		),
		'SEO' => array(
			'site_description' => array('Описание сайта', 'text'),
			'site_keywords' => array('Ключевые слова', 'text')
		),
		'Изображение' => array(
			'upload_image' => array('Изображение по умолчанию', 'image', 'img'),
			'resize_image' => array('Изменить размеры изображений', 'resize_images', '')
		)
	);
	
	public $validation = array(
		array(
			'field'   => 'site_title',
			'label'   => 'Имя пользователя',
			'rules'   => 'required'
		)
	);
	
	function __construct()
	{
        parent::__construct();
		$this->load->database();
	}
}