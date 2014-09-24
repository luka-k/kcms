<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Admin class

class Admin extends CI_Controller 
{	
	public function __construct()
	{
		parent::__construct();

		$data = array(
			'title' => "Вход",
			'meta_title' => "Вход",
			'error' => " "
		);
		
		$user = $this->session->userdata('logged_in');
		$role = $this->session->userdata('role');

		if (!$user or $role <> "admin")
		{
			$this->load->view('admin/enter.php', $data);	
		} 
		
		$this->config->load('emails_config');
	}
	
	public function index()
	{
		redirect(base_url().'admin/admin_main');
	}

	//Главная страница
	public function admin_main()
	{		
		$menu = $this->menus->admin_menu;
		$menu = $this->menus->set_active($menu, 'main');
		//Отбираем для главной последние три записи в блоге и в новостях
		$from_news = $this->news->get_count(array('is_active' => 1))-5;
		$from_blog = $this->blog->get_count(array('is_active' => 1))-5;
		if ($from_news < 0)
		{
			$from_news = 0;
		}
		
		if ($from_blog < 0)
		{
			$from_blog = 0;
		}	
		$data = array(
			'title' => "CMS",
			'meta_title' => "CMS",
			'error' => "",
			'name' => $this->session->userdata('user_name'),
			'user_id' => $this->session->userdata('user_id'),
			'news' => array_reverse($this->news->get_list(array('is_active' => 1), $from_news, 5)),
			'blog' => array_reverse($this->blog->get_list(array('is_active' => 1), $from_blog, 5)),
			'menu' => $menu
		);
		$this->load->view('admin/admin.php', $data);
	}
	
	public function items($type, $id = FALSE)
	{
		$menu = $this->menus->admin_menu;
		$menu = $this->menus->set_active($menu, $type);

		$data = array(
			'title' => "Страницы",
			'error' => "",
			'name' => $this->session->userdata('user_name'),
			'user_id' => $this->session->userdata('user_id'),
			'type' => $type,
			'menu' => $menu
		);	
		
		if($type == "products")
		{
			$data['tree'] = $this->categories->get_sub_tree(0, "parent_id", $id);
		}
		else
		{
			$data['tree'] = $this->$type->get_sub_tree(0, "parent_id", $id);
		}
		
		
		if($id == FALSE)
		{
			$data['content'] = $this->$type->get_list(FALSE);
		}
		else
		{
			$data['content'] = $this->$type->get_list(array("parent_id" => $id));
		}
		$data['content'] = $this->images->get_img_list($data['content'], $type, "catalog_small");
		$this->load->view('admin/items.php', $data);
	}
	
	public function item($type, $id = FALSE)
	{
		$menu = $this->menus->admin_menu;
		$menu = $this->menus->set_active($menu, $type);
		$data = array(
			'title' => "Редактировать",
			'error' => "",
			'name' => $this->session->userdata('user_name'),
			'user_id' => $this->session->userdata('user_id'),
			'selects' => array(
				'parent_id' =>$this->categories->get_sub_tree(0, "parent_id", $id)
			),
			'menu' => $menu,
			'type' => $type,
			'editors' => $this->$type->editors
		);
		
		if($type == "products")
		{
			$data['tree'] = $this->categories->get_sub_tree(0, "parent_id", $id);
		}
		else
		{
			$data['tree'] = $this->$type->get_sub_tree(0, "parent_id", $id);
		}
		
		if($id == FALSE)
		{	
			$content = new stdClass();
			foreach ($data['editors'] as $tabs)
			{
				foreach ($tabs as $item => $value)
				{
					$category->$item = "";
				}
			}
			$cat->is_active = "1";
			$data['content'] = $category;
			$data['content']->img = NULL;
		}	
		else
		{			
			$data['content'] = $this->$type->get_item_by(array('id' => $id));
			$object_info = array(
				"object_type" => $type,
				"object_id" => $data['content']->id
			);
			$data['content']->img = $this->images->get_images($object_info);		
		}
		$this->load->view('admin/edit_item.php', $data);	
	}
	
