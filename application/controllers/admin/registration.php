<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Управление пользователями

class Registration extends CI_Controller 
{	
	public function __construct()
	{
		parent::__construct();
		$this->config->load('order_config');
	}
	
	public function login()
	{
		$data = array(
			'title' => "Вход",
			'meta_title' => "Вход",
			'error' => " "
		);
		$this->load->view('admin/login.php', $data);
	}
	
	/*Авторизация пользователя*/	
	public function do_enter()
	{
		$data = array(
			'title' => "Вход",
			'meta_title' => "Вход",
			'error' => " "
		);
		
		$email = $this->input->post('email');
		$password = md5($this->input->post('password'));	
		$authdata = $this->users->login($email, $password);

		$is_logged = $authdata['logged_in'];
		$user = (array)$authdata['user'];
		$user_groups = (array)$authdata['user_groups'];

		if ((!$is_logged)||(!in_array("admin", $user_groups)))
		{
			$data['error'] = "Данные не верны. Повторите ввод";		
			$this->load->view('admin/login.php', $data);	
		} 
		else 
		{
			redirect(base_url().'admin');	
		}	
	}
	
	//Выход
	public function logout()
	{
		$role = $this->session->userdata('role');
		$authdata = array(
			'user' => array("group" => ""),
			'user_groups' => '',
			'logged_in' => ''
			);
		$this->session->unset_userdata($authdata);
		
		redirect(base_url().'admin');
	}
	
	/*Вывод формы востановления пароля*/
	public function restore_password()
	{
		$data = array(
			'title' => "Востановление пароля",
			'meta_title' => "Востановление пароля",
			'error' => " "
		);
		$this->load->view('admin/restore_form', $data);			
	}
	
	/*Востановление пароля*/	
	public function restore_password_mail()
	{
		$data = array(
			'title' => "Востановление пароля",
			'meta_title' => "Востановление пароля",
			'error' => "Не правильно введен e-mail"
		);
		$this->form_validation->set_rules('email', 'E-mail', 'trim|xss_clean|required|valid_email');
		if($this->form_validation->run() == FALSE)
		{
			$this->load->view('admin/restore_form', $data);	
        } 
		else 
		{
			$email = $this->input->post('email');
			$user = $this->users->get_item_by(array('email' => $email));
	
			if(!empty($user)) 
			{
				$secret = md5($this->config->item('secret'));
				$this->users->update($user->id, array('secret' => $secret));
				
				$message_info = array(
					"base_url" => base_url(),
					"user_name" => $user->name,
					"user_email" => $email,
					"secret" => $secret
				);
				
				if($this->emails->send_system_mail($email, 7, $message_info)) redirect(base_url().'admin');
				$data['error'] = "Отправка письма не удалась. Повторите попытку позднее.";
			} 

			$this->load->view('admin/restore_form', $data);	
		}
	}
	
	/*Вывод формы сброса пароля*/
	public function new_password()
	{
		$data = array(
			'title' => "Сброс пароля",
			'meta_title' => "Сброс пароля",
			'error' => " ",
			'email' => $this->input->get('email'),
			'secret' => $this->input->get('secret')
		);	
		$this->load->view('admin/new_password', $data);
	}
		
	/*Смена пароля*/
	public function change_password() 
	{
		$this->form_validation->set_rules('password', 'Password', 'trim|xss_clean|required');
		$this->form_validation->set_rules('conf_password',  'Confirm password',  'required|min_length[3]|matches[password]');
			
		if($this->form_validation->run() == FALSE)
		{
			$data = array(
				'title' => "Востановление пароля",
				'meta_title' => "Востановление пароля",
				'error' => "",
				'email' => $this->input->get('email'),
				'secret' => $this->input->get('secret')
			);	
			
			$this->load->view('admin/new_password', $data);
		} 
		else 
		{
			$email = $this->input->post('user_email');
			$secret = $this->input->post('secret');
			$password = $this->input->post('password');
			$new_password = md5($password);
			
			$this->users->insert_new_pass($email, $new_password, $secret); 
			
			$user = $this->users->get_item_by(array('email' => $email));
			$this->users->update($user->id, array('secret' => ""));			

			$message_info = array(
				"user_name" => $user->name,
				"login" => $email,
				"password" => $password 
			);
				
			$this->emails->send_system_mail($user->email, 5, $message_info);		
		}

		redirect(base_url().'admin');		
	}
}