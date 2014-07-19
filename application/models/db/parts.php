<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Parts extends MY_Model
{
	public $editors = array(
		'Основное' => array(
			'id' => array('id', 'hidden'),
			'title' => array('Заголовок', 'text'),
			'is_active' => array('Активна', 'checkbox'),
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

/* End of file parts.php */
/* Location: ./application/models/db/parts.php */