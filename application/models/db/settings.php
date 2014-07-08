<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings extends MY_Model
{
	public $editors = array(
		'Основное' => array(
			'id' => array('id', 'hidden'),
			'site_title' => array('Название сайта', 'text'),
			'site_offline' => array('Сайт выключен', 'checkbox'),
			'offline_text' => array('Оффлайн сообщение', 'text')
		),
		'SEO' => array(
			'site_description' => array('Описание сайта', 'text'),
			'site_keywords' => array('Ключевые слова', 'text')
		)
	);
	
	function __construct()
	{
        parent::__construct();
		$this->load->database();
	}
}