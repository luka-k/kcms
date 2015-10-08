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
	public function new_order()
	{
		$orders_info = $this->input->post();
		
		$cart_items = $this->cart->get_all();
		$total_price = $this->cart->total_price();
		$total_qty = $this->cart->total_qty();
		
		$order_code = $this->orders->get_order_code();
		
		$new_order = array(
			'order_code' => $order_code,
			'user_name' => $orders_info['name'],
			'user_phone' => $orders_info['phone'],
			'user_email' => $orders_info['email'],
			'user_address' => $orders_info['address'],
			'total' => $total_price,
			'date' => date("Y-m-d"),
			'status_id' => 1
		);
		
		$message_info = array(
			"order_code" => $order_code,
			"user_name" => $orders_info['name'],
			'phone' => $orders_info['phone'],
			'email' => $orders_info['email'],
			'address' => $orders_info['address'],
			"products" => $cart_items
		);

		if(!empty($orders_info['id']))
		{
			$new_order['user_id'] = $orders_info['id'];
			$user = $this->users->get_item_by(array("id" => $orders_info['id']));
			
			$this->emails->send_system_mail($user->email, 2, $message_info);
		}
		
		$this->orders->insert($new_order);
		$order_id = $this->db->insert_id();
		
		if(isset($orders_info['email'])) $new_order['user_email'] = $orders_info['email'];
		if(isset($orders_info['email'])) $new_order['user_address'] = $orders_info['address'];
			
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
	
	public function fast_order()
	{
		$info = json_decode(file_get_contents('php://input', true));
		$product = $this->products->get_item_by(array("id" => $info->product_id));
		
		$order_code = $this->orders->get_order_code();
		
		$new_order = array(
			'order_code' => $order_code,
			'user_name' => $info->name,
			'user_phone' => $info->phone,
			'user_email' => $info->email,
			'user_address' => $info->address,
			'total' => $product->price * $info->qty,
			'date' => date("Y-m-d"),
			'status_id' => 1
		);
		
		$this->orders->insert($new_order);
		$order_id = $this->db->insert_id();
		
		$message_info = array(
			"order_code" => $order_code,
			"user_name" => $info->name,
			'phone' => $info->phone,
			'email' => $info->email,
			'address' => $info->address,
			'products' => array(
				0 => array(
					'name' => $product->name,
					'price' => $product->price,
					'qty' => $info->qty,
					'item_total' => $product->price *  $info->qty
				)
			)
		);
		
		if(!$this->emails->send_system_mail($this->standart_data['settings']->admin_email, 1, $message_info, "admin_order_mail"))
			add_log("order", "Отправка письма администратору не удалась");
		
		if(isset($info->email))
		{
			if($this->emails->send_system_mail($info->email, 2, $message_info))
				add_log("order", "Отправка письма клиенту не удалась");
		}
		
		$orders_products = array(
			'order_id' => $order_id,
			'product_id' => $product->id,
			'product_name' => $product->name,
			'product_price' => $product->price,
			'order_qty' => $info->qty				
		);
		
		$this->orders_products->insert($orders_products);

		echo json_encode('ok');
	}
}