	public function edit_item($type, $exit = false)
	{
		$menu = $this->menus->admin_menu;
		$menu = $this->menus->set_active($menu, $type);
		
		$post = $this->input->post();
	
		$data = array(
			'title' => "Редактировать страницу каталога",
			'error' => "",
			'name' => $this->session->userdata('user_name'),
			'user_id' => $this->session->userdata('user_id'),
			'selects' => array(
				'parent_id' =>$this->categories->get_sub_tree(0, "parent_id", $post['id'])
			),
			'menu' => $menu,
			'editors' => $this->products->editors		
		);
		
		
		if($type == "products")
		{
			$data['tree'] = $this->categories->get_sub_tree(0, "parent_id");
		}
		else
		{
			$data['tree'] = $this->$type->get_sub_tree(0, "parent_id");
		}
					
		$editors = $this->$type->editors;
		$post = $this->input->post();
		
		$data['content'] = editors_post($editors, $post);

		$object_info = array(
			"object_type" => $type,
			"object_id" => $data['content']->id
		);
		
		$cover_id = $this->input->post("cover_id");
		if ($cover_id <> NULL)
		{
			$this->images->set_cover($object_info, $cover_id);
		}
		
		//Валидация формы
		$this->form_validation->set_rules('title', 'Title', 'trim|xss_clean|required');
		
		if($this->form_validation->run() == FALSE)
		{
			//Если валидация не прошла выводим сообщение об ошибке
			$this->load->view('admin/edit_item.php', $data);			
		}
		else
		{
			//Если валидация прошла успешно проверяем переменную id
			if($data['content']->id==NULL)
			{
				//Если id пустая создаем новую страницу в базе
				$fields = array(
					'title' => $data['content']->title,
				);
					
				if($this->$type->non_requrrent($fields))
				{
					$data['content']->url = slug($data['content']->title);
					$this->$type->insert($data['content']);
					redirect(base_url().'admin/items/'.$type);
				}
				else
				{
					$data['error'] = "Страница с таким именем в каталоге уже ссуществует.";
					$this->load->view('admin/edit_item.php', $data);
				}
			}
			else
			{
				//Если id не пустая вносим изменения.
				$data['content']->url = slug($data['content']->url);
				$this->$type->update($data['content']->id, $data['content']);
			}
			
			if($type <> "parts")
			{
				if ($_FILES['pic']['error'] <> 4)
				{
					$this->images->upload_image($_FILES['pic'], $object_info);
				}
			}
			if($exit == false)
			{
				redirect(base_url().'admin/item/'.$type."/".$data['content']->id);
			}
			else
			{
				redirect(base_url().'admin/items/'.$type);
			}				
		}	
	}
	
	//Удаление категории
	public function delete_item($type, $category_id)
	{
		if($this->$type->delete($category_id))
		{
			redirect(base_url().'admin/items'.$type);
		}
	}
	
	/*------------Редактирование страниц разделов------------*/

