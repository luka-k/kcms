<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Partners extends MY_Model
{
	public $editors = array(
		'Основное' => array(
			'id' => array('id', 'hidden'),
			'parent_id' => array('parent_id', 'hidden'),
			'title' => array('Партнер', 'text'),
			'link' => array('Ссылка', 'text'),
		)
	);
	
	function __construct()
	{
        parent::__construct();
		$this->load->database();
	}
}

/* End of file partners.php */
/* Location: ./application/models/db/parts.php */