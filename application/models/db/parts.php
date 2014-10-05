<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Parts extends MY_Model
{
	public $editors = array(
		'Основное' => array(
			'id' => array('id', 'hidden'),
			'title' => array('Заголовок', 'text', "non_requrrent"),
			'is_active' => array('Активна', 'checkbox'),
			'description' => array('Описание', 'tiny')
		),
		'SEO' => array(
			'meta_title' => array('Meta title страницы', 'text'),
			'meta_keywords' => array('Ключевые слова страницы', 'text'),
			'meta_description' => array('Описание страницы', 'text'),
			'url' => array('url', 'hidden')
		),		
		'Изображения' => array(
			'upload_image' => array('Загрузить изображение', 'upload_image', "unset"),
			'view_image' => array('Изображение', 'view_image', "unset")
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