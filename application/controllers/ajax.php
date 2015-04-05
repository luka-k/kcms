<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Ajax class

class Ajax extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->config->load('orders');
	}

	function callback()
	{
		$post = json_decode(file_get_contents('php://input', true));
	
		$settings = $this->settings->get_item_by(array("id" => 1));
		
		$message_info = array(
			"USER_NAME" => $post->name,
			"USER_PHONE" => $post->phone
		);
		
		$this->emails->send_system_mail($settings->admin_email, 6, $message_info);
		
		$data['message'] = "ok";
		echo json_encode($data);
	}
	
	public function add_to_cart()
	{
		$info = json_decode(file_get_contents('php://input', true));
		$product = $this->products->get_item_by(array("id" => $info->item_id));
		
		if(!empty($product->discount))
		{
			$product->price = $product->price*(100 - $product->discount)/100;
		}
		
		$cart_item = array(
			"id" => $product->id,
			"parent_id" => $product->parent_id,
			"name" => $product->name,
			"url" => $product->url,
			"price" => $product->price,
			"qty" => $info->qty
		);
		
		$item_id = $this->cart->insert($cart_item);

		$data['total_qty'] = $this->cart->total_qty();
		$data['total_price'] = $this->cart->total_price();
		$data['product_word'] = $this->string_edit->set_word_form("товар", $data['total_qty']);
		$data['item_id'] = $item_id;
		$item = $this->cart->get($item_id);

		$data['item_qty'] = $item['qty'];
		echo json_encode($data);
	}
	
	public function update_cart()
	{
		$info = json_decode(file_get_contents('php://input', true));
		$this->cart->update(array("item_id" => $info->item_id, "qty" => $info->qty));
		$item = $this->cart->get($info->item_id);
		$data['item_total'] = $item['item_total'];
 		$data['total_qty'] = $this->cart->total_qty();
		$data['total_price'] = $this->cart->total_price();		
		echo json_encode($data);
	}
	
	public function delete_item()
	{
		$info = json_decode(file_get_contents('php://input', true));
	
		$this->cart->delete($info->item_id);
		
 		$data['total_qty'] = $this->cart->total_qty();
		$data['total_price'] = $this->cart->total_price();		
		echo json_encode($data);
	}
	
	public function change_field()
	{
		$info = json_decode(file_get_contents('php://input', true));

		$this->orders->update($info->order_id, array("{$info->type}" => $info->value));
		
		$order = $this->orders->get_item_by(array("order_id" => $info->order_id));
		$status_id = $this->config->item('order_status');
		
		foreach($status_id as $key => $value)
		{
			if ($order->status_id == $key) $status = $value;
		}
		
		switch ($info->type) 
		{
			case "status_id": $data['message'] = "Статус заказа изменен"; 
				$message_info = array(
					"order_id" => $info->order_id,
					"user_name" => $order->user_name,
					"order_status" => $status
				);
				$this->emails->send_system_mail($order->user_email, 3, $message_info);
				break;
			case "payment_id": $data['message'] = "Способ оплаты изменен"; break;
			case "delivery_id": $data['message'] = "Способ доставки изменен"; break;
		}
		
		echo json_encode($data);
	}
	
	function autocomplete()
	{
		$products = $this->products->get_list(FALSE);
		foreach($products as $p)
		{
			$available_tags[] = $p->name;
		}
		$answer['available_tags'] = $available_tags;
		
		echo json_encode($answer);
	}
	
	//wishlist
	//
	// add_to_wishlist() 
	// добавляет в вишлист товар
	public function add_to_wishlist()
	{
		$info = json_decode(file_get_contents('php://input', true));
		$item = $info->id;
		$this->wishlist->insert($item);
		$data['message'] = "Ok";
		echo json_encode($data);
	}
	
	// delete_from_wishlist()  
	// удаление из вишлиста
	
	public function delete_from_wishlist()
	{
		$info = json_decode(file_get_contents('php://input', true));
		$this->wishlist->delete($info->id);
		$data['message'] = "Ok";
		echo json_encode($data);
	}
	
	
}