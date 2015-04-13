<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Account class
* 
* Класс работы с пользоватлями клиентской стороны
*
* @package		kcms
* @subpackage	Controllers
* @category	    Account
*/
class Account extends Client_Controller 
{	
	public function __construct()
	{
		parent::__construct();
	}
	
	/**
	* Вывод страницы входа и регстрации пользователя
	*/
	public function registration()
	{
		$activity = $this->input->get('activity');
		$data = array(
			'title' => "Регистрация",
			'error' => "",
			'select_item' => "",
			'settings' => $this->settings->get_item_by(array("id" => 1)),
			'activity' => $activity
		);
		$data = array_merge($this->standart_data, $data);
		
		$this->load->view('client/registration', $data);		
	}
	
	/**
	* Авторизация пользователя
	*/	
	public function do_enter()
	{
		$email = $this->input->post('email');
		$password = md5($this->input->post('password'));			
		$authdata = $this->users->login($email, $password);
		if ($authdata['logged_in']) redirect(base_url().'cabinet');

		$data = array(
			'title' => "Регистрация",
			'error' => "",
			'select_item' => "",
			'settings' => $this->settings->get_item_by(array("id" => 1)),
			'activity' => "enter",
		);	
		$data = array_merge($this->standart_data, $data);

		$data['error'] = "Данные не верны. Повторите ввод";		
		$this->load->view('client/registration', $data);	
	}
	
	/**
	* Выход пользователя
	*/
	public function do_exit()
	{
		$authdata = array(
			'user' => '',
			'logged_in' => '',
			'user_groups' => ''
			);
		$this->session->unset_userdata($authdata);
		
		redirect(base_url());
	}
	
	/**
	* Вывод формы востановления пароля
	*/
	public function restore_password()
	{
		$data = array(
			'title' => "Регистрация",
			'error' => "",
			'select_item' => "",
			'settings' => $this->settings->get_item_by(array("id" => 1)),
			'activity' => "restore"
		);
		
		$data = array_merge($this->standart_data, $data);
		
		$this->load->view('client/registration', $data);	
	}
	
	/**
	* Востановление пароля
	*/	
	public function restore_password_mail()
	{
		$data = array(
			'title' => "Регистрация",
			'error' => "",
			'select_item' => "",
			'settings' => $this->settings->get_item_by(array("id" => 1)),
			'activity' => "restore"
		);
		
		$data = array_merge($this->standart_data, $data);
			
		$this->form_validation->set_rules('email', 'E-mail', 'trim|xss_clean|required|valid_email');
		if($this->form_validation->run() == FALSE)
		{
			$this->load->view('client/registration', $data);	
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
				
				if($this->emails->send_system_mail($email, 7, $message_info)) redirect(base_url().'account/registration?activity=enter');
				$data['error'] = "Отправка письма не удалась. Повторите попытку позднее.";
			} 
			
			$this->load->view('client/registration', $data);	
		}
	}
	
	/**
	* Вывод формы сброса пароля
	*/
	public function new_password()
	{
		$data = array(
			'title' => "Регистрация",
			'error' => "",
			'email' => $this->input->get('email'),
			'secret' => $this->input->get('secret'),
			'select_item' => "",
			'activity' => "new"
		);	
		$data = array_merge($this->standart_data, $data);
		
		$this->load->view('client/registration', $data);
	}
		
	/**
	* Смена пароля
	*/
	public function change_password() 
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
				
		$this->emails->send_system_mail($user->email, 5, $message_info);			

		redirect(base_url().'account/registration?activity=enter');		
	}
			
	/**
	* Регистрация нового пользователя
	*/
	public function new_user()
	{
		$data = array(
			'title' => "Регистрация",
			'error' => "",
			'select_item' => "",
			'activity' => "reg"
		);
		$data = array_merge($this->standart_data, $data);
			
		$user = (object)$this->input->post();
			
		//Если id пустой то добавляем нового пользователя
		if (!$this->users->is_unique(array('name'=>$user->name)))
		{
			$data['error'] ="Пользователь с таким именем уже зарегистрирован";
			$this->load->view('client/registration', $data);	
		} 
		elseif (!$this->users->is_unique(array('email'=>$user->email)))
		{
			$data['error'] ="Такой email уже зарегистрирован";
			$this->load->view('client/registration', $data);						
		} 
		else 
		{	
			$pass = $user->conf_password;
		
			$user->password = md5($user->password);
			unset($user->conf_password);
			$this->users->insert($user);
			
			$user_id = $this->db->insert_id();
			$group = $this->users_groups->get_item_by(array("name" => "customer"));
				
			$users2users_groups->users_group_id = $group->id;
			$users2users_groups->user_id = $user_id;
			$this->db->insert('users2users_groups', $users2users_groups);

			$message_info = array(
				"user_name" => $user->name,
				"login" => $user->email,
				"password" => $pass
			);
				
			$this->emails->send_system_mail($user->email, 4, $message_info);				
			
			if($this->users->login($user->email, $user->password)) redirect(base_url().'cabinet');
		}			
	}
}