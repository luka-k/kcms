<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Emails extends MY_Model
{
	public $editors = array(
		'Основное' => array(
			'id' => array('id', 'hidden', ''),
			'type' => array('type', 'hidden', ''),
			'name' => array('Наименование', 'text',  'trim|required|name'),
			'subject' => array('Тема письма', 'text', ''),
			'description' => array('Текст письма', 'tiny', '')
		)
	);
	
	function __construct()
	{
        parent::__construct();
		$this->config->load('emails');
	}
	
	public function send_system_mail($to, $template_id, $parse_info, $template = 'standart_mail')
	{
		$config = $this->config->item('config');
		$settings = $this->settings->get_item(1);
		
		$info = new stdCLass();
		
		$info->to = $to;
		$info->from_name = $settings->admin_name;
		$info->from_email = $settings->admin_email;
		
		$template_info = $this->get_item($template_id);
		
		$info->subject = $template_info->subject;
		$info->message = $template_info->description;
		
		return $this->mailouts->send_mail($info, $parse_info, $template);
	}	
}

/* End of file emails.php */
/* Location: ./application/models/db/emails.php */