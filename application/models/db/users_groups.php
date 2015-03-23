<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users_groups extends MY_Model
{
	public $editors = array(
		'Основное' => array(
			'id' => array('id', 'hidden', ''),
			'name' => array('Заголовок', 'text', 'trim|required|htmlspecialchars|name')
		)
	);
	
	function __construct()
	{
        parent::__construct();
	}
}