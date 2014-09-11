<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Orders_customers extends MY_Model
{
	public $editors = array(
		'Основное' => array(
			'id' => array('id', 'hidden'),
			'name' => array('Имя', 'hidden'),
			'phone' => array('Телефон', 'hidden'),
			'email' => array('E-mail', 'hidden'),
			'address' => array('Адрес доставки', 'hidden')
		),
	);
	
	function __construct()
	{
        parent::__construct();
		$this->load->database();
	}
}

/* End of file news.php */
/* Location: ./application/models/db/news.php */