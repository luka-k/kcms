<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Ajax class

class Ajax extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->config->load('order_config');
	}

	function index()
	{
		$post = $this->input->post();
		$admin_email = $this->config->item('admin_email');
		
		if(isset($post['dealer']))
		{
			$subject = 'Запрос о сотруднечестве';
			$message = 'Клиент '.$post['name'].' предлагает сотруднечество </br> Контактные данные:</br> Телефон:'.$post['phone'].'E-mail: '.$post['email'];
			$message .= '</br> К письму добавлен коментарий:</br>'.$post['message'];
		}
		else
		{
			$subject = 'Запрос на обратный звонок';
			$message = 'Клиент '.$post['name'].' заказал обратный звонок на номер - '.$post['phone'];
			if(isset($post['email']))
			{
				$message .= '</br> E-mail:'.$post['email'];
			}
			if(isset($post['message']))
			{
				$message .= '</br> К письму приложен коментарий :</br>'.$post['message'];
			}
		}
		($this->mail->send_mail($admin_email, $subject, $message));
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
			"name" => $product->name,
			"url" => $product->url,
			"price" => $product->price,
			"qty" => $info->qty
		);
		
		$item_id = $this->cart->insert($cart_item);
		
		$data['total_qty'] = $this->cart->total_qty();
		$data['total_price'] = $this->cart->total_price();
		$data['product_word'] = end_maker("товар", $data['total_qty']);
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
		$data['item_id'] = $info->item_id;	
		$data['product_word'] = end_maker("товар", $data['total_qty']);		
		echo json_encode($data);
	}
	
	public function delete_item()
	{
		$info = json_decode(file_get_contents('php://input', true));
	
		$this->cart->delete($info->item_id);
		
 		$data['total_qty'] = $this->cart->total_qty();
		$data['total_price'] = $this->cart->total_price();		
		$data['item_id'] = $info->item_id;
		$data['product_word'] = end_maker("товар", $data['total_qty']);
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
		$message_info = array(
			"order_id" => $info->order_id,
			"user_name" => $order->user_name,
			"order_status" => $status
		);
		$this->emails->send_mail($order->user_email, 'change_order_status', $message_info);
		
		switch ($info->type) 
		{
			case "status_id": $data['message'] = "Статус заказа изменен"; break;
			case "payment_id": $data['message'] = "Способ оплаты изменен"; break;
			case "delivery_id": $data['message'] = "Способ доставки изменен"; break;
		}
		
		echo json_encode($data);
	}
	
	function autocomplete()
	{
		$data = json_decode(file_get_contents('php://input', true));	
		
		$this->db->select("value");
		$query = $this->db->get_where('characteristics', array("type" => $data->type));
		$result = $query->result();
		
		$available_tags = array();
		foreach($result as $items)
		{
			foreach ($items as $item)
			{
				if(!empty($item))
				{
					$available_tags[] = $item;
				}
			}
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