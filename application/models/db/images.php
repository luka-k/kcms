<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Images extends MY_Model
{
	public $editors = array(
		'Основное' => array(
			'id' => array('id', 'hidden'),
			'object_type' => array('Тип страницы', 'hidden'),
			'object_id' => array('Id сраницы', 'hidden'),
			'url' => array('url', 'hidden')
		)
	);
	
	function __construct()
	{
        parent::__construct();
		$this->load->database();
	}
}