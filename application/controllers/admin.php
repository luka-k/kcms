<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Admin class

class Admin extends CI_Controller 
{	
	public $menu;
	public $name;
	public $user_id;

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

		if ((!$user)||($role <> "admin"))
		{
			$this->load->view('admin/enter.php', $data);	
		} 
		
		$this->menu = $this->menus->admin_menu;
		$this->name = $this->session->userdata('user_name');
		$this->user_id = $this->session->userdata('user_id');
		
		$this->config->load('emails_config');
	}
	
	public function index()
	{
		redirect(base_url().'admin/admin_main');
	}

	//Главная страница
	public function admin_main()
	{		
		$this->menu = $this->menus->set_active($this->menu, 'main');

		$data = array(
			'title' => "CMS",
			'meta_title' => "CMS",
			'error' => "",
			'name' => $this->name,
			'user_id' => $this->user_id,
			'menu' => $this->menu
		);
		$this->load->view('admin/admin.php', $data);
	}
	
	public function items($type, $id = FALSE)
	{
		$this->menu = $this->menus->set_active($this->menu, $type);

		$editors = $this->$type->editors;
		
		$data = array(
			'title' => "Страницы",
			'error' => "",
			'name' => $this->name,
			'user_id' => $this->user_id,
			'menu' => $this->menu,
			'type' => $type
		);	
		
		if(($type == "products")||($type == "categories"))
		{
			$data['tree'] = $this->categories->get_tree(0, "parent_id");
		}	
		else
		{
			$data['tree'] = $this->parts->get_tree(0, "parent_id");
		}
		
		if ($this->db->field_exists('sort', $type))
		{
			$order = "sort";
			$direction = "asc";
		}
		else
		{
			$order = FALSE;
			$direction = FALSE;
		}
		
		if($id == FALSE)
		{
			$data['content'] = $this->$type->get_list(FALSE, $from = FALSE, $limit = FALSE, $order, $direction);
		}
		else
		{
			$data['content'] = $this->$type->get_list(array("parent_id" => $id), $from = FALSE, $limit = FALSE, $order, $direction);
			$data['sortable'] = TRUE;
		}
		
		if(editors_key_exists("upload_image", $editors))
		{
			$data['content'] = $this->images->get_img_list($data['content'], $type, "catalog_small");
			$data['images'] = TRUE;
		}
		
		$this->load->view('admin/items.php', $data);
	}
	
	public function item($type, $id = FALSE)
	{
		$this->menu = $this->menus->set_active($this->menu, $type);
		
		$data = array(
			'title' => "Редактировать",
			'error' => "",
			'name' => $this->name,
			'user_id' => $this->user_id,
			'selects' => array(
				'parent_id' =>$this->categories->get_tree(0, "parent_id")
			),
			'menu' => $this->menu,
			'type' => $type,
			'editors' => $this->$type->editors
		);
		
		if(($type == "products")||($type == "categories"))
		{
			$data['tree'] = $this->categories->get_tree(0, "parent_id");
		}	
		else
		{
			$data['tree'] = $this->parts->get_tree(0, "parent_id");
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
		$this->menu = $this->menus->set_active($this->menu, $type);

		$data = array(
			'title' => "Редактировать страницу каталога",
			'error' => "",
			'name' => $this->name,
			'user_id' => $this->user_id,
			'selects' => array(
				'parent_id' =>$this->categories->get_tree(0, "parent_id")
			),
			'menu' => $this->menu,
			'editors' => $this->products->editors		
		);
		
		if(($type == "products")||($type == "categories"))
		{
			$data['tree'] = $this->categories->get_tree(0, "parent_id");
		}	
		else
		{
			$data['tree'] = $this->parts->get_tree(0, "parent_id");
		}
					
		$editors = $this->$type->editors;
		$post = $this->input->post();
		
		$data['content'] = editors_post($editors, $post);
		
		//Валидация формы
		$this->form_validation->set_rules('title', 'Title', 'trim|xss_clean|required');
		
		if($this->form_validation->run() == FALSE)
		{
			//Если валидация не прошла выводим сообщение об ошибке
			$this->load->view('admin/edit_item.php', $data);			
		}
		else
		{
			//Удаляем поля которые не присутствуют в базе
			//Например картинки
			//Возможно чуть позднее уйдет в функцию помошника
			foreach($editors as $tab)
			{
				foreach($tab as $name => $editor)
				{
					if(isset($editor[2])&&($editor[2] == "unset"))
					{
						unset($data['content']->$name);
					}
				}
			}
			
			//Если валидация прошла успешно проверяем переменную id
			if($data['content']->id==NULL)
			{
				//Если id пустая создаем новую страницу в базе
				//Аналогично unset проверка на уникальность имени
				//Думаю тоже в помошник уйдет
				foreach($editors as $tab)
				{
					foreach($tab as $name => $editor)
					{
						if(isset($editor[2])&&($editor[2] == "non_requrrent"))
						{
							$fields = array(
								$name => $data['content']->$name,
							);							
						}
					}
				}
				
				if($this->$type->non_requrrent($fields))
				{
					$this->$type->insert($data['content']);
					redirect(base_url().'admin/items/'.$type);
				}
				else
				{
					$data['error'] = "Страница с таким именем в каталоге уже существует.";
					$this->load->view('admin/edit_item.php', $data);
				}
			}
			else
			{
				//Если id не пустая вносим изменения.
				$this->$type->update($data['content']->id, $data['content']);
			}
			
			if(editors_key_exists("upload_image", $editors))
			{
				$object_info = array(
					"object_type" => $type,
					"object_id" => $data['content']->id
				);
		
				$cover_id = $this->input->post("cover_id");
				if ($cover_id <> NULL)
				{
					$this->images->set_cover($object_info, $cover_id);
				}
				
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
	
	/*--------------Удаление изображения-------------*/
	
	public function delete_img($object_type, $id)
	{
		$object_info = array(
			"object_type" => $object_type,
			"id" => $id
		);
		$item_id = $this->images->delete_img($object_info);
		redirect(base_url().'admin/item/'.$object_type."/".$item_id);
	}
		
	/*------------Редактирование настроек------------*/
	public function settings()
	{
		$this->menu = $this->menus->set_active($this->menu, 'settings');
		
		$data = array(
			'title' => "Настройки сайта",
			'meta_title' => "Настройки сайта",
			'error' => "",
			'name' => $this->name,
			'user_id' => $this->user_id,
			'content' => $this->settings->get_item_by(array('id' => 1)),
			'menu' => $this->menu,
			'editors' => $this->settings->editors
		);
		$this->load->view('admin/settings.php', $data);	
	}
	
	public function edit_settings()
	{
		$this->menu = $this->menus->set_active($this->menu, 'settings');
		
		$data = array(
			'title' => "Редактировать настройки",
			'meta_title' => "Редактировать настройки",
			'error' => " ",
			'name' => $this->name,
			'user_id' => $this->user_id,
			'menu' => $this->menu,
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

		$this->menu = $this->menus->set_active($this->menu, 'orders');
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
			'name' => $this->name,
			'user_id' => $this->user_id,
			'orders_info' => array_reverse($orders_info),
			'selects' => array(
				'delivery_id' => $this->config->item('method_delivery'),
				'payment_id' => $this->config->item('method_pay'),
				'status_id' => $this->config->item('order_status')
			),
			'menu' => $this->menu
		);		
		$this->load->view('admin/orders.php', $data);
	}
	
	/*----------Отправка писем----------*/
	
	public function mails()
	{
		$this->menu = $this->menus->set_active($this->menu, 'settings');

		$data = array(
			'title' => "Редактировать настройки писем",
			'meta_title' => "Редактировать настройки писем",
			'error' => " ",
			'name' => $this->name,
			'user_id' => $this->user_id,
			'menu' => $this->menu,
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
	public function users($id = FALSE)
	{
		$this->menu = $this->menus->set_active($this->menu, 'users');
		
		$data = array(
			'title' => "Пользователи",
			'meta_title' => "Пользователи",
			'error' => "",
			'name' => $this->name,
			'user_id' => $this->user_id,
			'menu' => $this->menu
		);	
		if($id == FALSE)
		{
			$data['users'] = $this->users->get_list(FALSE);
			$this->load->view('admin/users.php', $data);
		}
		elseif ($id == "new")
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
		$this->menu = $this->menus->set_active($this->menu, 'users');
		
		$data = array(
			'title' => "Редактировать пользователя",
			'meta_title' => "Редактировать пользователя",
			'error' => "",
			'name' => $this->name,
			'user_id' => $this->user_id,
			'menu' => $this->menu,		
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