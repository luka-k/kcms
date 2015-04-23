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
		$subject = 'Запрос на обратный звонок';
		$message = 'Клиент '.$post['name'].' заказал обратный звонок на номер - '.$post['phone'];
		($this->mail->send_mail($admin_email, $subject, $message));
	}
	
	public function add_to_cart()
	{
		$id = json_decode(file_get_contents('php://input', true));
		$item_id = $id->item_id;
		$product = $this->products->get_item_by(array("id" => $item_id));
		
		if(!empty($product->discount))
		{
			$product->price = $product->price*(100 - $product->discount)/100;
		}
		
		$cart_item = array(
			"id" => $product->id,
			"name" => $product->name,
			"price" => ceil($product->price  * 61.74 * 0.95),
			"qty" => 1
		);
		
		$this->cart->insert($cart_item);
		
		$this->session->set_userdata(array("buy" => TRUE));
		
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
		
		$this->session->set_userdata(array('active_cart'=>true));
		
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
		
		$this->session->set_userdata(array('active_cart'=>true));
		
 		$data['total_qty'] = $this->cart->total_qty();
		$data['total_price'] = $this->cart->total_price();		
		echo json_encode($data);
	}
	
	public function change_field()
	{
		$info = json_decode(file_get_contents('php://input', true));
		$order_id = $info->order_id;
		$item = array(
			"{$info->type}" => $info->value
		);
		$this->orders->update($order_id, $item);
		
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
	
	public function change_sort()
	{
		$info = json_decode(file_get_contents('php://input', true));
		$type = $info->type;
		$item_id = $info->item_id;
		$sort = $info->sort;
		$this->$type->update($item_id, array("sort" => $sort));
		$data['message'] = "Ok";
		echo json_encode($data);
	}	
	
	public function sortable()
	{
		$post = $this->input->post();
		
		foreach($post as $type => $items)
		{
			foreach ($items as $key => $id)
			{
				$this->$type->update($id, array("sort" => $key));
			}
		}
	}
	
	public function filter()
	{
		$filter = json_decode(file_get_contents('php://input', true));

		$filters = array(
			'parent_checked' => (array)$filter->parent_checked,
			'categories_checked' => (array)$filter->categories_checked,
			'manufacturer_checked' => (array)$filter->manufacturer_checked,
			'attributes_range' => (array)$filter->attributes_range,
			'attributes' => (array)$filter->attributes
		);

		$this->session->unset_userdata('filters');
		
		if ((empty($filters['categories_checked']))&&(empty($filters['manufacturer_checked']))&&(empty($filters['parent_checked']))&&(empty($filters['attributes_range']))&&(empty($filters['attributes'])))
		{	
			$session_data = "";
		}
		else
		{
			$session_data = array(
				'filters' => $filters,				
			);
		}
		$this->session->set_userdata($session_data);

		$data['message'] = "Ok";
		echo json_encode($data);
	}
	
	function autocomplete()
	{
		$data = json_decode(file_get_contents('php://input', true));	
		$categories_checked = (array)$data->categories_checked;
		if(!empty($categories_checked))
		{
			$this->db->where_in('parent_id', $categories_checked);
		}
		else
		{
			$segments = explode("/", $data->url);
			$length = count($segments);
			if($length > 2)
			{
				$url = $segments[$length-1];
				$category = $this->categories->get_item_by(array("url" => $url));
				$query = $this->db->get_where("category2category", array("child_id" => $category->id));
				$category_id = $query->row()->category_parent_id;
				
				if($category_id == 0)
				{
					$this->db->where("category_parent_id", $category->id);
					$query = $this->db->get("category2category");
					$result = $query->result();
					foreach($result as $items)
					{
						foreach ($items as $item)
						{
							if(!empty($item))
							{
								$categories_child[] = $item;
							}
						}
					}
					$this->db->where_in('parent_id', $categories_child);
				}
				else
				{
					$this->db->where("parent_id", $category->id);
				}
			}
		}
		$this->db->select($data->type);
		$query = $this->db->get('products');
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
		$answer['type'] = $data->type;
		$answer['available_tags'] = $available_tags;
		
		echo json_encode($answer);
	}
}