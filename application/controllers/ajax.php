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
	
	function subscribe()
	{
		$info = $this->input->post();
		
		$is_unique = $this->users->is_unique(array("email" => $info['email']));
		
		$subscriders_group = $this->users_groups->get_item_by(array("name" => "subscribers"));
		
		if($is_unique)
		{
			$user = array(
				"name" => $info['email'],
				"email" => $info['email']
			);
			
			$this->users->insert($user);
			
			$user_info = array(
				"group_parent_id" => $subscriders_group->id,
				"child_id" => $this->db->insert_id()
			);
			
			$this->users2users_groups->insert($user_info);
			$data['answer'] = "Благодарим Вас за подписку";
		}
		else
		{
			$user = $this->users->get_item_by(array("email" => $info['email']));
			$users_groups = $this->users2users_groups->get_list(array("child_id" => $user->id));
		
			$counter = 0;
			if($users_groups) foreach($users_groups as $u_g)
			{
				$group = $this->users_groups->get_item_by(array("id" => $u_g->group_parent_id));
				if ($u_g->group_parent_id == $subscriders_group->id) $counter++;
			}
			if($counter == 0)
			{
				$user_info = array(
					"group_parent_id" => $subscriders_group->id,
					"child_id" => $user->id
				);
			
				$this->users2users_groups->insert($user_info);
				$data['answer'] = "Благодарим Вас за подписку";
			}
			else
			{
				$data['answer'] = "Вы уже подписаны на рассылку.";
			}
		}
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
	
	function autocomplete()
	{
		$items = $this->products->get_list(FALSE);
		foreach($items as $i)
		{
			$available_tags[] = $i->name;
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
	
	public function map()
	{
		$info = json_decode(file_get_contents('php://input', true));
		
		$list = $info->map == "page-dealers__map" ? $this->dealers->get_list(FALSE): $this->sells_services->get_list(FALSE);
		
		$items = array();
		
		foreach($list as $l)
		{
			$items[$l->region][] = $l->name;
		}
		
		
		$data = (object)$items;
		
		echo json_encode($data);
	}
	
	public function selected_days()
	{
		$info = json_decode(file_get_contents('php://input', true));
		
		$article = $this->articles->get_item_by(array("url" => $info->parent));

		$sub_level = $this->articles->get_list(array("parent_id" => $article->id));
		$selected_dates = array();
		foreach($sub_level as $item)
		{
			$sub_items = $this->articles->get_list(array("parent_id" => $item->id));

			if(empty($sub_items))
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