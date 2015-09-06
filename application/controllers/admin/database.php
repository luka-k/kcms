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
		
		$file_path = FCPATH."import/import.txt";
		
		if(file_put_contents($file_path, serialize($post)))
			echo json_encode('ok');
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
			'orders' => array(
				0 => array('id' => 1, 'card_number' => 22321, 'date' => date('d-M-Y H:i:s'), 'summ' => 150, 'operation' => 'text', 'info' => 'text'),
				1 => array('id' => 2, 'card_number' => 22451, 'date' => date('d-M-Y H:i:s'), 'summ' => 180, 'operation' => 'text', 'info' => 'text'),
				2 => array('id' => 3, 'card_number' => 32321, 'date' => date('d-M-Y H:i:s'), 'summ' => 250, 'operation' => 'text', 'info' => 'text'),
				3 => array('id' => 4, 'card_number' => 55321, 'date' => date('d-M-Y H:i:s'), 'summ' => 350, 'operation' => 'text', 'info' => 'text')
			),
			'orders2products' => array(
				0 => array('order_id' => 1, 'product_id' => 34, 'quantity' => 1),
				1 => array('order_id' => 2, 'product_id' => 14, 'quantity' => 1),
				2 => array('order_id' => 2, 'product_id' => 25, 'quantity' => 2)
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