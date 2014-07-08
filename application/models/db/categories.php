<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Categories extends MY_Model
{
	public $editors = array(
			'Основное' => array(
				'id' => array('id', 'hidden'),	
				'title' => array('Название', 'text'),
				'root' => array('Категория', 'select'),					
				'cat_desc' => array('Описание', 'tiny'),
				'url' => array('url', 'hidden')
			)
		);
	
	function __construct()
	{
        parent::__construct();
		$this->load->database();
	}
}