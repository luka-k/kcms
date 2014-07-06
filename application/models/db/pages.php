<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends MY_Model
{
	public $editors = array(
		'Основное' => array(
			'id' => array('id', 'hidden'),
			'cat_id' => array('Категория', 'select'),
			'is_active' => array('Активна', 'checkbox'),
			'title' => array('Заголовок', 'text'),
			'full_text' => array('Содержимое', 'tiny'),
			'status' => array('забыл что это', 'hidden'),
			'autor' => array('автор', 'hidden'),
			'publish_date' => array('Дата публикации', 'hidden')
		),
		'SEO' => array(
			'meta_title' => array('Meta title страницы', 'text'),
			'keywords' => array('Ключевые слова страницы', 'text'),
			'description' => array('Описание страницы', 'text'),
			'url' => array('url страницы', 'hidden')		
		)
	);
	
	function __construct()
	{
        parent::__construct();
		$this->load->database();
	}
}