	//Вывод страниц раздела
	public function pages($part_url = false)
	{
		$menu = $this->menus->admin_menu;
		$menu = $this->menus->set_active($menu, 'parts');
		$data = array(
			'title' => "Страницы",
			'meta_title' => "Страницы",
			'error' => "",
			'name' => $this->session->userdata('user_name'),
			'user_id' => $this->session->userdata('user_id'),
			'tree' => $this->parts->get_sub_tree(0, "parent_id"),
			'parts' => $this->parts->get_list(FALSE),
			'menu' => $menu
		);
			
		$parts = $data['parts'];
		foreach ($parts as $part)
		{
			$base = $part->url;
			$part_pages[$base] = $this->$base->get_list(FALSE);
		}
			
		if ($part_url == NULL)
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
			foreach ($part_pages[$part_url] as $page)
			{
				$page->part_url = $part_url;
				$data['pages'][] = $page;
			}				
		}
		$this->load->view('admin/pages.php', $data);
	}
	
	//Вывод информации о странице
	public function page($part_url = FALSE, $id = FALSE)
	{
		$menu = $this->menus->admin_menu;
		$menu = $this->menus->set_active($menu, 'parts');
		$data = array(
			'title' => "Редактировать страницу",
			'meta_title' => "Редактировать страницу",
			'error' => "",
			'name' => $this->session->userdata('user_name'),
			'user_id' => $this->session->userdata('user_id'),
			'tree' => $this->parts->get_sub_tree(0, "parent_id"),
			'menu' => $menu
		);
		
		//Если url раздела и id страниццы не существуют то выводим всплывающее окно для выбора в какой раздел добавить страницу
		if ($part_url == FALSE && $id == FALSE)
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
			$page->is_active = "1";
			$data['content'] = $page;			
		}
		else
		//Если url категории и id страницы не пуст выводим инфу страницы из базы
		{
			$data['editors'] = $this->$part_url->editors;
			$data['content'] = $this->$part_url->get_item_by(array('id' => $id));
		}
		$data['content']->part_url = $part_url;
		$this->load->view('admin/edit_page.php', $data);
	}

	//Редактирование страницы разделов
	public function edit_page($part_url, $exit = FALSE)
	{
		$menu = $this->menus->admin_menu;
		$menu = $this->menus->set_active($menu, 'parts');
		$data = array(
			'meta_title' => "Редактировать страницу",
			'error' => " ",
			'name' => $this->session->userdata('user_name'),
			'user_id' => $this->session->userdata('user_id'),
			'tree' => $this->parts->get_sub_tree(0, "parent_id"),	
			'menu' => $menu
		);
					
		$editors = $this->$part_url->editors;
		$post = $this->input->post();
		
		$data['page'] = editors_post($editors, $post);
			
		$data['page']->date = date("d.m.Y");
		//Валидация формы
		$this->form_validation->set_rules('title', 'Title', 'trim|xss_clean|required');
		
		if($this->form_validation->run() == FALSE)
		{
			//Если валидация не прошла выводим сообщение об ошибке
			$this->load->view('admin/edit_page.php', $data);			
		}
		else
		{
			//Если валидация прошла успешно проверяем переменную id
			if($data['page']->id==NULL)
			{
				//Если id пустая создаем новую страницу в базе
				$fields = array(
					'title' => $data['page']->title
				);
					
				if($this->$part_url->non_requrrent($fields))
				{
					$data['page']->url = slug($data['page']->title);
					$this->$part_url->insert($data['page']);
					redirect(base_url().'admin/pages');
				}
				else
				{
					$data['error'] = "Страница с таким именем в этой категории уже ссуществует.";
					$this->load->view('admin/edit_page.php', $data);
				}
			}
			else
			{
				//Если id не пустая вносим изменения.
				$data['page']->url = slug($data['page']->url);
				$this->$part_url->update($data['page']->id, $data['page']);
			}
			if($exit == false)
			{
				redirect(base_url().'admin/page/'.$part_url."/".$data['page']->id);
			}
			else
			{
				redirect(base_url().'admin/pages/'.$part_url);
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
	
	/*--------------Удаление изображения-------------*/
	
	public function delete_img($object_type, $id)
	{
		$object_info = array(
			"object_type" => $object_type,
			"id" => $id
		);
		$cat_id = $this->images->delete_img($object_info);
		redirect(base_url().'admin/item/'.$object_type."/".$cat_id);
	}
		
	/*------------Редактирование настроек------------*/
	public function settings()
	{
		$menu = $this->menus->admin_menu;
		$menu = $this->menus->set_active($menu, 'settings');
		$data = array(
			'title' => "Настройки сайта",
			'meta_title' => "Настройки сайта",
			'error' => "",
			'name' => $this->session->userdata('user_name'),
			'user_id' => $this->session->userdata('user_id'),
			'cat' => $this->categories->get_list(FALSE),
			'tree' => $this->categories->get_sub_tree(0, "parent_id"),
			'content' => $this->settings->get_item_by(array('id' => 1)),
			'menu' => $menu,
			'editors' => $this->settings->editors
		);
		$this->load->view('admin/settings.php', $data);	
	}
	
	public function edit_settings()
	{
		$menu = $this->menus->admin_menu;
		$menu = $this->menus->set_active($menu, 'settings');
		$data = array(
			'title' => "Редактировать настройки",
			'meta_title' => "Редактировать настройки",
			'error' => " ",
			'name' => $this->session->userdata('user_name'),
			'user_id' => $this->session->userdata('user_id'),
			'cat' => $this->categories->get_list(FALSE),
			'menu' => $menu,
			'tree' => $this->categories->get_sub_tree(0, "parent_id")	
		);
		
		$editors = $this->settings->editors;
		$post = $this->input->post();
		
		$data['settings'] = editors_post($editors, $post);

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
	
	/*----------Вывод заказов в админку----------*/
	
	public function orders($filter = FALSE)
	{
		$this->config->load('order_config');
		
		$menu = $this->menus->admin_menu;
		$menu = $this->menus->set_active($menu, 'orders');
		
		$delivery_id = $this->config->item('method_delivery');
		$payment_id = $this->config->item('method_pay');
		
		switch ($filter) 
		{
			case FALSE:	$orders = $this->orders->get_list(FALSE);
			break;
			case "by_order_id": $order_id = $this->input->post("order_id");
			$orders = $this->orders->get_list(array("order_id" => $order_id));
			break;
			case 1: $orders = $this->orders->get_list(array("status_id" => 1));
			break;
			case 2: $orders = $this->orders->get_list(array("status_id" => 2));
			break;
			case 3: $orders = $this->orders->get_list(array("status_id" => 3));
			break;
			case 4: $orders = $this->orders->get_list(array("status_id" => 4));
			break;
		}	
		
		$orders_info = array();
		foreach ($orders as $key => $order)
		{	
			$orders_info[$key] = new stdClass();	
			
			$date = new DateTime($order->date);

			$order_items = $this->orders_products->get_list(array("order_id" => $order->order_id));
			
			$orders_info[$key] = (object)array(
				"order_id" => $order->order_id,
				"status_id" => $order->status_id,
				"order_products" => $order_items,
				"delivery_id" => $order->delivery_id,
				"payment_id" => $order->payment_id,
				"order_date" => date_format($date, 'Y-m-d'),
				"name" => $order->user_name,
				"phone" => $order->user_phone,
				"email" => $order->user_email,
				"address" => $order->user_address
			);
			
		}
		
		$data = array(
			'title' => "Заказы",			
			'name' => $this->session->userdata('user_name'),
			'user_id' => $this->session->userdata('user_id'),
			'orders_info' => array_reverse($orders_info),
			'selects' => array(
				'delivery_id' => $this->config->item('method_delivery'),
				'payment_id' => $this->config->item('method_pay'),
				'status_id' => $this->config->item('order_status')
			),
			'menu' => $menu
		);		
		$this->load->view('admin/orders.php', $data);
	}
	
	/*----------Отправка писем----------*/
	
	public function mails()
	{
		$menu = $this->menus->admin_menu;
		$menu = $this->menus->set_active($menu, 'settings');
		$data = array(
			'title' => "Редактировать настройки писем",
			'meta_title' => "Редактировать настройки писем",
			'error' => " ",
			'name' => $this->session->userdata('user_name'),
			'user_id' => $this->session->userdata('user_id'),
			'cat' => $this->categories->get_list(FALSE),
			'menu' => $menu,
			'emails' => $this->emails->get_list(FALSE),
			'select' => $this->config->item('message_type')
		);
		
		$this->load->view('admin/mails.php', $data);
	}
	
	public function edit_mails()
	{
		$mails = $this->input->post();

		foreach($mails['type'] as $key => $value)
		{
			$emails[$key] = array(
				"id" => $mails['id'][$key],
				"type" => $mails['type'][$key],
				"subject" => $mails['subject'][$key],
				"description" => $mails['description'][$key],
			);
		}
	
		foreach($emails as $mail)
		{
			$this->emails->update($mail['id'], $mail);
		}
		
		redirect(base_url().'admin/mails');
	}

	/*-----------Пользователи----------*/
	public function users()
	{
		$menu = $this->menus->admin_menu;
		$menu = $this->menus->set_active($menu, 'users');
		$data = array(
			'title' => "Пользователи",
			'meta_title' => "Пользователи",
			'error' => "",
			'name' => $this->session->userdata('user_name'),
			'user_id' => $this->session->userdata('user_id'),
			'tree' => $this->parts->get_list(FALSE),
			'menu' => $menu,
			'users' => $this->users->get_list(FALSE)
		);	
		$this->load->view('admin/users.php', $data);	
	}
	
	//Информация о пользователе
	public function user($id = FALSE)
	{
		$menu = $this->menus->admin_menu;
		$menu = $this->menus->set_active($menu, 'users');
		$data = array(
			'title' => "Редактировать пользователя",
			'meta_title' => "Редактировать пользователя",
			'error' => "",
			'name' => $this->session->userdata('user_name'),
			'user_id' => $this->session->userdata('user_id'),
			'menu' => $menu,
			'tree' => $this->parts->get_sub_tree(0, "parent_id")				
		);
			
		if ($id == FALSE)
		{
			//Если id нет выводи пустую форму для долбавления пользователя
			$data['editors'] = $this->users->new_editors;
			$user = new stdClass();
			foreach ($data['editors'] as $tabs)
			{
				foreach ($tabs as $item => $value)
				{
					$user->$item = "";
				}
			}
			$data['content'] = $user;
			$this->load->view('admin/new-user.php', $data);
		}
		else
		//Если id не пустой выводим инфу о пользователе
		{
			$data['editors'] = $this->users->editors;
			$data['content'] = $this->users->get_item_by(array('id' => $id));
			$data['content']->secret = md5($this->config->item('allowed_types'));
			$this->users->update($id, array('secret' => $data['content']->secret));
			$data['content']->password = NULL;
			$this->load->view('admin/user.php', $data);
		}
	}
	
	/*Изменение данных пользователя*/
	public function edit_user($id = FALSE)
	{
		$menu = $this->menus->admin_menu;
		$menu = $this->menus->set_active($menu, 'users');
		$data = array(
			'title' => "Редактировать пользователя",
			'meta_title' => "Редактировать пользователя",
			'error' => "",
			'name' => $this->session->userdata('user_name'),
			'user_id' => $this->session->userdata('user_id'),
			'menu' => $menu,
			'tree' => $this->parts->get_sub_tree(0, "parent_id")			
		);
			
		if ($id == NULL)
		{
			$editors = $this->users->new_editors;
			$post = $this->input->post();
		
			$data['content'] = editors_post($editors, $post);	
			$data['content']->password = md5($data['content']->password);
			$data['editors'] = $editors;

			$this->form_validation->set_rules('email', 'Email', 'trim|xss_clean|required|valid_email|callback_email_not_exists');
			$this->form_validation->set_rules( 'name','Name','trim|xss_clean|required|min_length[4]|max_length[25]|callback_username_not_exists');	
					
			$this->form_validation->set_rules('password', 'Password', 'trim|xss_clean|required');
			$this->form_validation->set_rules('conf_password',  'Confirm password',  'required|min_length[3]|matches[password]');
					
			//Валидация формы
			if($this->form_validation->run() == FALSE)
			{
				//Если валидация не прошла выводим сообщение об ошибке
				$this->load->view('admin/new-user.php', $data);			
			}
			else
			{	
				//Если id пустой то добавляем нового пользователя
				if (!$this->users->non_requrrent(array('name'=>$data['content']->name)))
				{
					$data['error'] ="Пользователь с таким именем уже зарегистрирован";
					$this->load->view('admin/new-user.php', $data);
				} 
				elseif (!$this->users->non_requrrent(array('email'=>$data['content']->email)))
				{
					$data['error'] ="Такой email уже зарегистрирован";
					$this->load->view('admin/new-user.php', $data);					
				} 
				else 
				{	
					$this->users->insert($data['content']);
					redirect(base_url().'admin/users');
				}
			}						
		}
		else
		{
			$editors = $this->users->editors;
			$post = $this->input->post();
		
			$data['content'] = editors_post($editors, $post);			
			$data['editors'] = $editors;

			$this->form_validation->set_rules('email', 'Email', 'trim|xss_clean|required|valid_email|callback_email_not_exists');
			$this->form_validation->set_rules( 'name','Name','trim|xss_clean|required|min_length[4]|max_length[25]|callback_username_not_exists');	
					
			//Валидация формы
			if($this->form_validation->run() == FALSE)
			{
				//Если валидация не прошла выводим сообщение об ошибке
				$this->load->view('admin/user.php', $data);			
			}
			else
			{					
				//Если id не пустой обновляем не пустые поля
				foreach($data['content'] as $field=>$value)
				{
					if ($value <> NULL)
					{
						$this->db->set($field, $value);
					}
				}
				$this->users->update($data['content']->id);
				redirect(base_url().'admin/users');
			}
		}	
	}
	
	//Удаление пользователя
	public function delete_user($id)
	{
		if($this->users->delete($id))
		{
			redirect(base_url().'admin/users');
		}	
	}	
}