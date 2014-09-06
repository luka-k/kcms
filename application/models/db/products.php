<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Products extends MY_Model
{
	public $editors = array(
		'Основное' => array(
			'id' => array('id', 'hidden'),
			'parent_id' => array('Категория', 'select'),
			'is_active' => array('Активна', 'checkbox'),
			'title' => array('Заголовок', 'text'),
			'price' => array('Цена', 'text'),
			'description' => array('Описание', 'tiny'),
			'publish_date' => array('Дата публикации', 'hidden')
		),
		'SEO' => array(
			'meta_title' => array('Meta title страницы', 'text'),
			'meta_keywords' => array('Ключевые слова страницы', 'text'),
			'meta_description' => array('Описание страницы', 'text'),
			'url' => array('url страницы', 'text')		
		)
	);
	
	function __construct()
	{
        parent::__construct();
		$this->load->database();
	}
}
