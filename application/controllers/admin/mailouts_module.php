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
		
		if($action == "edit")
		{
			$this->load->view('admin/mailout', $data);	
		}
		elseif($action == "send")
		{
			$send_info = (object)$this->input->post();

			$template_id = $send_info->template;

			$info = new stdCLass();

			$info->from_name = $send_info->from_name;
			$info->from_email = $send_info->from_email;
			$info->subject = $send_info->subject;
			$info->message = $send_info->message;

			
			$this->db->where_in("id", $send_info->users_groups);
			$query = $this->db->get('users_groups');
			$users_groups = $query->result();
			
			$users = array();
			foreach($users_groups as $group)
			{
				$users = array_merge($users, $this->users->group_list($group->id));
			}
			
			$success = 0;
			$no_success = 0;
			foreach($users as $user)
			{
				$info->to = $user->email; 
				
				$parse_info['USER_NAME'] = $user->name;
				
				$is_send = $this->mailouts->send_mail($info, $parse_info);
				
				$is_send ? $success++ : $no_success++;
			}
			
			$data = array(
				"template_id" => $template_id,
				"users_ids" => implode("/", $send_info->users_groups),
				"mailouts_date" => date("Y-m-d"),
				"success" => $success,
				"no_success" => $no_success
			);
			
			$this->mailouts->insert($data);
			
			redirect(base_url().'admin/mailouts_module/');
		}
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