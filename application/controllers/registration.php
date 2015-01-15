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
	
	public function admin_enter()
	{
		$data = array(
			'title' => "Вход",
			'meta_title' => "Вход",
			'error' => " "
		);
		$this->load->view('admin/enter.php', $data);
	}
	
	
	/*Авторизация пользователя*/	
	public function do_admin_enter()
	{
		$data = array(
			'title' => "Вход",
			'meta_title' => "Вход",
			'error' => " "
		);
		
		$email = $this->input->post('email');
		$password = md5($this->input->post('password'));			
		$authdata = $this->users->login($email, $password);

		if (!$authdata['logged_in'])
		{
			$data['error'] = "Данные не верны. Повторите ввод";		
			$this->load->view('admin/enter.php', $data);	
		} 
		else 
		{
			redirect(base_url().'admin');	
		}	
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
				'title' => "Корзина",
				'meta_title' => "",
				'meta_keywords' => "",
				'meta_description' => "",
				'cart' => $this->cart->get_all(),
				'total_price' => $this->cart->total_price(),
				'total_qty' => $this->cart->total_qty(),
				'selects' => array(
					'method_delivery' => $this->config->item('method_delivery'),
					'method_pay' => $this->config->item('method_pay')
				),
				'top_menu' => $this->top_menu->items,
				'user' => $this->users->get_item_by(array("id" => $user_id))
			);
			
			$data['error'] = "Данные не верны. Повторите ввод";		
			$this->load->view('client/cart.php', $data);	
		} 
		else 
		{
			redirect(base_url().'cabinet');	
		}	
	}
	
	//Выход
	public function do_exit()
	{
		$role = $this->session->userdata('role');
		$authdata = array(
			'user_id' => '',
			'user_name' => '',
			'logged_in' => ''
			);
		$this->session->unset_userdata($authdata);
		
		$role == "admin" ? redirect(base_url().'admin') : redirect(base_url().'pages/cart');
	}
	
	/*Вывод формы востановления пароля*/
	public function forgot_pass()
	{
		$data = array(
			'title' => "Востановление пароля",
			'meta_title' => "Востановление пароля",
			'error' => " "
		);
		$this->load->view('admin/forgot_form.php', $data);			
	}
	
	/*Вывод формы сброса пароля*/
	public function reset_password()
	{
		$data = array(
			'title' => "Сброс пароля",
			'meta_title' => "Сброс пароля",
			'error' => " ",
			'email' => $this->input->get('email'),
			'secret' => $this->input->get('secret')
		);	
		$this->load->view('admin/new_pass.php', $data);
	}
	
	/*Востановление пароля*/	
	public function forgot_password()
	{
		$this->form_validation->set_rules('email', 'E-mail', 'trim|xss_clean|required|valid_email');
		if($this->form_validation->run() == FALSE)
		{
			$data = array(
				'title' => "Востановление пароля",
				'meta_title' => "Востановление пароля",
				'error' => "Не правильно введен e-mail"
			);

			$this->load->view('admin/forgot_form.php', $data);	
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
				$message = 'Перейдите по ссылке для изменения пароля '.base_url()."registration/reset_password.html?email=$user_email&secret=$secret";
				
				if (!$this->mail->send_mail($user_email, $subject, $message))
				{
				
					$data = array(
						'title' => 'Востановление пароля',
						'meta_title' => "Востановление пароля",
						'error' => "Не удалось отправить письмо для востановления пароля"
					);

					$this->load->view('admin/forgot_form.php', $data);	
				}
				else
				{					
					$data = array(
						'title' => "Вход",
						'meta_title' => "Вход",
						'error' => ""
					);	
					
					$email->role == "admin" ? redirect(base_url().'admin') : redirect(base_url().'cart');			
				}
			} 
			else
			{
				$data = array(
					'title' => "Востановление пароля",
					'meta_title' => "Востановление пароля",
					'error' => "E-mail не зарегистрирован в системе. Введите правильный e-mail и повторите попытку."
				);

				$this->load->view('admin/forgot_form.php', $data);	
			}
		}
	}
		
	/*Смена пароля*/
	public function change_pwd() 
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
			
			$this->load->view('admin/new_pass.php', $data);
		} 
		else 
		{
			$user_email = $this->input->post('user_email');
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

		$email->role == "admin" ? redirect(base_url().'admin') : redirect(base_url().'cart');		
	}
			
	/*----------Клиентская часть----------*/
	
	public function register_user()
	{
		$menu = $this->menus->top_menu;	

		$editors = $this->users->new_editors;
		$user = new stdClass();
		foreach ($editors as $tabs)
		{
			foreach ($tabs as $item => $value)
			{
				$user->$item = "";
			}
		}		
	
		$data = array(
			'title' => "Регистрация",
			'meta_title' => "",
			'meta_keywords' => "",
			'meta_description' => "",
			'error' => "",
			'top_menu' => $this->top_menu->items,
			'editors' => $editors,
			'content' => $user
		);
		
		
		$this->load->view('client/register_user', $data);		
	}
	
	public function edit_new_user()
	{
		$menu = $this->menus->top_menu;
		
		$editors = $this->users->new_editors;
		$post = $this->input->post();
		
		$content = $this->$type->editors_post()->data;

		$data = array(
			'title' => "Регистрация",
			'meta_title' => "",
			'meta_keywords' => "",
			'meta_description' => "",
			'error' => "",
			'menu' => $menu,
			'editors' => $editors,
			'content' => $content
		);			
		
		$this->form_validation->set_rules('email', 'Email', 'trim|xss_clean|required|valid_email|callback_email_not_exists');
		$this->form_validation->set_rules( 'name','Name','trim|xss_clean|required|min_length[4]|max_length[25]|callback_username_not_exists');	
					
		$this->form_validation->set_rules('password', 'Password', 'trim|xss_clean|required');
		$this->form_validation->set_rules('conf_password',  'Confirm password',  'required|min_length[3]|matches[password]');
					
		//Валидация формы
		if($this->form_validation->run() == FALSE)
		{
			//Если валидация не прошла выводим сообщение об ошибке
			$this->load->view('client/register_user.php', $data);			
		}
		else
		{	
			//Если id пустой то добавляем нового пользователя
			if (!$this->users->non_requrrent(array('name'=>$data['content']->name)))
			{
				$data['error'] ="Пользователь с таким именем уже зарегистрирован";
				$this->load->view('client/register_user.php', $data);	
			} 
			elseif (!$this->users->non_requrrent(array('email'=>$data['content']->email)))
			{
				$data['error'] ="Такой email уже зарегистрирован";
				$this->load->view('client/register_user.php', $data);						
			} 
			else 
			{	
				$pass = $content->conf_password;
				$data['content']->role = "customer";
				$this->users->insert($data['content']);
				
				$message_info = array(
					"user_name" => $content->name,
					"login" => $content->email,
					"password" => $pass
				);
				
				$this->emails->send_mail($content->email, 'registration', $message_info);				
				
				if($this->users->login($content->email, $content->password)) redirect(base_url().'registration/cabinet');
			}
		}			
	}
}