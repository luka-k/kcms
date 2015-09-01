<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu extends MY_Model
{
	public $editors = array(
		'Основное' => array(
			'id' => array('id', 'hidden'),
			'name' => array('Заголовок', 'text', 'name'),
			'manufacturer_id' => array('Поставщик', 'select'),
			'school_id' => array('Школа', 'select')
		)	
	);
	
	function __construct()
	{
        parent::__construct();
	}
}