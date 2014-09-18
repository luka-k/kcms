<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Emails extends MY_Model
{
	public $editors = array(
		'id' => array('id', 'hidden'),
		'type' => array('Тип', 'select'),
		'subject' => array('Тема письма', 'text'),
		'description' => array('Текст письма', 'tiny')
	);
	
	function __construct()
	{
        parent::__construct();
		$this->load->database();
	}
	
}

/* End of file emails.php */
/* Location: ./application/models/db/emails.php */