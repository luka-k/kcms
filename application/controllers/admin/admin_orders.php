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
	public function index($filter = FALSE)
	{
		$delivery_id = $this->config->item('method_delivery');
		$payment_id = $this->config->item('method_pay');
		
		if ($filter == FALSE)
		{
			$orders = $this->orders->get_list(FALSE);
		}
		elseif($filter == "by_order_code")
		{
			$order_code = $this->input->post("order_code");
			$orders = $this->orders->get_list(array("order_code" => $order_code));
		}
		else
		{
			$orders = $this->orders->get_list(array("status_id" => $filter));
		}
		
		$orders_info = array();
		foreach ($orders as $key => $order)
		{	
			$orders_info[$key] = new stdClass();	
			
			$date = new DateTime($order->date);

			$order_items = $this->orders_products->get_list(array("order_id" => $order->id));
			
			$orders_info[$key] = (object)array( 
				"id" => $order->id,
				"order_code" => $order->order_code,
				"status_id" => $order->status_id,
				"order_products" => $order_items,
				"delivery_id" => $order->delivery_id,
				"payment_id" => $order->payment_id,
				"order_date" => date_format($date, 'Y-m-d'),
				"name" => $order->user_name,
				"phone" => $order->user_phone,
				"email" => $order->user_email,
				"address" => $order->user_address
			);
		}
		
		$data = array(
			'title' => "Заказы",			
			'orders_info' => array_reverse($orders_info),
			'selects' => array(
				'delivery_id' => $this->config->item('method_delivery'),
				'payment_id' => $this->config->item('method_pay'),
				'status_id' => $this->config->item('order_status')
			),
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