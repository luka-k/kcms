<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class System_emails extends MY_Model
{
	public $editors = array(
		'Основное' => array(
			'id' => array('id', 'hidden', ''),
			'name' => array('Наименование', 'text',  'trim|required|name'),
			'subject' => array('Тема письма', 'text', ''),
			'description' => array('Текст письма', 'tiny', '')
		)
	);
	
	function __construct()
	{
        parent::__construct();
		$this->config->load('emails_config');
	}
	
	function send_system_mail($to, $type)
	{
		$email_config = $this->emails->get_item_by(array("type" => $type));

		$subject = $email_config->subject;
		$message = $email_config->description;
		
		$this->emails->send_mail();
	}

}