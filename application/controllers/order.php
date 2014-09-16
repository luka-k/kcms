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
		$new_order = array(
			'order_id' => $order_id,
			'user_name' => $orders_info['name'],
			'user_email' => $orders_info['email'],
			'user_phone' => $orders_info['phone'],
			'user_address' => $orders_info['address'],
			'total' => $total_price,
			'delivery_id' => $orders_info['delivery_id'],
			'payment_id' => $orders_info['payment_id'],
			'date' => date("Y-m-d"),
			'status_id' => 1
		);
		
		if(isset($orders_info['id']))
		{
			$new_order['user_id'] = $orders_info['id'];
			
			$settings = $this->settings->get_item_by(array("id" => 1));
			
			$subject = 'Заказ в интернет-магазине '.$settings->site_title;
			$message = 'С Вашего email сделан заказ в интернет магазине '.$settings->site_title.'. В заказе '.$total_qty.' - товаров. На сумму - '.$total_price;
				
			$this->mail->send_mail($orders_info['email'], $subject, $message);
		}
		
		$this->orders->insert($new_order);
		
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
		
		$delivery_id = $this->config->item('method_delivery');
		$payment_id = $this->config->item('method_pay');
		
		$orders = $this->orders->get_list(FALSE);
		
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
			'orders_info' => $orders_info,
			'selects' => array(
				'delivery_id' => $this->config->item('method_delivery'),
				'payment_id' => $this->config->item('method_pay'),
				'status_id' => $this->config->item('order_status')
			),
			'menu' => $menu
		);		
		$this->load->view('admin/orders.php', $data);
	}
}