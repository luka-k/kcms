<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Управление пользователями

class Account extends Client_Controller 
{	
	public function __construct()
	{
		parent::__construct();
		$this->config->load('order_config');
	}
	
	/*Авторизация покупателя*/	
	public function do_enter()
	{
		$email = $this->input->post('login');
		$password = md5($this->input->post('password'));			
		$authdata = $this->users->login($email, $password);
		
		if (!$authdata['logged_in'])
		{	
			$user_id = $this->session->userdata('user_id');
	
			$data = array(
				'title' => "Регистрация",
				'meta_title' => "",
				'meta_keywords' => "",
				'meta_description' => "",
				'error' => "",
				'user' => $this->users->get_item_by(array("id" => $this->user_id)),
				'top_menu' => $this->top_menu->items,
				'activity' => "enter",
				'filials' => $this->filials->get_list(FALSE)
			);	
			
			$data['error'] = "Данные не верны. Повторите ввод";		
			$this->load->view('client/registration', $data);	
		} 
		else 
		{
			redirect(base_url().'cabinet');	
		}	
	}
	
	//Выход
	public function do_exit()
	{
		$authdata = array(
			'user_id' => '',
			'user_name' => '',
			'logged_in' => ''
			);
		$this->session->unset_userdata($authdata);
		
		redirect(base_url());
	}
	
	/*Вывод формы востановления пароля*/
	public function restore_password()
	{
		$data = array(
			'title' => "Регистрация",
			'meta_title' => "",
			'meta_keywords' => "",
			'meta_description' => "",
			'error' => "",
			'user' => $this->users->get_item_by(array("id" => $this->user_id)),
			'top_menu' => $this->top_menu->items,
			'activity' => "restore",
			'filials' => $this->filials->get_list(FALSE)
		);
		
		$this->load->view('client/registration', $data);	
	}
	
	/*Востановление пароля*/	
	public function restore_password_mail()
	{
		$data = array(
				'title' => "Регистрация",
				'meta_title' => "",
				'meta_keywords' => "",
				'meta_description' => "",
				'error' => "",
				'user' => $this->users->get_item_by(array("id" => $this->user_id)),
				'top_menu' => $this->top_menu->items,
				'activity' => "restore",
				'filials' => $this->filials->get_list(FALSE)
			);
			
		$this->form_validation->set_rules('email', 'E-mail', 'trim|xss_clean|required|valid_email');
		if($this->form_validation->run() == FALSE)
		{
			$this->load->view('client/registration', $data);	
		} 
		else 
		{
			$user_email = $this->users->get_user_email($this->input->post('email'));

			if($user_email) 
			{
				$secret = md5($this->config->item('secret'));
				$email = $this->users->get_item_by(array('email' => $user_email));
				$this->users->update($email->id, array('secret' => $secret));
				$subject = 'Востановление пароля';
				$message = 'Перейдите по ссылке для изменения пароля '.base_url()."account/new_password?email=$user_email&secret=$secret";
				
				if (!$this->mail->send_mail($user_email, $subject, $message))
				{
					$this->load->view('client/registration', $data);	
				}
				else
				{					
					redirect(base_url().'account/registration?activity=enter');			
				}
			} 
			else
			{
				$this->load->view('client/registration', $data);	
			}
		}
	}
	
	/*Вывод формы сброса пароля*/
	public function new_password()
	{
		$data = array(
				'title' => "Регистрация",
				'meta_title' => "",
				'meta_keywords' => "",
				'meta_description' => "",
				'error' => "",
				'user' => $this->users->get_item_by(array("id" => $this->user_id)),
				'top_menu' => $this->top_menu->items,
				'email' => $this->input->get('email'),
				'secret' => $this->input->get('secret'),
				'activity' => "new",
				'filials' => $this->filials->get_list(FALSE)
			);	
		$this->load->view('client/registration', $data);
	}
		
