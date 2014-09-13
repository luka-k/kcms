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
		
		$order_id = uniqid();
		$orders = array(
			'order_id' => $order_id,
			'customer_id' => $order_id,
			'order_total' => $total_price,
			'method_delivery' => $orders_info['method_delivery'],
			'method_pay' => $orders_info['method_pay'],
			'order_date' => date("Y-m-d"),
			'order_status' => 1
		);
		
		$this->orders->insert($orders);
		
		$orders_customers = array(
			'customer_id' => $order_id,
			'name' => $orders_info['name'],
			'phone' => $orders_info['phone'],
			'email' => $orders_info['email'],
			'address' => $orders_info['address']
		);

		$this->orders_customers->insert($orders_customers);
		
		foreach($cart_items as $item)
		{
			$orders_products = array(
				'order_id' => $order_id,
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
	
	public function orders($filtr = FALSE)
	{
		$menu = $this->menus->admin_menu;
		$menu = $this->menus->set_active($menu, 'orders');
		
		$method_delivery = $this->config->item('method_delivery');
		$method_pay = $this->config->item('method_pay');
		
		$orders = $this->orders->get_list(FALSE);
		$orders_info = array();
		foreach ($orders as $key => $order)
		{
			$customer = $this->orders_customers->get_item_by(array("customer_id" => $order->customer_id));
			
			$orders_info[$key] = new stdClass();	
			
			$orders_info[$key]->order_id = $order->order_id;
			$orders_info[$key]->order_status = $order->order_status;
			$orders_info[$key]->order_products = array();
			$orders_info[$key]->method_delivery = $order->method_delivery;
			$orders_info[$key]->method_pay = $order->method_pay;
			$orders_info[$key]->order_date = $order->order_date;
			$orders_info[$key]->name = $customer->name;
			$orders_info[$key]->phone = $customer->phone;
			$orders_info[$key]->email = $customer->email;
			$orders_info[$key]->address = $customer->address;
			
			$order_items = $this->orders_products->get_list(array("order_id" => $order->order_id));
			foreach ($order_items as $order_item)
			{
				$orders_info[$key]->order_products[] = $order_item;
			}
		}
		
		$data = array(
			'title' => "Заказы",			
			'name' => $this->session->userdata('user_name'),
			'user_id' => $this->session->userdata('user_id'),
			'orders_info' => $orders_info,
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