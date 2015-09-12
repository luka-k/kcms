<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Ajax class
*
* @package		kcms
* @subpackage	Controllers
* @category	    Ajax
*/
class Ajax extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	
	/**
	* Изменение уведомлений ученика
	*/
	
	public function set_child_status()
	{
		$info = json_decode(file_get_contents('php://input', true));
		
		$data = array(
			$info->type.'_sms_enabled' => $info->status,
			$info->type.'_sms_enabled_date' => date("Y-d-m")
		);
		
		$this->child_users->update($info->child_id, $data);
		
		$answer = array(
			'type' => $info->type,
			'status' => $info->status,
			'date' => date("d.m.Y")
		);
		
		echo json_encode($answer);
	}
	
	public function set_child_limit()
	{
		$info = json_decode(file_get_contents('php://input', true));
		$limit = trim(str_replace(' р.', '', $info->limit));

		$data = array(
			'card_day_limit' => $limit
		);

		$this->db->where('card_number', $info->card_number);
		$this->db->update('cards', $data);
		
		echo json_encode('ok');
	}
	
	public function set_product_status()
	{
		$info = json_decode(file_get_contents('php://input', true));
		
		$data = array(
			'child_user_id' => $info->child_id,
			'product_id' => $info->product_id,
			'disabled' => !$info->status
		);
		
		$this->db->where('product_id', $info->product_id);
		$this->db->where('child_user_id', $info->child_id);
		$this->db->update('child2product', $data); 
		
		echo json_encode('ok');
	}

	/**
	* Отправка формы обратной связи
	*/
	function callback()
	{
		$post = json_decode(file_get_contents('php://input', true));
	
		$settings = $this->settings->get_item_by(array("id" => 1));
		
		$message_info = array(
			"USER_NAME" => $post->name,
			"USER_PHONE" => $post->phone
		);
		
		if($this->emails->send_system_mail($settings->admin_email, 6, $message_info))
		{
			$log = "Отправлено письмо на адрес - ".$settings->admin_email." от пользователя - ".$post->name; 
			add_log("callback", $log);
		}
		else
		{
			add_log("ajax", "Отправка не удалась");
		}
		
		$data['message'] = "ok";
		echo json_encode($data);
	}
	
	/**
	* Добавление товара в корзину
	*/
	public function add_to_cart()
	{
		$info = json_decode(file_get_contents('php://input', true));
		$product = $this->products->get_item_by(array("id" => $info->product_id));
		
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
		
		if($item_id)
		{
			$log = "Товар ".$product->name." добавлен в корзину в количестве - ".$info->qty." шт.";
		}
		else
		{
			$log = 'Добавление товара в корзину не удалось. $info->product_id = ';
			$log .= isset($info->product_id) ? "$info->product_id" : "undefined";
			$log .= isset($product->name) ? "$product->name" : "undefined";
		}
		add_log("cart", $log);
		
		$item = $this->cart->get($item_id);
		
		$data = array(
			'item_id' => $item_id,
			'item_qty' => $item['qty'],
			'total_qty' => $this->cart->total_qty(),
			'total_price' => $this->cart->total_price(),
			'product_word' => $this->string_edit->set_word_form("товар", $this->cart->total_qty())
		);

		echo json_encode($data);
	}
	
	/**
	* Обновление корзины
	*/
	public function update_cart()
	{
		$info = json_decode(file_get_contents('php://input', true));
		
		if(!isset($info->item_id)) add_log("cart", "Не задан id элемента корзины для обновления.");
		if(!isset($info->qty)) add_log("cart", "Не задан количество товара");
		
		$this->cart->update(array("item_id" => $info->item_id, "qty" => $info->qty));
		$item = $this->cart->get($info->item_id);
		
		$data = array(
			'item_id' => $info->item_id,
			'item_total' => $item['item_total'],
			'item_qty' => $item['qty'],
			'total_qty' => $this->cart->total_qty(),
			'total_price' => $this->cart->total_price(),
			'product_word' => $this->string_edit->set_word_form("товар", $this->cart->total_qty())
		);
	
		echo json_encode($data);
	}
	
	/**
	* Удаление из корзины
	*/
	public function delete_item()
	{
		$info = json_decode(file_get_contents('php://input', true));

		if(!isset($info->item_id)) add_log("cart", "Не задан id элемента корзины для удаления.");
		
		$this->cart->delete($info->item_id);
		
		$data = array(
			'item_id' => $info->item_id,
			'total_qty' => $this->cart->total_qty(),
			'total_price' => $this->cart->total_price(),
		);
		
		echo json_encode($data);
	}
		
	function autocomplete()
	{
		$products = $this->products->get_list(FALSE);
		
		foreach($products as $p)
		{
			$available_tags[] = $p->name;
		}
		$answer['available_tags'] = $available_tags;
		
		echo json_encode($answer);
	}
}