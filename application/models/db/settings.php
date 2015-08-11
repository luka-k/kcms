<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings extends MY_Model
{
	public $editors = array(
		'Основное' => array(
			'id' => array('id', 'hidden', ''),
			'site_title' => array('Название сайта', 'text', 'trim|htmlspecialchars'),
			'en_site_title' => array('Название сайта (eng)', 'text', 'trim|htmlspecialchars'),
			'admin_email' => array('e-mail Администратора', 'text', 'trim|htmlspecialchars'),
			'admin_name' => array('Имя Администратора', 'text', 'trim|htmlspecialchars'),
			'key_amount' => array('Стоимость ключа', 'text', 'trim|htmlspecialchars'),
			'key_topic' => array('Тема письма ключа', 'text', 'trim|htmlspecialchars'),
			'key_mail' => array('Текст письма ключа', 'tiny', ''),
			'kiy_amount' => array('Стоимость pt ключа', 'text', 'trim|htmlspecialchars'),
			'kiy_topic' => array('Тема письма pt ключа', 'text', 'trim|htmlspecialchars'),
			'kiy_mail' => array('Текст письма pt ключа', 'tiny-2', '')
		),
		'SEO' => array(
			'site_description' => array('Описание сайта', 'text'),
			'en_site_description' => array('Описание сайта (eng)', 'text'),
			'site_keywords' => array('Ключевые слова', 'text'),
			'en_site_keywords' => array('Ключевые слова (eng)', 'text')
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