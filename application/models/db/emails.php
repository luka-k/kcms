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
		$this->load->database();
		$this->config->load('emails_config');
	
	}
		
	public function send_mail($to, $type, $data, $template = 'standart_mail'/*, $subject, $message*/)
	{
		$config = array(
			'protocol' => "mail",
			'charset' => "utf-8",
			'mailtype' => "html",
			'wordwrap' => TRUE
		);
	
		$replace = $this->config->item('replace');
		$settings = $this->settings->get_item_by(array("id" => 1));
		
		$from = $settings->admin_email;
		$who = $settings->admin_name;
		
		$email_config = $this->emails->get_item_by(array("type" => $type));

		$subject = $email_config->subject;
		$message = $email_config->description;
		
		if(isset($data))
		{
			foreach($data as $key => $info)
			{
				$subject = str_replace("%".$key."%", $info, $subject);
				$message = str_replace("%".$key."%", $info, $message);
			}
		}
		
		$data['message'] = $message;
		$template_message = $this->load->view('admin/email/'.$template.'.php', $data, TRUE);

		$this->email->initialize($config);
		$this->email->from($from, $who);
		$this->email->to($to);
		$this->email->subject($subject);
		$this->email->message($template_message);
		if(!$this->email->send())
		{
			return false;
		}
		else
		{
			return true;
		}

	}
	
}

/* End of file emails.php */
/* Location: ./application/models/db/emails.php */