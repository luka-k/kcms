<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News extends MY_Model
{
	public $editors = array(
		'Основное' => array(
			'id' => array('id', 'hidden'),
			'date' => array('date', 'hidden'),
			'is_active' => array('Активна', 'checkbox'),
			'title' => array('Название', 'text'),
			'prev_text' => array('Предварительный текст', 'tiny'),
			'full_text' => array('Полный  текст', 'tiny')
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

/* End of file news.php */
/* Location: ./application/models/db/news.php */