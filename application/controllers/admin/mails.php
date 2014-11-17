<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Base admin class

class Mails extends Admin_Controller 
{

	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$this->menu = $this->menus->set_active($this->menu, 'settings');

		$data = array(
			'title' => "Редактировать настройки писем",
			'meta_title' => "Редактировать настройки писем",
			'error' => " ",
			'user_name' => $this->user_name,
			'user_id' => $this->user_id,
			'menu' => $this->menu,
			'emails' => $this->emails->get_list(FALSE),
			'select' => $this->config->item('message_type')
		);
		
		$this->load->view('admin/mails.php', $data);
	}
	
	public function edit_mails()
	{
		$mails = $this->input->post();

		foreach($mails['type'] as $key => $value)
		{
			$emails[$key] = array(
				"id" => $mails['id'][$key],
				"type" => $mails['type'][$key],
				"subject" => $mails['subject'][$key],
				"description" => $mails['description'][$key],
			);
		}
	
		foreach($emails as $mail)
		{
			$this->emails->update($mail['id'], $mail);
		}	
		redirect(base_url().'admin/mails');
	}
}