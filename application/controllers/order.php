<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Admin class

class Order extends CI_Controller 
{	
	public function __construct()
	{
		parent::__construct();
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
			'user_first_name' => $orders_info['first_name'],
			'user_last_name' => $orders_info['last_name'],
			'user_email' => $orders_info['email'],
			'user_phone' => $orders_info['phone'],
			'user_country' => $orders_info['country'],
			'user_region' => $orders_info['region'],
			'user_city' => $orders_info['city'],
			'user_address_1' => $orders_info['address_1'],
			'user_address_2' => $orders_info['address_2'],
			'user_postal' => $orders_info['postal'],
			'total' => $total_price,
			'date' => date("Y-m-d"),
			'status_id' => 1
		);
		
		if(isset($orders_info['id']))
		{
			$new_order['user_id'] = $orders_info['id'];
			$user = $this->users->get_item_by(array("id" => $orders_info['id']));
			$settings = $this->settings->get_item_by(array("id" => 1));
			
			$subject = 'Заказ в интернет-магазине '.$settings->site_title;
			$message_info = array(
				"order_id" => $order_id,
				"user_name" => $user->first_name
			);
			$this->emails->send_mail($orders_info['email'], 'customer_order', $message_info);
			$this->emails->send_mail($settings->admin_email, 'admin_order', $message_info, "admin_order_mail");
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
}