	/*Смена пароля*/
	public function change_password() 
	{
		$this->form_validation->set_rules('password', 'Password', 'trim|xss_clean|required');
		$this->form_validation->set_rules('conf_password',  'Confirm password',  'required|min_length[3]|matches[password]');
			
		if($this->form_validation->run() == FALSE)
		{
			$data = array(
				'title' => "Регистрация",
				'meta_title' => "",
				'meta_keywords' => "",
				'meta_description' => "",
				'error' => "",
				'user' => $this->users->get_item_by(array("id" => $this->user_id)),
				'top_menu' => $this->top_menu->items,
				'activity' => "restore",
				'filials' => $this->filials->get_list(FALSE)
			);
			
			$this->load->view('admin/new_password', $data);
		} 
		else 
		{
			$user_email = $this->input->post('email');
			$secret = $this->input->post('secret');
			$password = $this->input->post('password');
			$new_password = md5($password);
			
			$this->users->insert_new_pass($user_email, $new_password, $secret); 
			
			$email = $this->users->get_item_by(array('email' => $user_email));
			$this->users->update($email->id, array('secret' => ""));			

			$message_info = array(
				"user_name" => $email->name,
				"login" => $email->email,
				"password" => $this->input->post('password')
			);
				
			$this->emails->send_mail($email->email, 'change_password', $message_info);			
		}

		redirect(base_url().'account/registration?activity=enter');		
	}
			
	public function registration()
	{
		$activity = $this->input->get('activity');
		$data = array(
			'title' => "Регистрация",
			'meta_title' => "",
			'meta_keywords' => "",
			'meta_description' => "",
			'error' => "",
			'user' => $this->users->get_item_by(array("id" => $this->user_id)),
			'top_menu' => $this->top_menu->items,
			'select_item' => "",
			'activity' => $activity,
			'filials' => $this->filials->get_list(FALSE)
		);
		
		$this->load->view('client/registration', $data);		
	}
	
	public function new_user()
	{
		$activity = $this->input->get('activity');
		$data = array(
			'title' => "Регистрация",
			'meta_title' => "",
			'meta_keywords' => "",
			'meta_description' => "",
			'error' => "",
			'user' => $this->users->get_item_by(array("id" => $this->user_id)),
			'top_menu' => $this->top_menu->items,
			'select_item' => "",
			'activity' => "reg",
			'filials' => $this->filials->get_list(FALSE)
		);
			
		$this->form_validation->set_rules('email', 'e-mail', 'trim|xss_clean|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules( 'name', 'имя','trim|xss_clean|min_length[4]|max_length[25]|is_unique[users.name]');	
					
		$this->form_validation->set_rules('password', 'Password', 'trim|xss_clean');
		$this->form_validation->set_rules('conf_password',  'Confirm password',  'min_length[3]|matches[password]');
					
		//Валидация формы
		if($this->form_validation->run() == FALSE)
		{
			$data['error'] = validation_errors();
			//Если валидация не прошла выводим сообщение об ошибке
			$this->load->view('client/registration', $data);			
		}
		else
		{	
			$user = (object)$this->input->post();
			//Если id пустой то добавляем нового пользователя
			if (!$this->users->non_requrrent(array('name'=>$user->name)))
			{
				$data['error'] ="Пользователь с таким именем уже зарегистрирован";
				$this->load->view('client/registration', $user);	
			} 
			elseif (!$this->users->non_requrrent(array('email'=>$user->email)))
			{
				$data['error'] ="Такой email уже зарегистрирован";
				$this->load->view('client/registration', $user);						
			} 
			else 
			{	
				$pass = $user->conf_password;
				$user->role = "customer";
				$user->password = md5($user->password);
				unset($user->conf_password);
				$this->users->insert($user);
				
				$message_info = array(
					"user_name" => $user->name,
					"login" => $user->email,
					"password" => $pass
				);
				
				$this->emails->send_mail($user->email, 'registration', $message_info);				
				
				if($this->users->login($user->email, $user->password)) redirect(base_url().'cabinet');
			}
		}			
	}
}