<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News extends MY_Model
{
	public $editors = array(
		'Основное' => array(
			'id' => array('id', 'hidden'),
			'date' => array('date', 'hidden'),
			'is_active' => array('Активна', 'checkbox'),
			'title' => array('Название', 'text'),
			'short_description' => array('Предварительный текст', 'tiny'),
			'description' => array('Полный  текст', 'tiny')
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

/* End of file news.php */
/* Location: ./application/models/db/news.php */