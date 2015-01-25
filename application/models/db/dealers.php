<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dealers extends MY_Model
{
	public $editors = array(
		'Основное' => array(
			'id' => array('id', 'hidden', ''),
			'name' => array('Название', 'text', 'trim|required|htmlspecialchars|name'),
			'region' => array('Регион', 'reg_select', '')
		)
	);
	
	function __construct()
	{
        parent::__construct();
	}
}