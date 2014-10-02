<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Information extends MY_Model
{
	public $editors = array(
		'Основное' => array(
			'id' => array('id', 'hidden'),
			'title' => array('Заголовок', 'text'),
			'description' => array('Описание', 'tiny')
		),
		'SEO' => array(
			'meta_title' => array('Meta title страницы', 'text'),
			'meta_keywords' => array('Ключевые слова страницы', 'text'),
			'meta_description' => array('Описание страницы', 'text'),
			'url' => array('url', 'text')
		)
	);
	
	function __construct()
	{
        parent::__construct();
		$this->load->database();
	}
}