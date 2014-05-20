<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Admin class

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		//$this->load->model('upload_model');
		//$this->load->model('pages_model');
		$this->load->model('menu_model');

		$this->load->model('reg_model');
		$this->load->model('admin_model');
	}
		
	public function index()
	{
		$data['meta_title'] = "Вход";
		$data['error'] = " ";
		if (!$this->session->userdata('logged_in'))
		{
			$temp[] = 'enter.php';	
		} 
		else
		{
			redirect(base_url().'admin/admin_main');
		}
		$this->temp_model->view_temp($temp, $data, "admin");
	}
	
	/*Авторизация пользователя*/	
	public function do_enter($field="email", $field="pass")
	{
		$email = $this->input->post('email');
		$pass = md5($this->input->post('pass'));			
		$authdata = $this->reg_model->login($email, $pass);
		$data['meta_title'] = "Вход";
		if (!$authdata['logged_in'])
		{
			$data['error'] = "Данные не верны. Повторите ввод";		
			$temp[] = 'enter.php';		
		} 
		else 
		{
			redirect(base_url().'admin/admin_main');		
		}
		$this->temp_model->view_temp($temp, $data, "admin");	
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
		redirect(base_url().'admin');
	}
	
	/*Вывод формы востановления пароля*/
	public function forgot_pass()
	{
		$data['meta_title'] = "Востановление пароля";
		
		$temp[] = 'forgot_form.php';
		$this->temp_model->view_temp($temp, $data, 'admin');			
	}
	
	/*Вывод формы сброса пароля*/
	public function reset_password()
	{
		$data['meta_title'] = "Сброс пароля";
		$data['email'] = $this->input->get('email');
		$data['secret'] = $this->input->get('secret');
		$temp[] = 'new_pass.php';
		$this->temp_model->view_temp($temp, $data, 'admin');		
	}
	
	/*Востановление пароля*/	
	public function forgot_password()
	{
		$this->form_validation->set_rules('email', 'E-mail', 'trim|xss_clean|required|valid_email');
		if($this->form_validation->run() == FALSE)
		{
            $data['meta_title']="Востановление пароля";
			$data['error']='Не правильно введен e-mail';
			$temp[] = 'forgot_form.php';
        } 
		else 
		{
			$email = $this->input->post('email');
			$user_email = $this->reg_model->get_user_email($email);
			if($user_email) 
			{
				$from = 'admin@admin.com';
				$who = 'Admin';
				$to = $user_email;
				$subject = 'Forgot password';
				$this->config->load('upload_config');
				$secret = md5($this->config->item('allowed_types'));

				$query = $this->db->query("UPDATE users SET secret=".$this->db->escape($secret)." WHERE email=".$this->db->escape($email)."");
				$message = 'Перейдите по ссылке для изменения пароля '.base_url()."admin/reset_password.html?email=$email&secret=$secret";
				if (!$this->email_model->send_mail($from, $who, $to, $subject, $message))
				{
					$data['meta_title']="Востановление пароля";
					$data['error']='Не удалось отправить письмо для востановления пароля';
					$temp[] = 'forgot_form.php';
				}
				else
				{
					$data['meta_title'] = "Вход";
					$data['error'] = "";	
					$temp[] = 'enter.php';
				}
			} 
			else 
			{
				$data['title']="Востановление пароля";
				$data['error']='The email is not exists in system. Please, try again';
				$temp[] = 'forgot_form.php';
			}
		}
		$this->temp_model->view_temp($temp, $data, 'admin');	
	}
		
	/*Смена пароля*/
	public function change_pwd($field="email") 
	{
		$this->form_validation->set_rules('password', 'Password', 'trim|xss_clean|required');
		$this->form_validation->set_rules('conf_password',  'Confirm password',  'required|min_length[3]|matches[password]');
			
		if($this->form_validation->run() == FALSE)
		{
			$data['meta_title'] = "Востановление пароля";	
			$temp[] = 'new_pass.php';
		} 
		else 
		{
			$email = $this->input->post('email');
			$secret = $this->input->post('secret');
			$password = $this->input->post('password');
			$new_password=md5($password);
			$this->reg_model->insert_new_pass($email, $new_password, $secret); 
			
			$from = 'admin@admin.com';
			$who = 'Admin';
			$to = $email;
			$subject = 'Your new password';
			$message = 'You new password to access to your account is  '. $password;
			$this->email_model->send_mail($from, $who, $to, $subject, $message);
			$temp[] = 'enter.php';
			$data['meta_title'] = "Вход";
			$data['error'] = "";
		}
		$this->temp_model->view_temp($temp, $data, 'admin');	
	}
	
	//вывод всех страниц в админке
	public function admin_main()
	{
		$data = array(
			'meta_title' => "CMS",
			'error' => " ",
			'name' => $this->session->userdata('user_name')
		);
		$temp[] = 'top-menu.php';
		$temp[] = 'admin.php';	
		$this->temp_model->view_temp($temp, $data, "admin");
	}
	
	public function categories()
	{
		$data = array(
			'cat' => $this->categories->get_list(FALSE),
			'meta_title' => "CMS",
			'error' => " ",
			'name' => $this->session->userdata('user_name')
		);
		$temp[] = 'top-menu.php';
		$temp[] = 'categories.php';	
		$this->temp_model->view_temp($temp, $data, "admin");		
	}
	
	public function category($cat_id=false)
	{
		$data = array(
			'meta_title' => "Редактировать категорию",
			'error' => "",
			'name' => $_COOKIE['auth']['name'],
			'cat' => $this->admin_model->get_cat()
		);
		
		if ($cat_id===false)
		{
			$data['cat_info'] = array (
				'id' => "",
				'title' => "",
				'cat_desc' => '',
				'root' => ""
			);
		}
		else
		{
			$data['cat_info'] = $this->categories->get_item_by(array('id' => $cat_id));
		}
		$temp[] = 'top-menu.php';
		$temp[] = 'edit_cat.php';	
		$this->temp_model->view_temp($temp, $data, "admin");	
	}
	
	
	//вывод всех страниц в админке
	public function pages($cat_id = false)
	{
		$data = array(
			'cat' => $this->categories->get_list(FALSE),
			'meta_title' => "Страницы",
			'error' => " ",
			'name' => $this->session->userdata('user_name')
		);
		
		if ($cat_id === false)
		{
			$data['pages'] = $this->pages->get_list(FALSE);
		}
		else
		{
			$data['pages'] = $this->pages->get_list(array('cat_id' => $cat_id));
		}
		
		$temp[] = 'top-menu.php';
		$temp[] = 'pages.php';	
		$this->temp_model->view_temp($temp, $data, "admin");
	}
	
	//Вывод страниц редактирования отдельной страницы	
	public function page($id=false)
	{
		$data = array(
			'meta_title' => "Редактировать страницу",
			'error' => "",
			'name' => $this->session->userdata('user_name'),
			'cat' => $this->categories->get_list(FALSE)			
		);
		if ($id===false)
		//Если id пуст то выводим пустую форму редактирования страницы для ее создания
		{
			$data['page'] = array (
				'id' => "",
				'autor' => "",
				'publish_date' => "",
				'status' => "1",
				'cat_id' => "",
				'title' => "",
				'meta_title' => '',
				'keywords' => "",
				'description' => "",
				'url' => "",
				'full_text' => "",
				'image' => ""
			);
		}
		else
		//Если id не пуст выводим инфу страницы из базы
		{
			
			//$data['page'] = $this->admin_model->get_page($id);
			$data['page'] = $this->pages->get_item_by(array('id' => $id));
		}
		$temp[] = 'top-menu.php';
		$temp[] = 'edit_page.php';	
		$this->temp_model->view_temp($temp, $data, "admin");		
	}
	
	//Удаление страницы
	public function delete_page($id)
	{
		if($this->pages->delete($id))
		{
			redirect(base_url().'admin/pages');
		}
	}
	
	//Удаление категории
	public function delete_cat($cat_id)
	{
		if($this->categories->delete($cat_id))
		{
			redirect(base_url().'admin/categories');
		}
	}
	
	//Редактирование страницы
	public function edit_page()
	{
		$data = array(
			'meta_title' => "Редактировать страницу",
			'name' => $this->session->userdata('user_name'),
			'error' => " ",
			'cat' => $this->categories->get_list(FALSE),
			'page' => array (
				'id' => htmlspecialchars($this->input->post('id')),
				'autor' => $this->input->post('autor'),
				'publish_date' => $this->input->post('publish_date'),
				'status' => $this->input->post('status'),
				'cat_id' => $this->input->post('cat_id'),
				'title' => htmlspecialchars($this->input->post('title')),
				'meta_title' => htmlspecialchars($this->input->post('meta_title')),
				'keywords' => htmlspecialchars($this->input->post('keywords')),
				'description' => htmlspecialchars($this->input->post('description')),
				'url' => translit_url($this->input->post('title')),
				'full_text' => $this->input->post('full_text')
			)				
		);
			
		//Валидация формы
		$this->form_validation->set_rules('title', 'Title', 'trim|xss_clean|required');
		
		if($this->form_validation->run() == FALSE)
		{
			//Если валидация не прошла выводим сообщение об ошибке
			$temp[] = 'top-menu.php';
			$temp[] = 'edit_page.php';	
			$this->temp_model->view_temp($temp, $data, "admin");				
		}
		else
		{
			//Если валидация прошла успешно проверяем переменную id
			if($data['page']["id"]==NULL)
			{
				//Если id пустая создаем новую страницу в базе
				$fields = array(
					'title' => $data['page']["title"],
					'cat_id' => $data['page']["cat_id"]
				);
				if($this->pages->non_requrrent($fields))
				{
					$this->pages->insert($data['page']);
					redirect(base_url().'admin/pages');
				}
				else
				{
					$data['error'] = "Страница с таким именем в этой категории уже ссуществует.";
					$temp[] = 'top-menu.php';
					$temp[] = 'edit_page.php';	
					$this->temp_model->view_temp($temp, $data, "admin");					
				}
			}
			else
			{
				//Если id не пустая вносим изменения.
				$this->pages->update($data['page']['id'], $data['page']);
				redirect(base_url().'admin/pages');
			}
		}
	}
	
	//Редактирование категории
	public function edit_cat()
	{
		$data = array(
			'meta_title' => "Редактировать страницу",
			'name' => $this->session->userdata('user_name'),
			'error' => " ",
			'cat' => $this->admin_model->get_cat(),
			'cat_info' => array (
				'id' => htmlspecialchars($this->input->post('id')),
				'title' => $this->input->post('title'),
				'url' => translit_url($this->input->post('title')),
				'root' => $this->input->post('root'),
				'cat_desc' => $this->input->post('cat_desc')
				)				
		);

		//Валидация формы
		$this->form_validation->set_rules('title', 'Title', 'trim|xss_clean|required');
		
		if($this->form_validation->run() == FALSE)
		{
			//Если валидация не прошла выводим сообщение об ошибке
			$temp[] = 'top-menu.php';
			$temp[] = 'edit_cat.php';	
			$this->temp_model->view_temp($temp, $data, "admin");				
		}
		else
		{
			//Если валидация прошла успешно проверяем переменную id
			if($data['cat_info']["id"]==NULL)
			{
				//Если id пустая создаем новую страницу в базе
				$this->categories->insert($data['cat_info']);
			}
			else
			{

				//Если id не пустая вносим изменения.
				$this->categories->update($data['cat_info']['id'], $data['cat_info']);
			}			
		}
		redirect(base_url().'admin/categories');
	}
	
	public function settings()
	{
		$data = array(
			'meta_title' => "Настройки сайта",
			'name' => $this->session->userdata('user_name'),
			'error' => "",
			'cat' => $this->categories->get_list(FALSE),
			'settings' => $this->settings->get_item_by(array('id' => 1))
		);
		$temp[] = 'top-menu.php';
		$temp[] = 'settings.php';	
		$this->temp_model->view_temp($temp, $data, "admin");			
	}
	
	public function edit_settings()
		{
			$data = array(
				'meta_title' => "Редактировать страницу",
				'name' => $this->session->userdata('user_name'),
				'error' => " ",
				'cat' => $this->categories->get_list(FALSE),
				'settings' => array (
					'id' => $this->input->post('id'),
					'site_title' => $this->input->post('site_title'),
					'site_description' => $this->input->post('site_description'),
					'site_keywords' => $this->input->post('site_keywords'),
					'main_page_type' => $this->input->post('main_page_type'),
					'main_page_cat' => $this->input->post('main_page_cat'),
					'main_page_id' => htmlspecialchars($this->input->post('main_page_id')),
					'site_offline' => $this->input->post('site_offline'),
					'offline_text' => $this->input->post('offline_text')
				)				
			);

			//Валидация формы
			$this->form_validation->set_rules('main_page_id', 'Main_page_id', 'trim|xss_clean|required');
		
			if($this->form_validation->run() == FALSE)
			{
				//Если валидация не прошла выводим сообщение об ошибке
				$temp[] = 'top-menu.php';
				$temp[] = 'settings.php';	
				$this->temp_model->view_temp($temp, $data, "admin");				
			}
			else
			{
				//var_dump($data['settings']);
				$this->settings->update(1, $data['settings']);
				//$this->admin_model->edit_settings($data['settings']);
			}
		redirect(base_url().'admin/settings');
		}
	
	public function menus()
	{
		$data = array(
			'cat' => $this->categories->get_list(FALSE),
			'meta_title' => "Меню",
			'error' => " ",
			'name' => $this->session->userdata('user_name'),
			'menus' => $this->menus->get_list(FALSE)
		);
		$temp[] = 'top-menu.php';
		$temp[] = 'menus.php';	
		$this->temp_model->view_temp($temp, $data, "admin");		
	}
	
	public function menu($id=false)
	{
		if ($id===false)
		//Если id пуст то выводим пустую форму редактирования страницы для ее создания
		{
			$data = array(
				'meta_title' => "Редактировать меню",
				'error' => " ",
				'name' => $this->session->userdata('user_name'),
				'cat' => $this->categories->get_list(FALSE),
				'menu' => array (
					'id' => "",
					'name' => "",
					'title' => "",
					'status' => "1"
				),
				'links' => NULL
			);
		}
		else
		//Если id не пуст выводим инфу страницы из базы
		{
			$data = array(
				'meta_title' => "Редактировать меню",
				'name' => $this->session->userdata('user_name'),
				'error' => "",
				'cat' => $this->categories->get_list(FALSE),
				'menu' => $this->menus->get_item_by(array('id' => $id)),
				'links' => $this->menus_data->get_list(array('menu_id' => $id))
			);
		}
		$temp[] = 'top-menu.php';
		$temp[] = 'edit_menu.php';	
		$this->temp_model->view_temp($temp, $data, "admin");		
	}
	
	public function edit_menu()
	{
		$data = array(
			'meta_title' => "Редактировать меню",
			'name' => $this->session->userdata('user_name'),
			'error' => " ",
			'cat' => $this->categories->get_list(FALSE),
			'menu' => array (
				'id' => htmlspecialchars($this->input->post('id')),
				'title' => $this->input->post('title'),
				'name' => $this->input->post('name'),
				'status' => $this->input->post('status')
				)				
		);

		//Валидация формы
		$this->form_validation->set_rules('title', 'Title', 'trim|xss_clean|required');
		
		if($this->form_validation->run() == FALSE)
		{
			//Если валидация не прошла выводим сообщение об ошибке
			$temp[] = 'top-menu.php';
			$temp[] = 'edit_menu.php';	
			$this->temp_model->view_temp($temp, $data, "admin");	
		}
		else
		{
			$this->menu_model->edit_menu($data['menu']);	
			redirect(base_url().'admin/menus');			
		}
				
	}
	
	public function delete_menu()
	{
		$this->menus->delete($this->input->get('id'));
		redirect(base_url().'admin/menus');
	}
	
	public function link($menu_id, $link_id)
	{
		if ($link_id==0)
		//Если id пуст то выводим пустую форму редактирования страницы для ее создания
		{
			$data = array(
				'meta_title' => "Редактировать меню",
				'error' => " ",
				'name' => $this->session->userdata('user_name'),
				'cat' => $this->categories->get_list(FALSE),
				'pages' => $this->pages->get_list(FALSE),
				'link' => array (
					'id' => "",
					'menu_id' => $menu_id,
					'title' => "",
					'url' => "",
					'item_type' => "2",
					'hidden' => "0",
				)
			);
		}
		else
		//Если id не пуст выводим инфу страницы из базы
		{
			$data = array(
				'meta_title' => "Редактировать меню",
				'name' => $this->session->userdata('user_name'),
				'error' => "",
				'cat' => $this->categories->get_list(FALSE),
				'pages' => $this->pages->get_list(FALSE),
				'link' => $this->menu_model->get_link($link_id)
			);
		}
		$temp[] = 'top-menu.php';
		$temp[] = 'edit_link.php';	
		$this->temp_model->view_temp($temp, $data, "admin");			
	}
	
	public function edit_link()
	{
		$link = array(
			'id' => $this->input->post('id'),
			'menu_id' => $this->input->post('menu_id'),
			'title' => $this->input->post('title'),
			'url' => $this->input->post('url'),
			'hidden' => $this->input->post('hidden'),
			'item_type' => $this->input->post('type')
		);
		//var_dump($link);
		$data = array(
			'meta_title' => "Редактировать меню",
			'name' => $_COOKIE['auth']['name'],
			'error' => "",
			'cat' => $this->categories->get_list(FALSE),
			'pages' => $this->pages->get_list(FALSE),
			'links' => 0,
			'link' => $link
			);		
		
		//Валидация формы
		$this->form_validation->set_rules('title', 'Title', 'trim|xss_clean|required');
		
		if($this->form_validation->run() == FALSE)
		{
			//Если валидация не прошла выводим сообщение об ошибке
			$data['links'] = array (
				'id' => "",
				'menu_id' => "",
				'title' => "",
				'url' => "",
				'item_type' => "2",
				'hidden' => "0",
			);
			$temp[] = 'top-menu.php';
			$temp[] = 'edit_link.php';	
			$this->temp_model->view_temp($temp, $data, "admin");	
		}
		else
		{
			if ($link['item_type'] == 1)
			{
				$url = $this->menu_model->get_url($this->input->post('page_id'), $link['item_type']);
			}
			elseif ($link['item_type'] == 2)
			{
				$url = $this->menu_model->get_url($this->input->post('cat_id'), $link['item_type']);
			}
			$link['url'] = $url;
			//var_dump($link);
			$this->menu_model->edit_link($link);
			//echo $link['id'];
			redirect(base_url()."admin/menu/".$link['menu_id']."#tabr2");		
		}
	}
	
	public function delete_link($menu_id, $id)
	{
		$this->menus_data->delete($id);
		redirect(base_url()."admin/menu/".$menu_id."#tabr2");	
	}
	
}