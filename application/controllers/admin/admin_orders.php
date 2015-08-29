<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Admin_orders class
*
* @package		kcms
* @subpackage	Controllers
* @category	    admin_orders
*/
class Admin_orders extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();
		
		$this->config->load('orders');
	}
	
	/**
	* Вывод заказов в админку
	*/
	public function index()
	{		

		$orders = $this->orders->get_list(FALSE);
		
		foreach($orders as $i => $o)
		{
			$item_date = new DateTime($o->date);
			$orders[$i]->date = date_format($item_date, "Y-m-d");
		}
		
		$data = array(
			'title' => "Заказы",			
			'orders' => array_reverse($orders),
			'url' => "/".$this->uri->uri_string()
		);	
		$data = array_merge($this->standart_data, $data);
		
		$this->load->view('admin/orders.php', $data);
	}
	
	/**
	* Изменения информации о заказе
	*/
	public function change_field()
	{
		$info = json_decode(file_get_contents('php://input', true));

		$this->orders->update($info->id, array("{$info->type}" => $info->value));
		
		$order = $this->orders->get_item($info->id);
		
		$status_id = $this->config->item('order_status');
		
		foreach($status_id as $key => $value)
		{
			if ($order->status_id == $key) $status = $value;
		}
		
		switch ($info->type) 
		{
			case "status_id": $data['message'] = "Статус заказа изменен"; 
				$message_info = array(
					"order_code" => $order->order_code,
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
}