<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Admin class

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}
		
	public function index()
	{
		$data = array(
			'title' => "Вход",
			'meta_title' => "Вход",
			'error' => " "
		);
		
		if (!$this->session->userdata('logged_in'))
		{
			$this->load->view('admin/enter.php', $data);	
		} 
		else
		{
			redirect(base_url().'admin/admin_main');
		}
	}
	
	/*Авторизация пользователя*/	
	public function do_enter($field="email", $field="pass")
	{
		$email = $this->input->post('email');
		$pass = md5($this->input->post('pass'));			
		$authdata = $this->users->login($email, $pass);
		$data['meta_title'] = "Вход";
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
				$subject = 'Forgot password';
				$message = 'Перейдите по ссылке для изменения пароля '.base_url()."admin/reset_password.html?email=$user_email&secret=$secret";
				
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
					
					$this->load->view('admin/enter.php', $data);				
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

			$subject = 'Your new password';
			$message = 'You new password to access to your account is  '. $password;
			$this->mail->send_mail($user_email, $subject, $message);
			$data = array(
				'meta_title' => "Вход",
				'error' => " ",
			);
		}
		$this->load->view('admin/enter.php', $data);	
	}
	
	//вывод всех страниц в админке
	public function admin_main()
	{
		if (!$this->session->userdata('logged_in'))
		{
			$data = array(
				'title' => "Вход",
				'meta_title' => "Вход",
				'error' => ""
			);
			
			$this->load->view('admin/enter.php', $data);	
		} 
		else
		{
			$data = array(
				'title' => "CMS",
				'meta_title' => "CMS",
				'error' => "",
				'name' => $this->session->userdata('user_name')
			);

			$this->load->view('admin/admin.php', $data);
		}
	}
	
	//Вывод разделов. 
	public function parts($id = false)
	{
		if (!$this->session->userdata('logged_in'))
		{
			$data = array(
				'title' => "Вход",
				'meta_title' => "Вход",
				'error' => ""
			);
			
			$this->load->view('admin/enter.php', $data);	
		} 
		else
		{
			$data = array(
				'title' => "Разделы",
				'meta_title' => "Разделы",
				'error' => "",
				'name' => $this->session->userdata('user_name'),
				'parts' => $this->parts->get_list(FALSE),
				'tree' => $this->parts->get_sub_tree(0, "parent")
			);
			if ($id == false)
			{
				//Если id не указан выводим все разделы
				$this->load->view('admin/parts.php', $data);
			}
			else
			{
				//Если есть id выводим редактирование раздела.
				$data['editors'] = $this->parts->editors;
				$data['content'] = $this->parts->get_item_by(array('id' => $id));
				$this->load->view('admin/edit-part.php', $data);
			}
		}		
	}
	
	//Внесение изменений в раздел
	public function edit_part()
	{
		if (!$this->session->userdata('logged_in'))
		{
			$data = array(
				'title' => "Вход",
				'meta_title' => "Вход",
				'error' => ""
			);
			
			$this->load->view('admin/enter.php', $data);	
		} 
		else
		{
			$data = array(
				'title' => "Разделы",
				'meta_title' => "Разделы",
				'error' => "",
				'name' => $this->session->userdata('user_name'),
				'parts' => $this->parts->get_list(FALSE)
			);
		
			$editors = $this->parts->editors;
		
			foreach ($editors as $edit)
			{
				foreach ($edit as $key => $value)
				{
					if ($value[1] == 'tiny')
					{
						$data['part'][$key] = $this->input->post($key);				
					}
					else
					{
						$data['part'][$key] = htmlspecialchars($this->input->post($key));	
					}
				}
			}
			
			//Валидация формы
			$this->form_validation->set_rules('title', 'Title', 'trim|xss_clean|required');
		
			if($this->form_validation->run() == FALSE)
			{
				//Если валидация не прошла выводим сообщение об ошибке
				$this->load->view('admin/edit-part.php', $data);			
			}
			else
			{
				if ($data['part']['id'] == NULL)
				{
					//Если id нет то оставлена место добавить код для добавления раздела
					redirect(base_url().'admin/parts');
				}
				else
				{
					//Редактируем раздел по id
					$this->parts->update($data['part']['id'], $data['part']);
					redirect(base_url().'admin/parts');
				}	
			}		
		}		
	}
	
	/*------------Редактирование страниц разделов------------*/

	//Вывод страниц раздела
	public function pages($part_id = false)
	{
		if (!$this->session->userdata('logged_in'))
		{
			$data = array(
				'title' => "Вход",
				'meta_title' => "Вход",
				'error' => ""
			);
			$this->load->view('admin/enter.php', $data);	
		} 
		else
		{
			$data = array(
				'title' => "Страницы",
				'meta_title' => "Страницы",
				'error' => "",
				'name' => $this->session->userdata('user_name'),
				'tree' => $this->parts->get_sub_tree(0, "parent"),
				'parts' => $this->parts->get_list(FALSE)
			);
			
			$parts = $data['parts'];
			foreach ($parts as $part)
			{
				$base = $part->url;
				$part_pages[$base] = $this->$base->get_list(FALSE);
			}
			
			
			if ($part_id == NULL)
			{
				//Если id раздела не задан получаем все страницы
				foreach($part_pages as $part_url => $pages)
				{
					foreach ($pages as $page)
					{
						$page->part_url = $part_url;
						$data['pages'][] = $page;
					}
				}
			}
			else
			{
				//Если id указан выводим страницы данного раздела
				foreach ($parts as $part)
				{
					if ($part_id == $part->id)
					{
						$part_url = $part->url;
					}
				}
				
				foreach ($part_pages[$part_url] as $page)
				{
					$page->part_url = $part_url;
					$data['pages'][] = $page;
				}
				
			}
			$this->load->view('admin/pages.php', $data);
		}
	}
	
	//Вывод информации о странице
	public function page($part_url = FALSE, $id = FALSE)
	{
		if (!$this->session->userdata('logged_in'))
		{
			$data = array(
				'title' => "Вход",
				'meta_title' => "Вход",
				'error' => ""
			);
			$this->load->view('admin/enter.php', $data);	
		} 
		else
		{
			$data = array(
				'title' => "Редактировать страницу",
				'meta_title' => "Редактировать страницу",
				'error' => "",
				'name' => $this->session->userdata('user_name'),
				//'cat' => $this->categories->get_list(FALSE),
				'tree' => $this->parts->get_sub_tree(0, "parent")				
			);
			
			//Если url раздела и id страниццы не существуют то выводим всплывающее окно для выбора в какой раздел добавить страницу
			if ($part_url == FALSE and $id == FALSE)
			{
				$part_url = $this->input->post('url');
				$data['editors'] = $this->$part_url->editors;
				$page = new stdClass();
				foreach ($data['editors'] as $tabs)
				{
					foreach ($tabs as $item => $value)
					{
						$page->$item = "";
					}
				}
				$data['content'] = $page;
				
			}
			else
			//Если url категории и id страницы не пуст выводим инфу страницы из базы
			{
				$data['editors'] = $this->$part_url->editors;
				$data['content'] = $this->$part_url->get_item_by(array('id' => $id));
			}
			$data['content']->part_url = $part_url;
			$this->load->view('admin/edit-page.php', $data);
		}
	}

	//Редактирование страницы разделов
	public function edit_page($cat_url)
	{
		if (!$this->session->userdata('logged_in'))
		{
			$data = array(
				'title' => "Вход",
				'meta_title' => "Вход",
				'error' => ""
			);
			$this->load->view('admin/enter.php', $data);	
		} 
		else
		{	
			$data = array(
			'meta_title' => "Редактировать страницу",
			'error' => " ",
			'name' => $this->session->userdata('user_name'),
			'tree' => $this->parts->get_sub_tree(0, "parent")			
			);
					
			$editors = $this->$cat_url->editors;
		
			foreach ($editors as $edit)
			{
				foreach ($edit as $key => $value)
				{
					if ($value[1] == 'tiny')
					{
						$data['page'][$key] = $this->input->post($key);				
					}
					else
					{
						$data['page'][$key] = htmlspecialchars($this->input->post($key));	
					}
				}
			}
			$data['page']['url'] = translit_url($data['page']['title']);
			$data['page']['date'] = date("d.m.Y");
			//Валидация формы
			$this->form_validation->set_rules('title', 'Title', 'trim|xss_clean|required');
		
			if($this->form_validation->run() == FALSE)
			{
				//Если валидация не прошла выводим сообщение об ошибке
				$this->load->view('admin/edit-page.php', $data);			
			}
			else
			{
			
				//Если валидация прошла успешно проверяем переменную id
				if($data['page']["id"]==NULL)
				{
					//Если id пустая создаем новую страницу в базе
					$fields = array(
						'title' => $data['page']["title"],
					);
					
					if($this->$cat_url->non_requrrent($fields))
					{
						$this->$cat_url->insert($data['page']);
						redirect(base_url().'admin/pages');
					}
					else
					{
						$data['error'] = "Страница с таким именем в этой категории уже ссуществует.";
						$this->load->view('admin/edit-page.php', $data);
					}
				}
				else
				{
					//Если id не пустая вносим изменения.
					$this->$cat_url->update($data['page']['id'], $data['page']);
					redirect(base_url().'admin/pages');
				}
			}
		}
	}

	//Удаление страницы
	public function delete_page($part_url, $id)
	{
		if($this->$part_url->delete($id))
		{
			redirect(base_url().'admin/pages');
		}
	}	
	
	/*------------Редактирование каталога------------*/
	
	//Вывод списка категорий
	public function categories()
	{
		if (!$this->session->userdata('logged_in'))
		{
			$data = array(
				'title' => "Вход'",
				'meta_title' => "Вход",
				'error' => ""
			);
			$this->load->view('admin/enter.php', $data);	
		} 
		else
		{
			$data = array(
				'title' => "CMS",
				'meta_title' => "CMS",
				'error' => "",
				'name' => $this->session->userdata('user_name'),
				'cat' => $this->categories->get_list(FALSE),
				'tree' => $this->categories->get_sub_tree(0, "parent"),
			);

			$this->load->view('admin/categories.php', $data);
		}
	}
	
	//Вывод информации категории по id
	public function category($cat_id = false)
	{
		if (!$this->session->userdata('logged_in'))
		{
			$data = array(
				'title' => "Вход",
				'meta_title' => "Вход",
				'error' => " "
			);
			$this->load->view('admin/enter.php', $data);	
		} 
		else
		{
			$data = array(
				'title' => "Редактировать категорию",
				'error' => "",
				'name' => $this->session->userdata('user_name'),
				'selects' => array(
					'parent' =>$this->categories->get_list(FALSE)
				),
				'tree' => $this->categories->get_sub_tree(0, "parent"),
				'editors' => $this->categories->editors
			);
		
			if ($cat_id===false)
			{
				$cat = new stdClass();
				foreach ($data['editors'] as $tabs)
				{
					foreach ($tabs as $item => $value)
					{
						$cat->$item = "";
					}
				}
				$cat->is_active = "1";
				$data['content'] = $cat;
			}
			else
			{
				$data['content'] = $this->categories->get_item_by(array('id' => $cat_id));
			}	

			$this->load->view('admin/edit-category.php', $data);
		}
	}

	//Редактирование категории
	public function edit_category()
	{
		if (!$this->session->userdata('logged_in'))
		{
			$data = array(
				'title' => "Вход",
				'meta_title' => "Вход",
				'error' => ""
			);
			$this->load->view('admin/enter.php', $data);	
		} 
		else
		{
			$data = array(
				'meta_title' => "Редактировать категорию",
				'name' => $this->session->userdata('user_name'),
				'error' => " ",
				'cat' => $this->categories->get_list(FALSE),
				'tree' => $this->categories->get_sub_tree(0, "parent")				
			);
		
			$editors = $this->categories->editors;
		
			foreach ($editors as $edit)
			{
				foreach ($edit as $key => $value)
				{
					if ($value[1] == 'tiny')
					{
						$data['cat_info'][$key] = $this->input->post($key);				
					}
					else
					{
						$data['cat_info'][$key] = htmlspecialchars($this->input->post($key));	
					}
				}
			}
			
			$data['cat_info']['url'] = translit_url($data['cat_info']['title']);

			//Валидация формы
			$this->form_validation->set_rules('title', 'Title', 'trim|xss_clean|required');
		
			if($this->form_validation->run() == FALSE)
			{
				//Если валидация не прошла выводим сообщение об ошибке
				$this->load->view('admin/edit-category.php', $data);			
			}
			else
			{
				//Если валидация прошла успешно проверяем переменную id
				if($data['cat_info']["id"]==NULL)
				{
					//Если id пустая создаем новую страницу в базе
					$data['cat_info']['url'] = translit_url($data['cat_info']['title']);
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
	}	
		
	//Удаление категории
	public function delete_cat($cat_id)
	{
		if($this->categories->delete($cat_id))
		{
			redirect(base_url().'admin/categories');
		}
	}

	/*------------Редактирование страниц каталога------------*/

	//Вывод страниц категорий
	public function cat_pages($cat_id = false)
	{
		if (!$this->session->userdata('logged_in'))
		{
			$data = array(
				'title' => "Вход",
				'meta_title' => "Вход",
				'error' => ""
			);
			$this->load->view('admin/enter.php', $data);	
		} 
		else
		{
			$data = array(
				'title' => "Страницы",
				'meta_title' => "Страницы",
				'error' => "",
				'name' => $this->session->userdata('user_name'),
				'tree' => $this->categories->get_sub_tree(0, "parent"),
				'cats' => $this->categories->get_list(FALSE)
			);
			
			if ($cat_id == NULL)
			{
				//Если id категории не задан получаем все страницы
				$data['pages'] = $this->cat_pages->get_list(FALSE);
			}
			else
			{
				//Если id указан выводим страницы данного раздела
				$data['pages'] = $this->cat_pages->get_list(array('cat_id' => $cat_id));
			}
			$this->load->view('admin/cat-pages.php', $data);
		}
	}
	
	//Вывод информации о странице каталога
	public function cat_page($id = FALSE)
	{
		if (!$this->session->userdata('logged_in'))
		{
			$data = array(
				'title' => "Вход",
				'meta_title' => "Вход",
				'error' => " "
			);
			$this->load->view('admin/enter.php', $data);	
		} 
		else
		{
			$data = array(
				'title' => "Редактировать страницу каталога",
				'error' => "",
				'name' => $this->session->userdata('user_name'),
				'selects' => array(
					'cat_id' =>$this->categories->get_list(FALSE)
				),
				'tree' => $this->categories->get_sub_tree(0, "parent"),
				'editors' => $this->cat_pages->editors
			);
		
			if ($id===false)
			{
				$page = new stdClass();
				foreach ($data['editors'] as $tabs)
				{
					foreach ($tabs as $item => $value)
					{
						$page->$item = "";
					}
				}
				$page->is_active = "1";
				$data['content'] = $page;
			}
			else
			{
				$data['content'] = $this->cat_pages->get_item_by(array('id' => $id));
			}	

			$this->load->view('admin/edit-cat-page.php', $data);
		}
	}
	
	//Редактирование страницы разделов
	public function edit_cat_page()
	{
		if (!$this->session->userdata('logged_in'))
		{
			$data = array(
				'title' => "Вход",
				'meta_title' => "Вход",
				'error' => ""
			);
			$this->load->view('admin/enter.php', $data);	
		} 
		else
		{	
			$data = array(
				'title' => "Редактировать страницу каталога",
				'error' => "",
				'name' => $this->session->userdata('user_name'),
				'selects' => array(
					'cat_id' =>$this->categories->get_list(FALSE)
				),
				'tree' => $this->categories->get_sub_tree(0, "parent"),
				'editors' => $this->cat_pages->editors		
			);
					
			$editors = $this->cat_pages->editors;
		
			foreach ($editors as $edit)
			{
				foreach ($edit as $key => $value)
				{
					if ($value[1] == 'tiny')
					{
						$data['page'][$key] = $this->input->post($key);				
					}
					else
					{
						$data['page'][$key] = htmlspecialchars($this->input->post($key));	
					}
				}
			}
			
			//Валидация формы
			$this->form_validation->set_rules('title', 'Title', 'trim|xss_clean|required');
		
			if($this->form_validation->run() == FALSE)
			{
				//Если валидация не прошла выводим сообщение об ошибке
				$this->load->view('admin/edit-cat-page.php', $data);			
			}
			else
			{
			
				//Если валидация прошла успешно проверяем переменную id
				if($data['page']["id"]==NULL)
				{
					//Если id пустая создаем новую страницу в базе
					$fields = array(
						'title' => $data['page']["title"],
					);
					
					if($this->cat_pages->non_requrrent($fields))
					{
						$this->cat_pages->insert($data['page']);
						redirect(base_url().'admin/cat_pages');
					}
					else
					{
						$data['error'] = "Страница с таким именем в каталоге уже ссуществует.";
						$this->load->view('admin/edit-cat-page.php', $data);
					}
				}
				else
				{
					//Если id не пустая вносим изменения.
					$this->cat_pages->update($data['page']['id'], $data['page']);
					redirect(base_url().'admin/cat_pages');
				}
			}
		}
	}
	
	//Удаление страницы
	public function delete_cat_page($id)
	{
		if($this->cat_pages->delete($id))
		{
			redirect(base_url().'admin/cat_pages');
		}
	}	
		
	/*------------Редактирование настроек------------*/
	public function settings()
	{
		if (!$this->session->userdata('logged_in'))
		{
			$data = array(
				'title' => "Вход",
				'meta_title' => "Вход",
				'error' => ""
			);
			$this->load->view('admin/enter.php', $data);	
		} 
		else
		{
			$data = array(
				'title' => "Настройки сайта",
				'meta_title' => "Настройки сайта",
				'error' => "",
				'name' => $this->session->userdata('user_name'),
				'cat' => $this->categories->get_list(FALSE),
				'tree' => $this->categories->get_sub_tree(0, "parent"),
				'settings' => $this->settings->get_item_by(array('id' => 1)),
				'editors' => $this->settings->editors
			);

			$this->load->view('admin/settings.php', $data);	
		}
	}
	
	public function edit_settings()
	{
		if (!$this->session->userdata('logged_in'))
		{
			$data = array(
				'title' => "Вход",
				'meta_title' => "Вход",
				'error' => ""
			);
			$this->load->view('admin/enter.php', $data);	
		} 
		else
		{
			$data = array(
				'title' => "Редактировать настройки",
				'meta_title' => "Редактировать настройки",
				'error' => " ",
				'name' => $this->session->userdata('user_name'),
				'cat' => $this->categories->get_list(FALSE),
				'tree' => $this->categories->get_sub_tree(0, "parent")	
			);
		
			$editors = $this->settings->editors;
		
			foreach ($editors as $edit)
			{
				foreach ($edit as $key => $value)
				{
					if ($value[1] == 'tiny')
					{
						$data['settings'][$key] = $this->input->post($key);				
					}
					else
					{
						$data['settings'][$key] = htmlspecialchars($this->input->post($key));	
					}
				}
			}

			//Валидация формы
			$this->form_validation->set_rules('trim|xss_clean|required');
		
			if($this->form_validation->run() == FALSE)
			{
				//Если валидация не прошла выводим сообщение об ошибке
				$this->load->view('admin/settings.php', $data);						
			}
			else
			{
				$this->settings->update(1, $data['settings']);
			}
			redirect(base_url().'admin/settings');
		}
	}
	
	/*------------Редактирование меню------------*/
	
	public function menus()
	{
		if (!$this->session->userdata('logged_in'))
		{
			$data = array(
				'title' => "Вход",
				'meta_title' => "Вход",
				'error' => " "
			);
			$this->load->view('admin/enter.php', $data);	
		} 
		else
		{
			$data = array(
				'title' => "Меню",
				'meta_title' => "Меню",
				'error' => " ",
				'name' => $this->session->userdata('user_name'),
				'cat' => $this->categories->get_list(FALSE),
				'tree' => $this->categories->get_sub_tree(0, "root"),
				'menus' => $this->menus->get_list(FALSE)
			);
			$this->load->view('admin/menus.php', $data);	
		}			
	}
	
	public function menu($id=false)
	{
		if (!$this->session->userdata('logged_in'))
		{
			$data = array(
				'title' => "Вход",
				'meta_title' => "Вход",
				'error' => " "
			);
			$this->load->view('admin/enter.php', $data);	
		} 
		else
		{
			$data = array(
				'title' => "Редактировать меню",
				'meta_title' => "Редактировать меню",
				'error' => " ",
				'name' => $this->session->userdata('user_name'),
				'cat' => $this->categories->get_list(FALSE),
				'tree' => $this->categories->get_sub_tree(0, "root"),
				'editors' => $this->menus->editors
			);
			if ($id===false)
			//Если id пуст то выводим пустую форму редактирования страницы для ее создания
			{
				$menu = new stdClass();
				foreach ($data['editors'] as $tabs)
				{
					foreach ($tabs as $item => $value)
					{
						$menu->$item = "";
					}
				}
				$data['menu'] = $menu;
				$data['links'] = NULL;
			}
			else
			//Если id не пуст выводим инфу страницы из базы
			{
				$data['menu'] = $this->menus->get_item_by(array('id' => $id));
				$data['links'] = $this->menus_data->get_list(array('menu_id' => $id));
			}	
			$this->load->view('admin/edit-menu.php', $data);
		}
	}
	
	public function edit_menu()
	{
		if (!$this->session->userdata('logged_in'))
		{
			$data = array(
				'title' => "Вход",
				'meta_title' => "Вход",
				'error' => " "
			);
			$this->load->view('admin/enter.php', $data);	
		} 
		else
		{
			$data = array(
				'title' => "Редактировать меню",
				'meta_title' => "Редактировать меню",
				'error' => " ",
				'name' => $this->session->userdata('user_name'),
				'cat' => $this->categories->get_list(FALSE),
				'tree' => $this->categories->get_sub_tree(0, "root")	
			);
		
			$editors = $this->menus->editors;
		
			foreach ($editors as $edit)
			{
				foreach ($edit as $key => $value)
				{
					if ($value[1] == 'tiny')
					{
						$data['menu'][$key] = $this->input->post($key);				
					}
					else
					{
						$data['menu'][$key] = htmlspecialchars($this->input->post($key));	
					}
				}
			}		

			//Валидация формы
			$this->form_validation->set_rules('title', 'Title', 'trim|xss_clean|required');
		
			if($this->form_validation->run() == FALSE)
			{
				//Если валидация не прошла выводим сообщение об ошибке
				$this->load->view('admin/edit-menu.php', $data);	
			}
			else
			{	
				if($data['menu']['id'])
				{
					$this->menus->update($data['menu']['id'], $data['menu']);
				}
				else
				{
					$this->menus->insert($data['menu']);
				}
				redirect(base_url().'admin/menus');			
			}
		}		
	}
	
	public function delete_menu()
	{
		$this->menus->delete($this->input->get('id'));
		redirect(base_url().'admin/menus');
	}
	
	public function link($menu_id, $link_id)
	{
		if (!$this->session->userdata('logged_in'))
		{
			$data = array(
				'title' => "Вход",
				'meta_title' => "Вход",
				'error' => " "
			);
			$this->load->view('admin/enter.php', $data);	
		} 
		else
		{
			$data = array(
				'title' => "Редактировать меню",
				'meta_title' => "Редактировать меню",
				'error' => " ",
				'name' => $this->session->userdata('user_name'),
				'cat' => $this->categories->get_list(FALSE),
				'tree' => $this->categories->get_sub_tree(0, "root"),
				'pages' => $this->pages->get_list(FALSE),
				'links' => $this->menus_data->get_list(array('menu_id' => $menu_id)),
				'editors' => $this->menus_data->editors
			);
			if ($link_id==0)
			//Если id пуст то выводим пустую форму редактирования страницы для ее создания
			{
				$link = new stdClass();
				foreach ($data['editors'] as $tabs)
				{
					foreach ($tabs as $item => $value)
					{
						$link->$item = "";
					}
				}
				$link->item_type = "1";
				$link->hidden = "0";
				$data['link'] = $link; 
			}
			else
			//Если id не пуст выводим инфу страницы из базы
			{
				$data['link'] = $this->menus_data->get_item_by(array('id' => $link_id));
			}
			$this->load->view('admin/edit-link.php', $data);
		}
	}
	
	public function edit_link()
	{
		if (!$this->session->userdata('logged_in'))
		{
			$data = array(
				'title' => "Вход",
				'meta_title' => "Вход",
				'error' => " "
			);
			$this->load->view('admin/enter.php', $data);	
		} 
		else
		{
			$data = array(
				'title' => "Редактировать меню",
				'meta_title' => "Редактировать меню",
				'error' => "",
				'name' => $this->session->userdata('user_name'),
				'cat' => $this->categories->get_list(FALSE),
				'tree' => $this->categories->get_sub_tree(0, "root"),
				'pages' => $this->pages->get_list(FALSE),
				'editors' => $this->menus_data->editors
			);		
			$editors = $this->menus_data->editors;
		
			foreach ($editors as $edit)
			{
				foreach ($edit as $key => $value)
				{
					if ($value[1] == 'tiny')
					{
						$link[$key] = $this->input->post($key);				
					}
					else
					{
						$link[$key] = htmlspecialchars($this->input->post($key));	
					}
				}

			}	
			$data['links'] = 0;
			$data['link'] > $link;
			$link['item_type'] = $this->input->post('type');
		
			//Валидация формы
			$this->form_validation->set_rules('title', 'Title', 'trim|xss_clean|required');
		
			if($this->form_validation->run() == FALSE)
			{
				//Если валидация не прошла выводим сообщение об ошибке
				$link = new stdClass();
				foreach ($data['editors'] as $tabs)
				{
					foreach ($tabs as $item => $value)
					{
						$link->$item = "";
					}
				}
				$link->item_type = "1";
				$link->hidden = "0";
				$data['link'] = $link;
				$this->load->view('admin/edit-link.php', $data);	
			}
			else
			{	
				if ($link['item_type'] == 1)
				{
					$url_info = $this->pages->get_item_by(array('id' => $this->input->post('page_id')));
				}
				elseif ($link['item_type'] == 2)
				{
					$url_info = $this->categories->get_item_by(array('id' => $this->input->post('cat_id')));
				}
				$link['url'] = $url_info->url;
				if($link['id'] == NULL)
				{
					$this->menus_data->insert($link);
				}
				else
				{
					$this->menus_data->update($link['id'], $link);
				}
				redirect(base_url()."admin/menu/".$link['menu_id']."#tabr2");		
			}
		}	
	}
	
	public function delete_link($menu_id, $id)
	{
		$this->menus_data->delete($id);
		redirect(base_url()."admin/menu/".$menu_id."#tabr2");	
	}
		
}