<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Filials extends MY_Model
{
	public $editors = array(
		'Основное' => array(
			'id' => array('id', 'hidden', ''),
			'name' => array('Заголовок', 'text', 'trim|required|htmlspecialchars|name'),
			'phone' => array('Телефон', 'text', 'trim|htmlspecialchars'),
			'caption' => array('Подпись', 'text', 'trim|htmlspecialchars')
		)
	);
	
	function __construct()
	{
        parent::__construct();
		$this->load->database();
	}
	
	function prepare($item)
	{
		return $item;		
	}
}