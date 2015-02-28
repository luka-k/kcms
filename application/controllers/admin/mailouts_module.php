<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mailouts_module extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$mailouts = $this->mailouts->get_prepared_list($this->mailouts->get_list(FALSE));
		
		$emails = $this->emails->get_list(array("type" => 2));
		
		//я резонно подумал что врятли захочется делать рассулку на новость месячной давности и ограничил 10 последними.
		//да и то я думаю много.
		$news = $this->news->get_list(FALSE, 0, 10, "date", "asc");
		$templates = array();
		if(!empty($emails)) foreach($emails as $e)
		{
			$e->template_type = "emails";
			$templates[] = $e;
		}
		
		if(!empty($news)) foreach($news as $n)
		{
			$n->template_type = "news";
			$templates[] = $n;
		}
		//$templates = array_merge($templates, $news);
		//$templates = $this->news->get_list(FALSE);
		//var_dump($templates);
		$data = array(
			'title' => "Рассылка",
			'error' => "",
			'user' => $this->user,
			'menu' => $this->menu,
			'templates' => $templates,
			'mailouts' => array_reverse($mailouts)
		);
	
		$this->load->view('admin/mailouts', $data);
	}
	
	public function mailout($action = "edit")
	{
		$template_info = $this->input->post('template');
		$template_info = explode("-", $template_info);
		
		$type = $template_info[0];
		//$template = $this->emails->get_item_by(array("id" => $template_id));
		$template = $this->$type->get_item_by(array("id" => $template_info[1]));
		
		$data = array(
			'title' => "Редактирование рассылки",
			'error' => "",
			'user' => $this->user,
			'menu' => $this->menu,
			'template_id' => $template_info[1],
			'template_type' => $template_info[0],
			'template' => $template,
			'users_groups' => $this->users_groups->get_list(FALSE)
		);

		$this->load->view('admin/mailout', $data);	
	}
	
	public function get_emails(){
		$info = json_decode(file_get_contents('php://input', true));
		
		$users = array();
		foreach($info->groups_ids as $group_id)
		{
			$users = array_merge($users, $this->users->group_list($group_id));
		}

		echo json_encode($users);
	}
	
	public function send_mail()
	{
		$info = json_decode(file_get_contents('php://input', true));
		
		$send_info = new stdCLass();
		$send_info->from_name =$info->post->from_name;
		$send_info->from_email = $info->post->from_email;
		$send_info->subject = $info->post->subject;
		$send_info->message = htmlspecialchars_decode(rawurldecode($info->post->message));

		$send_info->to = $info->user->email;
		
		$parse_info['USER_NAME'] = $info->user->email;
		
		$is_send = $this->mailouts->send_mail($send_info, $parse_info);
		
		echo json_encode($is_send);
	}
	
	public function add_mailout_info(){
		$info = json_decode(file_get_contents('php://input', true));
		
		$users_groups = array();
		foreach($info->users_groups as $u_g)
		{
			$users_groups[] = $u_g;
		}
		
		$data = array(
			"template_id" => $info->template_id,
			"template_type" => $info->template_type,
			"users_ids" => implode("/", $users_groups),
			"mailouts_date" => date("Y-m-d"),
			"success" => $info->success,
			"no_success" => $info->no_success
		);
			
		$this->mailouts->insert($data);
		
		echo json_encode("true");
	}
}