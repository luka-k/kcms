<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Mailouts_module class
*
* @package		kcms
* @subpackage	controllers
* @category	    mailouts
*/
class Mailouts_module extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{		
		$mailouts = $this->mailouts->prepare_list($this->mailouts->get_list(FALSE));

		$data = array(
			'title' => "Рассылка",
			'templates' => $this->emails->get_list(array("type" => 2)),
			'mailouts' => array_reverse($mailouts)
		);
		$data = array_merge($this->standart_data, $data);
		
		$this->load->view('admin/mailouts', $data);
	}
	
	/**
	* Редактирование рассылки
	*/
	public function mailout()
	{
		$template_id = $this->input->post('template');
		$template = $this->emails->get_item($template_id);
		
		$data = array(
			'title' => "Редактирование рассылки",
			'template_id' => $template_id,
			'template' => $template,
			'users_groups' => $this->users_groups->get_list(FALSE)
		);
		$data = array_merge($this->standart_data, $data);

		$this->load->view('admin/mailout', $data);	
	}
	
	/**
	* Передает email из выбранных групп пользователей
	*/
	public function get_emails(){
		$info = json_decode(file_get_contents('php://input', true));
		
		$users = array();
		foreach($info->groups_ids as $group_id)
		{
			$users = array_merge($users, $this->users->group_list($group_id));
		}

		echo json_encode($users);
	}
	
	/**
	* Отсылка письма
	*/
	public function send_mail()
	{
		$info = json_decode(file_get_contents('php://input', true));
		
		$send_info = new stdCLass();
		$send_info->from_name =$info->post->from_name;
		$send_info->from_email = $info->post->from_email;
		$send_info->subject = $info->post->subject;
		$send_info->message = urldecode($info->post->message);
		$send_info->to = $info->user->email;
		
		$parse_info['USER_NAME'] = $info->user->email;
		
		$is_send = $this->mailouts->send_mail($send_info, $parse_info);
		
		echo json_encode($is_send);
	}
	
	
	/**
	* Добавление инфомации о рассылке в базу
	*/
	public function add_mailout_info(){
		$info = json_decode(file_get_contents('php://input', true));
		
		$users_groups = array();
		foreach($info->users_groups as $u_g)
		{
			$users_groups[] = $u_g;
		}
		
		$data = array(
			"template_id" => $info->template_id,
			"users_ids" => implode("/", $users_groups),
			"mailouts_date" => date("Y-m-d"),
			"success" => $info->success,
			"no_success" => $info->no_success
		);
			
		$this->mailouts->insert($data);
		
		echo json_encode("true");
	}
}