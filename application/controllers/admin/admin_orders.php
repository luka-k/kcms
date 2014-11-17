<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Base admin class

class Admin_orders extends Admin_Controller 
{

	public function __construct()
	{
		parent::__construct();
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
			'user_name' => $this->user_name,
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
}