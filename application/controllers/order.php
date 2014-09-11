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
		//var_dump($orders_products);
		
		//var_dump($orders_customers);
		
		//var_dump($user_info);
		//var_dump($cart_items);
		//var_dump($total_price);
		//var_dump($total_qty);
	}
	
}