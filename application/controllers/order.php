<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Order class
*
* @package		kcms
* @subpackage	Controllers
* @category	    Order
*/
class Order extends Client_Controller 
{	
	public function __construct()
	{
		parent::__construct();
	}
	
	/**
	* Оформление заказа
	*/
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
			'total' => $total_price,
			'date' => date("Y-m-d"),
			'status_id' => 1
		);
		
		$this->orders->insert($new_order);
		
		if(isset($orders_info['email'])) $new_order['user_email'] = $orders_info['email'];
		if(isset($orders_info['email'])) $new_order['user_address'] = $orders_info['address'];
			
		$message_info = array(
			"order_id" => $order_id,
			"user_name" => $orders_info['name'],
			"products" => $cart_items
		);
			
		if(!empty($orders_info['id']))
		{
			$new_order['user_id'] = $orders_info['id'];
			$user = $this->users->get_item_by(array("id" => $orders_info['id']));
			
			$this->emails->send_system_mail($user->email, 2, $message_info);
		}
		
		$this->emails->send_system_mail($this->standart_data['settings']->admin_email, 1, $message_info, "admin_order_mail");

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