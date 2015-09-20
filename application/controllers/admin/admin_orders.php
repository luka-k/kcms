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
		
		$select_date = $this->input->get('date');
		if(!empty($select_date))
		{
			$date = new DateTime($select_date);
			$this->db->like('date', date_format($date, 'Y-m-d'));
			$orders = $this->db->get('orders')->result();
		}
		else
		{
			$orders = $this->orders->get_list(FALSE);
		}
		
		$orders_info = array();
		foreach ($orders as $key => $order)
		{	
			$orders_info[$key] = new stdClass();	
			
			$date = new DateTime($order->date);

			$order2products = $this->order2products->get_list(array("order_id" => $order->id));
			
			$products_ids = array();
			$qty = array();
			if($order2products) foreach($order2products as $i => $o2p)
			{
				$products_ids[] = $o2p->product_id;	
				$qty[$o2p->product_id] = $o2p->quantity;
			}
			
			$child = $this->child_users->get_item_by(array('card_number' => $order->card_number));
			
			$order_items = array();
			
			if(!empty($products_ids))
			{
				$this->db->where_in('id', $products_ids);
				$order_items = $this->db->get('products')->result();
			}
			
			$orders_info[$key] = (object)array( 
				"id" => $order->id,
				"order_products" => $order_items,
				'qty' => $qty,
				"order_date" => date_format($date, 'Y-m-d'),
				"card_number" => $order->card_number,
				'child' => $this->child_users->prepare($child, TRUE)
				/*"phone" => $order->user_phone,
				"email" => $order->user_email,
				"address" => $order->user_address*/
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