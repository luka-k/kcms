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
		$this->menu = $this->menus->set_active($this->menu, 'emails');
		
		$mailouts = $this->mailouts->get_prepared_list($this->mailouts->get_list(FALSE));

		$templates = $this->emails->get_list(array("type" => 2));
		$news = $this->articles->get_list(array("parent_id" => 3));
		foreach ($news as $n)
		{
			$n->id = 'n_'.$n->id;
			$templates[] = $n;
		}
		
		$data = array(
			'title' => "Рассылка",
			'error' => "",
			'user' => $this->user,
			'menu' => $this->menu,
			'templates' => $templates,
			'mailouts' => array_reverse($mailouts)
			//'users_groups' => $this->users_groups->get_list(FALSE)
		);
	
		$this->load->view('admin/mailouts', $data);
	}
	
	public function mailout($action = "edit")
	{
		$settings = $this->settings->get_item_by(array('id' => 1));
		$template_id = $this->input->post('template');
		
		if (strstr($template_id, 'n_'))
		{
			$template = $this->articles->get_item_by(array("id" => str_replace('n_', '', $template_id)));
			$template->subject = $template->name;
			$template->description = '<h3>%USER_LAST_NAME%, добрый день!</h3>'. $template->description;
		} else
			$template = $this->emails->get_item_by(array("id" => $template_id));
		$data = array(
			'title' => "Редактирование рассылки",
			'error' => "",
			'user' => $this->user,
			'from_name' => $settings->admin_name,
			'from_email' => $settings->admin_email,
			'menu' => $this->menu,
			'template_id' => $template_id,
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
			//var_dump($send_info);
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
				if (!$user) continue;
				$info->to = $user->email; 
				
				$parse_info['USER_NAME'] = $user->name;
				$parse_info['USER_LAST_NAME'] = $user->last_name;
				
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
}