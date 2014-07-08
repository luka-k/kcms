<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menus extends MY_Model
{
	public $editors = array(
		'Основное' => array(
			'id' => array('id', 'hidden'),
			'name' => array('Имя меню', 'text'),
			'title' => array('Название', 'text'),
			'status' => array('Активен', 'checkbox')
		)
	);
	
	function __construct()
	{
        parent::__construct();
		$this->load->database();
	}
}

