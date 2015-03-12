<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mailouts extends MY_Model
{
	public $editors = array(
		'Основное' => array(
			'id' => array('id', 'hidden', ''),
			'template_id' => array('template_id', 'hidden', ''),
			'users_ids' => array('Группы подписчиков', 'text',  'trim|required|name'),
			'mailouts_date' => array('Дата', 'text', 'set_date')
		)
	);
	
	function __construct()
	{
        parent::__construct();
	}
	
	public function send_mail($send_info, $data, $template = 'standart_mail')
	{
		$config = $this->config->item('config');
		$subject = $send_info->subject;
		$message = $send_info->message;
		var_dump($message);
		if(isset($data))
		{
			foreach($data as $key => $info)
			{
				$subject = str_replace("%".$key."%", $info, $subject);
				$message = str_replace("%".$key."%", $info, $message);
			}
		}
		
		$data['subject'] = $subject;
		$data['message'] = $message;
		$template_message = $this->load->view('admin/email/'.$template.'.php', $data, TRUE);

		$this->email->initialize($config);
		$this->email->from($send_info->from_email, $send_info->from_name);
		$this->email->to($send_info->to);
		$this->email->subject($subject);
		$this->email->message($template_message);
		
		return !$this->email->send() ? FALSE : TRUE; 
	}
	
	public function prepare($item)
	{
		$groups = explode("/", $item->users_ids);
		foreach($groups as $g)
		{
			$group = $this->users_groups->get_item($g);
			$item->users_groups[] = $group->name;
		}
		
		$template = $this->emails->get_item($item->template_id);
		$item->template = $template->name;
		return $item;
	}
}