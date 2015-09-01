<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manufacturers extends MY_Model
{
	public $editors = array(
		'Основное' => array(
			'id' => array('id', 'hidden'),
			'name' => array('Заголовок', 'text', "non_requrrent|name")
		)
	);
	
	function __construct()
	{
        parent::__construct();
	}
}