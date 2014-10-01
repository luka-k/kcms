<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Slider extends MY_Model
{
	public $editors = array(
		'Основное' => array(
			'id' => array('id', 'hidden'),
			'title' => array('Заголовок', 'text'),
			'is_active' => array('Активен', 'checkbox'),
			'link' => array('Ссылка', 'text')
		)
	);
	
	function __construct()
	{
        parent::__construct();
		$this->load->database();
	}
	
}