<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cabinet extends Client_Controller {

	public $user_orders; 
	public $orders_info = array();
	
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('logged_in')) die(redirect(base_url().'cart'));
		$this->config->load('order_config');
		$user = $this->session->userdata('user');

		$this->user_orders = $this->orders->get_list(array("user_id" => $user->id));

		foreach ($this->user_orders as $key => $order)
		{	
			$this->orders_info[$key] = new stdClass();	
			
			$date = new DateTime($order->date);
			
			$order_items = $this->orders_products->get_list(array("order_id" => $order->order_id));
			
			$this->orders_info[$key] = (object)array(
				"order_id" => $order->order_id,
				"status" => $order->status_id,
				"order_products" => $this->orders->get_prepared_list($order_items),
				'selects' => array(
					'delivery_id' => $this->config->item('method_delivery'),
					'payment_id' => $this->config->item('method_pay')
				),
				"date" => date_format($date, 'Y-m-d'),
				"name" => $order->user_name,
				"phone" => $order->user_phone,
				"email" => $order->user_email,
				"address" => $order->user_address
			);
				
			$status_id = $this->config->item('order_status');
			foreach ($status_id as $value => $title)
			{
				if ($this->orders_info[$key]->status == $value) $this->orders_info[$key]->status = $title;
			}	
		}
	}

	/*----------Личный кабинет----------*/
	public function index()
	{
		$data = array(
			'title' => "Личный кабинет",
			'error' => "",
			'select_item' => "",
			'orders' => $this->orders_info,
			'selects' => array(
				'delivery_id' => $this->config->item('method_delivery'),
				'payment_id' => $this->config->item('method_pay')
			),
			'status_id' => $this->config->item('order_status'),
			'settings' => $this->settings->get_item_by(array('id' => 1))
		);
		$data = array_merge($this->standart_data, $data);
		$data['user'] = $this->users->get_item_by(array("id" => $data['user']->id));
		$data['user'] = $this->users->prepare($data['user']);
		//var_dump($data['user']);
		$this->load->view('client/cabinet.php', $data);
	}
	
	public function update_info($type)
	{
		$user = (object)$this->input->post();
		
		if($type == "pass")
		{
			$user->password = md5($user->password);
			unset($user->conf_password);
		}
		elseif($type == "image")
		{
			$images = $this->images->get_list(array("object_type" => "users", "object_id" => $user->id));
			if(!empty($images))
			{
				foreach($images as $img)
				{
					$object_info = array(
						"object_type" => "users",
						"id" => $img->id
					);
					$this->images->delete_img($object_info);
				}
			}
			
			$object_info = array(
				"object_type" => "users",
				"object_id" => $user->id
			);
			
			if (isset($_FILES['avatar'])&&($_FILES['avatar']['error'] <> 4)) $this->images->upload_image($_FILES['avatar'], $object_info);
		}
		elseif($type == "personal")
		{
			$this->users->update($user->id, $user);
		}

		redirect(base_url().'cabinet');
	}
	
}