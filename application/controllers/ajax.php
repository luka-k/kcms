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
	
	/**
	* Добавление товара в wishlist
	*/
	public function add_to_wishlist()
	{
		$info = json_decode(file_get_contents('php://input', true));
		
		if(!isset($info->id)) add_log("wishlist", "Не задан id элемента вишлиста для обновления.");

		$this->wishlist->insert($info->id);
		
		$data['message'] = "Ok";
		echo json_encode($data);
	}
	
	/**
	* Удаление из wishlist
	*/	
	public function delete_from_wishlist()
	{
		$info = json_decode(file_get_contents('php://input', true));
		
		if(!isset($info->id)) add_log("wishlist", "Не задан id элемента вишлиста для обновления.");
		
		$this->wishlist->delete($info->id);
		$data['message'] = "Ok";
		echo json_encode($data);
	}
	
	/**
	* Возвращает даты новостей для отметки в календаре
	*/
	public function selected_days()
	{
		$news = $this->articles->get_list(array("parent_id" => 3));
		$selected_dates = array();
		foreach($news as $item)
		{
			$item_date = new DateTime($item->date);
			$item_date = date_format($item_date, 'm/d/Y');
			if(!in_array ( $item->date , $selected_dates)) $selected_dates[] = $item_date;

		}
		$selected_dates[] = date('m/d/Y'); 
	
		$data = $selected_dates;
		
		echo json_encode($data);
	}
	
	public function contact()
	{
		$info = $this->input->post();
		
		$new_order = array();
		
		foreach(array('name', 'product_name', 'mail', 'phone', 'message') as $type)
		{
			$new_order[$type] = $this->input->post($type) ? htmlspecialchars($this->input->post($type)) : '';
		}

		$new_order['date'] = date("Y-m-d");
			
		$this->orders->insert($new_order);
		
		$settings = $this->settings->get_item(1);
				
		$this->emails->send_system_mail($settings->admin_email, 1, $new_order, "admin_order_mail");
		
		echo '["Ваш запрос отправлен! Спасибо! Наши менеджеры свяжутся с вами в ближайшее время"]';
	}
}