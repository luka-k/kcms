<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Calculator extends MY_Model
{
	public $editors = array(
		'Основное' => array(
			'id' => array('id', 'hidden'),
			'title' => array('Заголовок', 'text'),
			'description' => array('Описание', 'tiny'),
			'price' => array('Стоимость одной единицы', 'text'),
			'unit' => array('Единицы измерения', 'select'),
		),
	);
	
	function __construct()
	{
        parent::__construct();
		$this->load->database();
	}
}

/* End of file parts.php */
/* Location: ./application/models/db/parts.php */