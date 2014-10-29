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
		
		$user = $this->session->userdata('logged_in');
		$role = $this->session->userdata('role');

		if ((!$user)||($role <> "admin"))
		{
			die(redirect(base_url().'registration/admin_enter'));	
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
			'type' => $type,
			'tree' => $this->categories->get_tree(0, "parent_id")
		);	
				
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
		if(editors_field_exists('img', $editors))
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
			'menu' => $this->menu,
			'type' => $type
		);
		
		if(($type <> "users")and($type <> "settings"))
		{
			$data['tree'] = $this->categories->get_tree(0, "parent_id");
			$data['selects'] = array(
				'parent_id' =>$this->categories->get_tree(0, "parent_id")
			);
			$data['editors'] = $this->$type->editors;
		}
		else
		{
			$id == FALSE? $data['editors'] = $this->$type->new_editors : $data['editors'] = $this->$type->editors;
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
			$category->is_active = "1";
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
			'title' => "Редактировать",
			'error' => "",
			'name' => $this->name,
			'user_id' => $this->user_id,
			'menu' => $this->menu,
			'type' => $type
		);
					
		$editors = $this->$type->editors;
		//$post = $this->input->post();
		
		$validation = $this->$type->editors_post();
		//var_dump($validation['data']);
		$data['content'] = $validation['data'];
		
		
		if(($type <> "users")and($type <> "settings"))
		{
			$data['tree'] = $this->categories->get_tree(0, "parent_id");
			$data['selects'] = array(
				'parent_id' =>$this->categories->get_tree(0, "parent_id")
			);
			$data['editors'] = $this->$type->editors;
		}
		else
		{
			$data['content']->id == FALSE? $data['editors'] = $this->$type->new_editors : $data['editors'] = $this->$type->editors;
		}
		
		if($validation['error'] == TRUE)
		{
			//Если валидация не прошла выводим сообщение об ошибке
			$this->load->view('admin/edit_item.php', $data);			
		}
		else
		{			
			//Если валидация прошла успешно проверяем переменную id
			if($data['content']->id == FALSE)
			{
				//Если id пустая создаем новую страницу в базе
				//Аналогично unset проверка на уникальность имени
				//Думаю тоже в помошник уйдет
				
				$this->$type->insert($data['content']);
				$data['content']->id = $this->db->insert_id();				
			}
			else
			{
				//Если id не пустая вносим изменения.
				$this->$type->update($data['content']->id, $data['content']);
			}
			
	
			$field_name = editors_field_exists('img', $editors);
			//Получаем id эдитора который предназначен для загрузки изображения
			//Если например нужно две галлереи для товара то делаем в функции editors_field_exists $field_name массивом и пробегаем ниже по нему
			if(!empty($field_name))
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
				
				if ($_FILES[$field_name]['error'] <> 4)
				{
					$this->images->upload_image($_FILES[$field_name], $object_info);
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
			redirect(base_url().'admin/items/'.$type);
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
			
	/*----------Вывод заказов в админку----------*/
	
	public function orders($filter = FALSE)
	{
		$this->config->load('order_config');

		$this->menu = $this->menus->set_active($this->menu, 'orders');
		$delivery_id = $this->config->item('method_delivery');
		$payment_id = $this->config->item('method_pay');
		
		if ($filter == FALSE)
		{
			$orders = $this->orders->get_list(FALSE);
		}
		elseif($filter == "by_order_id")
		{
			$order_id = $this->input->post("order_id");
			$orders = $this->orders->get_list(array("order_id" => $order_id));
		}
		else
		{
			$orders = $this->orders->get_list(array("status_id" => $filter));
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
}