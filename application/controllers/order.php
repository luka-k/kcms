<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Admin class

class Order extends CI_Controller 
{	
	public function __construct()
	{
		parent::__construct();
		
		$this->config->load('order_config');
	}
	
	public function edit_order()
	{
		$orders_info = $this->input->post();
		$cart_items = $this->cart->get_all();
		$total_price = $this->cart->total_price();
		$total_qty = $this->cart->total_qty();

		$orders = array(
			'id' => date("ymdhms"),
			'order_total' => $total_price,
			'method_delivery' => $orders_info['method_delivery'],
			'method_pay' => $orders_info['method_pay'],
			'order_date' => date("Y-m-d"),
			'order_status' => 1
		);
		
		$this->orders->insert($orders);
		
		$orders_customers = array(
			'id' => date("ymdhms"),
			'name' => $orders_info['name'],
			'phone' => $orders_info['phone'],
			'email' => $orders_info['email'],
			'address' => $orders_info['address']
		);
		
		$this->orders_customers->insert($orders_customers);
		
		foreach($cart_items as $item)
		{
			$orders_products = array(
				'order_id' => date("ymdhms"),
				'product_id' => $item["id"],
				'product_name' => $item["title"],
				'product_price' => $item["price"],
				'order_qty' => $item["qty"]				
			);
			$this->orders_products->insert($orders_products);
		}
		
		$this->cart->clear();
		redirect(base_url().'pages/cart');		
	}
	
	public function orders()
	{
		$menu = $this->menus->admin_menu;
		$menu = $this->menus->set_active($menu, 'orders');
		
		$method_delivery = $this->config->item('method_delivery');
		$method_pay = $this->config->item('method_pay');
		
		$orders = $this->orders->get_list(FALSE);
	
		foreach ($orders as $key => $order)
		{
			$customer = $this->orders_customers->get_item_by(array("id" => $order->customer_id));

			$orders_info[$key] = array(
				"id" => $order->id,
				"order_status" => $order->order_status,
				"order_items" => array(),
				"method_delivery" => $order->method_delivery,
				"method_pay" => $order->method_pay,
				"order_date" => $order->order_date,
				"name" => $customer->name,
				"phone" => $customer->phone,
				"email" => $customer->email,
				"address" => $customer->address,
			);
			
			$order_items = $this->orders_products->get_list(array("order_id" => $order->id));
			foreach ($order_items as $order_item)
			{
				$orders_info[$key]['order_items'] = $order_item;
			}
		}
		
		var_dump($orders_info);
		
		$data = array(
			'title' => "Заказы",			
			'name' => $this->session->userdata('user_name'),
			'user_id' => $this->session->userdata('user_id'),

			'selects' => array(
				'method_delivery' => $this->config->item('method_delivery'),
				'method_pay' => $this->config->item('method_pay'),
				'order_status' => $this->config->item('order_status')
			),
			'menu' => $menu
		);		
		
		$this->load->view('admin/orders.php', $data);
	}
}