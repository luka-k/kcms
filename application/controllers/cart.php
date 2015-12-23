<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Cart class
*
* @package		kcms
* @subpackage	Controllers
* @category	    Cart
*/
class Cart extends Client_Controller 
{	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$this->breadcrumbs->Add("catalog", "Корзина");
		
		$this->config->load('orders');
		if($this->standart_data['cart_items'])	$this->standart_data['cart_items'] = $this->products->prepare_list($this->standart_data['cart_items']);
		$data = array(
			'title' => "Корзина",
			'breadcrumbs' => $this->breadcrumbs->get(),
			'selects' => array(
				'delivery_id' => $this->config->item('method_delivery'),
				'payment_id' => $this->config->item('method_pay')
			),
			'action' => $this->input->get('action'),
			'select_item' => '',
			'order_string' => $this->standart_data['settings']->order_string
		);
		$data = array_merge($this->standart_data, $data);
		$this->load->view('client/cart.php', $data);
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
			'autor' => $product->autor,
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
		
		$product = $this->products->prepare($cart_item);
		
		$content = $this->load->view('client/include/cart-item.php', ['item' => $product], TRUE);
		
		$data = array(
			'item_id' => $item_id,
			'item_qty' => $item['qty'],
			'total_qty' => $this->cart->total_qty(),
			'total_price' => $this->cart->total_price(),
			'product_word' => $this->string_edit->set_word_form("товар", $this->cart->total_qty()),
			'content' => $content
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
}