<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Emails extends MY_Model
{
	public $editors = array(
		'Основное' => array(
			'id' => array('id', 'hidden', ''),
			'type' => array('type', 'hidden', ''),
			'name' => array('Наименование', 'text',  'trim|required|name'),
			//'users_type' => array('Группа подписчиков', 'simply_select',  ''),
			'subject' => array('Тема письма', 'text', ''),
			'description' => array('Текст письма', 'tiny', '')
		)
	);
	
	function __construct()
	{
        parent::__construct();
		$this->config->load('emails_config');
	}
	
	public function send_system_mail($to, $template_id, $parse_info, $template = 'standart_mail')
	{
		$config = $this->config->item('config');
		$settings = $this->settings->get_item_by(array("id" => 1));
		
		$info = new stdCLass();
		
		$info->to = $to;
		$info->from_name = $settings->admin_name;
		$info->from_email = 'info@brightbuild.ru';//$settings->admin_email;
		
		$template_info = $this->emails->get_item_by(array("id" => $template_id));
		
		$info->subject = $template_info->subject;
		$info->message = $template_info->description;
		
		return $this->mailouts->send_mail($info, $parse_info, $template);
	}	
}

/* End of file emails.php */
/* Location: ./application/models/db/emails.php */