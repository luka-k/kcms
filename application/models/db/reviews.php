<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reviews extends MY_Model
{
	public $editors = array(
		'Основное' => array(
			'id' => array('id', 'hidden'),
			'parent_id' => array('parent_id', 'hidden'),
			'title' => array('Имя', 'text'),
			'text' => array('Текст отзыва', 'tiny'),
			'vk_link' => array('ссылка на страницу ВК', 'text')
		)
	);
	
	function __construct()
	{
        parent::__construct();
		$this->load->database();
	}
}

/* End of file review.php */
/* Location: ./application/models/db/parts.php */