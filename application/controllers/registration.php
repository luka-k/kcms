<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Управление пользователями

class Registration extends CI_Controller 
{	
	public function __construct()
	{
		parent::__construct();
		
		$this->config->load('order_config');
		
		$data = array(
			'title' => "Вход",
			'meta_title' => "Вход",
			'error' => " "
		);
	}
	
	
	/*Авторизация пользователя*/	
	public function do_admin_enter($field="email", $field="pass")
	{
		$data = array(
			'title' => "Вход",
			'meta_title' => "Вход",
			'error' => " "
		);
		
		$email = $this->input->post('email');
		$password = md5($this->input->post('password'));			
		$authdata = $this->users->login($email, $password, 'admin');

		if (!$authdata['logged_in'])
		{
			$data['error'] = "Данные не верны. Повторите ввод";		
			$this->load->view('admin/enter.php', $data);	
		} 
		else 
		{
			redirect(base_url().'admin/admin_main');	
		}	
	}
	
	/*Авторизация покупателя*/	
	public function do_enter()
	{
		$email = $this->input->post('login');
		$password = md5($this->input->post('password'));			
		$authdata = $this->users->login($email, $password, 'customer');
		if (!$authdata['logged_in'])
		{
			$top_menu = $this->menus->top_menu;		
			$footer_menu = $this->menus->footer_menu;
		
			$slider = $this->slider->get_list(FALSE);
			$slider = $this->images->get_img_list($slider, 'slider', 'slider');	
			
			$cart = $this->cart->get_all();
			$total_price = $this->cart->total_price();
			$total_qty = $this->cart->total_qty();
		
			$user_id = $this->session->userdata('user_id');
			$user = $this->users->get_item_by(array("id" => $user_id));
	
			$data = array(
				'title' => "Корзина",
				'meta_title' => "",
				'meta_keywords' => "",
				'meta_description' => "",
				'cart' => $cart,
				'total_price' => $total_price,
				'total_qty' => $total_qty,
				'selects' => array(
					'method_delivery' => $this->config->item('method_delivery'),
					'method_pay' => $this->config->item('method_pay')
				),
				'top_menu' => $top_menu,
				'footer_menu' => $footer_menu,
				'tree' => $this->categories->get_tree(0, "parent_id"),
				'slider' => $slider,
				'user' => $user
			);
			
			$data['error'] = "Данные не верны. Повторите ввод";		
			$this->load->view('client/cart_registration.php', $data);	
		} 
		else 
		{
			redirect(base_url().'pages/cart/3');	
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
		if($role == "admin")
		{
			redirect(base_url().'admin');
		}
		else
		{
			redirect(base_url().'pages/cart');
		}
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
				$secret = md5($this->config->item('allowed_types'));
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
					
					if($email->role == "admin")
					{
						redirect(base_url().'admin');
					}
					else
					{
						redirect(base_url().'pages/cart');
					}				
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

		if($email->role == "admin")
		{
			redirect(base_url().'admin');
		}
		else
		{
			redirect(base_url().'pages/cart');
		}	
	}
			
	/*----------Клиентская часть----------*/
	
	public function register_user()
	{
		$top_menu = $this->menus->top_menu;		
		$footer_menu = $this->menus->footer_menu;
	
		$slider = $this->slider->get_list(FALSE);
		$slider = $this->images->get_img_list($slider, 'slider', 'slider');	
		
		$cart = $this->cart->get_all();
		
		$total_price = $this->cart->total_price();
		$total_qty = $this->cart->total_qty();
		
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
			'title' => "Log In/Registration",
			'meta_title' => "",
			'meta_keywords' => "",
			'meta_description' => "",
			'cart' => $cart,
			'total_price' => $total_price,
			'total_qty' => $total_qty,
			'error' => "",
			'top_menu' => $top_menu,
			'footer_menu' => $footer_menu,
			'slider' => $slider,
			'tree' => $this->categories->get_tree(0, "parent_id"),
			'editors' => $editors['main'],
			'content' => $user
		);
		
		
		$this->load->view('client/register_user.php', $data);		
	}
	
