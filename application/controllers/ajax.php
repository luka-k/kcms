<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Ajax class

class Ajax extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	function callback()
	{
		$post = $this->input->post();
		$admin_email = $this->config->item('admin_email');
		if($post)
		{
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
		else
		{
			redirect(base_url()."pages/page_404");
		}
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
		$this->config->load('order_config');
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
		$this->emails->send_system_mail($order->user_email, 3, $message_info);
		
		switch ($info->type) 
		{
			case "status_id": $data['message'] = "Статус заказа изменен"; break;
			case "payment_id": $data['message'] = "Способ оплаты изменен"; break;
			case "delivery_id": $data['message'] = "Способ доставки изменен"; break;
		}
		
		echo json_encode($data);
	}
	
	function autocomplete($type = "products")
	{
		$items = $this->$type->get_list(FALSE);
		foreach($items as $i)
		{
			$available_tags[] = $type == "products" ?  $i->name : $i->value;
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
	
	public function dealers()
	{
		$dealers_list = $this->dealers->get_list(FALSE);
		
		$dealers = array();
		
		foreach($dealers_list as $dealer)
		{
			//if(array_key_exists ( $dealer->region , $dealers ))
			
			$dealers[$dealer->region][] = $dealer->name;
		}
		
		
		$data = (object)$dealers;
		
		echo json_encode($data);
	}
	
	public function selected_days(){
		
		$article = $this->articles->get_item_by(array("url" => "novosti"));
		$sub_level = $this->articles->get_list(array("parent_id" => $article->id));
		$selected_dates = array();
		foreach($sub_level as $item)
		{
			$sub_items = $this->articles->get_list(array("parent_id" => $item->id));

			if(!empty($sub_items))foreach($sub_items as $a)
			{
				$item_date = new DateTime($a->date);
				$item_date = date_format($item_date, 'm/d/Y');
				if(!in_array ( $a->date , $selected_dates)) $selected_dates[] = $item_date;
			}
			else
			{
				$item_date = new DateTime($item->date);
				$item_date = date_format($item_date, 'm/d/Y');
				if(!in_array ( $item->date , $selected_dates)) $selected_dates[] = $item_date;
			}	
		}
		$selected_dates[] = date('m/d/Y'); 
	
		$data = $selected_dates;
		
		echo json_encode($data);
	}
}