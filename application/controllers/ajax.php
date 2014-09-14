<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Ajax class

class Ajax extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		$post = $this->input->post();
		$admin_email = $this->config->item('admin_email');
		$subject = 'Запрос на обратный звонок';
		$message = 'Клиент '.$post['name'].' заказал обратный звонок на номер - '.$post['phone'];
		($this->mail->send_mail($admin_email, $subject, $message));
	}
	
	public function add_to_cart()
	{
		$id = json_decode(file_get_contents('php://input', true));
		$item_id = $id->item_id;
		$product = $this->products->get_item_by(array("id" => $item_id));
		$cart_item = array(
			"id" => $product->id,
			"title" => $product->title,
			"price" => $product->price,
			"qty" => 1
		);
		$this->cart->insert($cart_item);
		
		$data['total_qty'] = $this->cart->total_qty();
		$data['total_price'] = $this->cart->total_price();
		
		echo json_encode($data);
	}
	
	public function update_cart()
	{
		$info = json_decode(file_get_contents('php://input', true));
		$item = array(
			"item_id" => $info->item_id,
			"qty" => $info->qty
		);
		$this->cart->update($item);
		$items = $this->cart->get_all();
		$data['item_total'] = $items[$info->item_id]['item_total'];
 		$data['total_qty'] = $this->cart->total_qty();
		$data['total_price'] = $this->cart->total_price();		
		echo json_encode($data);
	}
	
	public function delete_item()
	{
		$info = json_decode(file_get_contents('php://input', true));
		$item_id = $info->item_id;
		
		$this->cart->delete($item_id);
		
 		$data['total_qty'] = $this->cart->total_qty();
		$data['total_price'] = $this->cart->total_price();		
		echo json_encode($data);
	}
	
	public function change_field()
	{
		$info = json_decode(file_get_contents('php://input', true));
		$item = array(
			"order_id" => $info->order_id,
			"$info->type" => $info->value
		);
		$this->orders->update($item['order_id'], $item);
		
		switch ($info->type) 
		{
			case "order_status": $data['message'] = "Статус заказа изменен"; break;
			case "method_pay": $data['message'] = "Способ оплаты изменен"; break;
			case "method_delivery": $data['message'] = "Способ доставки изменен"; break;
		}
		
		echo json_encode($data);
	}
}