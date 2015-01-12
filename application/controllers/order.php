<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order extends Client_Controller 
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
		
		$order_id = $this->orders->get_order_id();
		
		$new_order = array(
			'order_id' => $order_id,
			'user_name' => $orders_info['name'],
			'user_phone' => $orders_info['phone'],
			'user_email' => $orders_info['email'],
			'total' => $total_price,
			'date' => date("Y-m-d"),
			'status_id' => 1
		);
		
		$user_address = $orders_info['zip_code']." ".$orders_info['city'].' '.$orders_info['street'];
		if(!empty($orders_info['house'])) $user_address .= ' д.'.$orders_info['house'];
		if(!empty($orders_info['building'])) $user_address .= ' к.'.$orders_info['building'];
		if(!empty($orders_info['apartment'])) $user_address .= ' кв.'.$orders_info['apartment'];
		
		$settings = $this->settings->get_item_by(array("id" => 1));
			
		$subject = 'Заказ в интернет-магазине '.$settings->site_title;
		$message_info = array(
			"order_id" => $order_id,
			"user_name" => $orders_info['name']
		);
			
		if(!empty($orders_info['id']))
		{
			$new_order['user_id'] = $orders_info['id'];
			$user = $this->users->get_item_by(array("id" => $orders_info['id']));
			
			$this->emails->send_mail($user->email, 'customer_order', $message_info);
		}
		
		$this->emails->send_mail($settings->admin_email, 'admin_order', $message_info, "admin_order_mail");
		
		$new_order['user_address'] = $user_address;
		$this->orders->insert($new_order);
		
		foreach($cart_items as $item)
		{
			$orders_products = array(
				'order_id' => $order_id,
				'product_id' => $item["id"],
				'product_name' => $item["name"],
				'product_price' => $item["price"],
				'order_qty' => $item["qty"]				
			);
			$this->orders_products->insert($orders_products);
		}
	
		$this->cart->clear();
		redirect(base_url().'cart?action=order');		
	}
}