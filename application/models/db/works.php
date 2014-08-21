<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Works extends MY_Model
{
	public $editors = array(
		'Основное' => array(
			'id' => array('id', 'hidden'),
			'parent_id' => array('parent_id', 'hidden'),
			'title' => array('Адрес', 'text'),
			'time' => array('Время работы', 'text'),
			'price' => array('Стоимость работ', 'text')
		)
	);
	
	function __construct()
	{
        parent::__construct();
		$this->load->database();
	}
}

/* End of file review.php */
/* Location: ./application/models/db/parts.php */