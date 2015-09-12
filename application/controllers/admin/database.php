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
			
			$this->db->select_max('id');
			$row = $this->db->get('orders')->row();
			
			$new_order['id'] = $row->id + 1;
			$new_order['date'] = date("Y-m-d H:m:s"); 
				
			$this->orders->insert($new_order);
				
			$order2products = array();
				
			foreach($products as $p)
			{
				$order2products[] = array(
					'order_id' => $new_order['id'],
					'product_id' => $p->id,
					'quantity' => $p->quantity
				);
			}
				
			foreach($order2products as $o2p)
			{
				$this->order2products->insert($o2p);
			}
		}
		
		$file_path = FCPATH."import/import.txt";
		
		if(file_put_contents($file_path, print_r($post, true)))
		{
			echo json_encode('ok');
		}
		else
		{
			header('HTTP/1.1 466 Failed'); // А какой код ошибки лучше использовать в данном случае?
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
				"summ" => -170.0,
				"card" => "123456",
				"products" => array(
					0 => array("id" => 2, "quantity" => 1),
					1 => array("id" => 3, "quantity" => 1),
				)
			),
			1 => array(
				"id" => 2,
				"summ" => -250.0,
				"card" => "123456",
				"products" => array(
					0 => array("id" => 5, "quantity" => 1),
					1 => array("id" => 1, "quantity" => 2),
				)
			),
			2 => array(
				"id" => 4,
				"summ" => -270.0,
				"card" => "123456",
				"products" => array(
					0 => array("id" => 5, "quantity" => 1),
					1 => array("id" => 2, "quantity" => 1),
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