	public function edit_new_user()
	{
		$top_menu = $this->menus->top_menu;		
		$footer_menu = $this->menus->footer_menu;
		
		$slider = $this->slider->get_list(FALSE);
		$slider = $this->images->get_img_list($slider, 'slider', 'slider');

		$cart = $this->cart->get_all();
		
		$total_price = $this->cart->total_price();
		$total_qty = $this->cart->total_qty();
		
		$editors = $this->users->new_editors;
		$post = $this->input->post();
		
		$content = editors_post($editors, $post);
		$content->password = md5($content->password);

		$data = array(
			'title' => "Log In/Registration",
			'meta_title' => "",
			'meta_keywords' => "",
			'meta_description' => "",
			'cart' => $cart,
			'total_price' => $total_price,
			'total_qty' => $total_qty,
			'error' => "",
			'top_menu' => $top_menu,
			'footer_menu' => $footer_menu,
			'slider' => $slider,
			'tree' => $this->categories->get_tree(0, "parent_id"),
			'editors' => $editors['main'],
			'content' => $content
		);		
		
		$this->form_validation->set_rules('email', 'Email', 'trim|xss_clean|required|valid_email|callback_email_not_exists');
		$this->form_validation->set_rules( 'first_name','Name','trim|xss_clean|required|min_length[4]|max_length[25]|callback_username_not_exists');	
					
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
			if (!$this->users->non_requrrent(array('email'=>$data['content']->email)))
			{
				$data['error'] ="Такой email уже зарегистрирован";
				$this->load->view('client/register_user.php', $data);						
			} 
			else 
			{	
				$pass = $content->conf_password;
				unset($data['content']->conf_password);
				$data['content']->role = "customer";
				$this->users->insert($data['content']);
				
				$message_info = array(
					"user_name" => $content->first_name,
					"login" => $content->email,
					"password" => $pass
				);
				
				$this->emails->send_mail($content->email, 'registration', $message_info);				
				
				if($this->users->login($content->email, $content->password, 'customer'))
				{
					redirect(base_url().'registration/cabinet');
				}
			}
		}			
	}
	
	/*----------Личный кабинет----------*/
	public function cabinet()
	{
		if (!$this->session->userdata('logged_in'))
		{
			redirect(base_url().'pages/cart');
		}
		else
		{
			$menu = $this->menus->top_menu;
			$cart = $this->cart->get_all();
			$total_price = $this->cart->total_price();
			$total_qty = $this->cart->total_qty();	

			$orders = $this->orders->get_list(array("user_id" => $this->session->userdata('user_id')));
			
			$orders_info = array();
			foreach ($orders as $key => $order)
			{	
				$orders_info[$key] = new stdClass();	
			
				$date = new DateTime($order->date);
			
				$order_items = $this->orders_products->get_list(array("order_id" => $order->order_id));
			
				$orders_info[$key] = (object)array(
					"order_id" => $order->order_id,
					"status" => $order->status_id,
					"order_products" => $order_items,
					"delivery_id" => $order->delivery_id,
					"payment_id" => $order->payment_id,
					"date" => date_format($date, 'Y-m-d'),
					"name" => $order->user_name,
					"phone" => $order->user_phone,
					"email" => $order->user_email,
					"address" => $order->user_address
				);
				
				$status_id = $this->config->item('order_status');
				foreach ($status_id as $value => $title)
				{
					if ($orders_info[$key]->status == $value) $orders_info[$key]->status = $title;
				}
			
			}
			
			$user_id = $this->session->userdata('user_id');
			$user = $this->users->get_item_by(array("id" => $user_id));
			
			
			
			$data = array(
				'title' => "Личный кабинет",
				'meta_title' => "",
				'meta_keywords' => "",
				'meta_description' => "",
				'error' => "",
				'name' => $this->session->userdata('user_name'),
				'user' => $user,
				'menu' => $menu,
				'cart' => $cart,
				'total_price' => $total_price,
				'total_qty' => $total_qty,
				'orders' => $orders_info,
				'selects' => array(
					'delivery_id' => $this->config->item('method_delivery'),
					'payment_id' => $this->config->item('method_pay')
				),
				'status_id' => $this->config->item('order_status')
			);
			$this->load->view('client/cabinet.php', $data);
		}
	}
}