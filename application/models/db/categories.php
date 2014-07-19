<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Categories extends MY_Model
{
	public $editors = array(
		'Основное' => array(
			'id' => array('id', 'hidden'),
			'title' => array('Заголовок', 'text'),
			'parent' => array('Родительская категория', 'select'),
			'is_active' => array('Активен', 'checkbox'),
			'cat_desc' => array('Описание', 'tiny')
		),
		'SEO' => array(
			'meta_title' => array('Meta title страницы', 'text'),
			'keywords' => array('Ключевые слова страницы', 'text'),
			'description' => array('Описание страницы', 'text'),
			'url' => array('url', 'hidden')
		)
	);
	
	function __construct()
	{
        parent::__construct();
		$this->load->database();
	}
}