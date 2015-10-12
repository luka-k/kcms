<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Database extends CI_Controller 
{

	public function __construct()
	{
		parent::__construct();
	}
	
	public function export($school_id)
	{			
		$file_path = FCPATH."export/export_{$school_id}.sqlite";

		$modified_time = filemtime($file_path);
		$modified_time_str = gmdate('D, d M Y H:i:s', $modified_time).' GMT';

		if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) && strtotime($_SERVER['HTTP_IF_MODIFIED_SINCE']) >= $modified_time)	
		{
			header('HTTP/1.1 304 Not Modified');
			header('Last-Modified: '.$modified_time_str);
			
			exit();
		}

		header('Last-Modified: '.$modified_time_str);
		echo file_get_contents($file_path);
	}
	
	public function import()
	{
		$post = json_decode(file_get_contents('php://input', true));
		
		$file_path = FCPATH."logs/orders/orders".date('d-m-Y').".txt";

		foreach($post as $order)
		{
			$new_order = array();
			foreach($order as $key => $item)
			{		
				if($key == 'card')
				{
					$new_order['card_number'] = $item;
				}
				elseif($key == 'products')
				{
					$products = $item;
				}
				else
				{
					$new_order[$key] = $item;
				}
			}
			
			$new_order['date'] = date("Y-m-d H:m:s"); 
			$new_order['operation'] = 'заказ';
			unset($new_order['id']);
			
			$query = $this->orders->insert($new_order);
			
			if(!$query) 
			{
				header('HTTP/1.1 406 Not Acceptable');
				die(); //По логике продолжать выполнение скрипта не нужно же?
			}
					
			$order_id = $this->db->insert_id();
			
			$this->db->where('card_number', $new_order['card_number']);
			$this->db->select('card_balance');
			$card_balance = $this->db->get('cards')->row()->card_balance;
			
			$card_balance = $card_balance - $new_order['summ'];
			
			$this->db->where('card_number', $new_order['card_number']);
			$this->db->update('cards', array('card_balance' => $card_balance));
			
			$products_string = '';			
			foreach($products as $i => $p)
			{
				$order2products = array(
					'order_id' => $order_id,
					'product_id' => $p->id,
					'quantity' => $p->quantity
				);
				
				$product = $this->products->get_item($p->id);
				
				$products_string .= $product->name;
				
				$products_string .= $i == count($products) - 1 ? '.' : ', ';
				
				$query = $this->order2products->insert($order2products);
				
				if(!$query) 
				{
					header('HTTP/1.1 406 Not Acceptable');
					die();
				}
			}

			$child = $this->child_users->get_item_by(array('card_number' => $new_order['card_number']));
			if($child->dinner_sms_enabled)
			{
				$this->load->helper('sms');
				
				$parent = $this->users->get_item($child->parent_id);
				
				$message = 'Уважаемый(-ая) '.$parent->name.'! '.date("d/m/y H:m:s").', Ваш ребенок, соверщил заказ на сумму: '.$new_order['summ'].'.';
				$message .= 'Состав заказа: '.$products_string;

				$this->cards->debiting($child->card_number, 'dinner_sms') ? send_sms($parent->phone, $message) : add_log('dinner_sms', 'Не возможно списать средства. смс на номер - '.$parent->phone.' не отправлен');
			}
		}
			
		if(file_put_contents($file_path, print_r($post, true), FILE_APPEND))
		{
			echo json_encode('ok');
		}
		else
		{
			header('HTTP/1.1 406 Not Acceptable');
		}
	}
	
	public function test_export()
	{
		//$header = array('If-Modified-Since: '.date('D, d M Y H:i:s').' GMT');
		$header = array('If-Modified-Since: Mon, 26 Jul 1997 00:00:00 GMT');
		
		if($curl = curl_init(base_url().'admin/database/export/shkola-1')) 
		{
			curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
			$out = curl_exec($curl);
			echo $out;
			curl_close($curl);
		}

	}
	
	public function test_import()
	{
		$info = array(
			0 => array(
				"id" => 3,
				"summ" => 100.0,
				"card" => "3333",
				"products" => array(
					0 => array("id" => 2, "quantity" => 1),
					1 => array("id" => 3, "quantity" => 1),
				)
			)
		);

		$post = json_encode($info);
		
		if($curl = curl_init(base_url().'admin/database/import')) {
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, false);
			curl_setopt($curl, CURLOPT_POST, true);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
			
			echo curl_exec($curl);

			curl_close($curl);
		}
	}
}