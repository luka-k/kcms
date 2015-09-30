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
		
		$price_min = $price_from = $this->products->get_min('price');
		if(!empty($this->post['price_from'])) $price_from = preg_replace("/[^0-9]/", "", $this->post['price_from']);
		$price_max = $price_to = $this->products->get_max('price');
		if(!empty($this->post['price_to'])) $price_to = preg_replace("/[^0-9]/", "", $this->post['price_to']);

		$width_min = $width_from = $this->products->get_min('width');
		if(!empty($this->post['width_from'])) $width_from = preg_replace("/[^0-9]/", "", $this->post['width_from']);
		$width_max = $width_to = $this->products->get_max('width');
		if(!empty($this->post['width_to'])) $width_to = preg_replace("/[^0-9]/", "", $this->post['width_to']);
		
		$height_min = $height_from = $this->products->get_min('height');
		if(!empty($this->post['height_from'])) $height_from = preg_replace("/[^0-9]/", "", $this->post['height_from']);
		$height_max = $height_to = $this->products->get_max('height');
		if(!empty($this->post['height_to'])) $height_to = preg_replace("/[^0-9]/", "", $this->post['height_to']);
		
		$depth_min = $depth_from = $this->products->get_min('depth');
		if(!empty($this->post['depth_from'])) $depth_from = preg_replace("/[^0-9]/", "", $this->post['depth_from']);
		$depth_max = $depth_to = $this->products->get_max('depth');
		if(!empty($this->post['depth_to'])) $depth_to = preg_replace("/[^0-9]/", "", $this->post['depth_to']);
		
		$availability = $this->config->item('availability');
		foreach($availability as $key => $value)
		{
			$filters_checked[$key] = 1;
		}
		
		$data = array(
			'title' => "Корзина",
			'breadcrumbs' => $this->breadcrumbs->get(),
			'selects' => array(
				'delivery_id' => $this->config->item('method_delivery'),
				'payment_id' => $this->config->item('method_pay')
			),
			'price_from' => $price_from,
			'price_to' => $price_to,
			'price_min' => $price_min,
			'price_max' => $price_max,
			'width_from' => $width_from,
			'width_to' => $width_to,
			'width_min' => $width_min,
			'width_max' => $width_max,
			'height_from' => $height_from,
			'height_to' => $height_to,
			'height_min' => $height_min,
			'height_max' => $height_max,
			'depth_from' => $depth_from,
			'depth_to' => $depth_to,
			'depth_min' => $depth_min,
			'depth_max' => $depth_max,
			'left_menu' => $this->categories->get_tree(),
			'collection' => $this->collections->get_tree(),
			'sku_tree' => $this->manufacturers->get_tree(),
			'manufacturer' => $this->manufacturers->get_tree(FALSE),
			'action' => $this->input->get('action'),
			'availability' => $availability,
			'filters_checked' => $filters_checked,
			'select_item' => '',
			'order_string' => $this->standart_data['settings']->order_string
		);
		
		if(!empty($data['sku_tree']))foreach($data['sku_tree'] as $manufacturer)
		{
			foreach($manufacturer->sku as $i => $sku)
			{
				$manufacturer->sku[$i]->full_url = $this->products->get_url($sku);
			}
		}
		
		$data['availability_ch'] = array();
		foreach($availability as $key => $value)
		{
			if($data['filters_checked'][$key] == 1) $data['availability_ch'][] = $value;
		}

		$data = array_merge($this->standart_data, $data);
		$this->load->view('client/shop/cart.php', $data);
	}
	
	public function add_to_precart()
	{
		$info = json_decode(file_get_contents('php://input', true));
		
		$pre_cart = array(
			"items" => array(),
			"total_qty" => 0,
			"total_price" => 0
		);
		if($this->session->userdata('pre_cart')) $pre_cart = $this->session->userdata('pre_cart');
		
		$product = $this->products->get_item($info->id);
		$product = $this->characteristics->get_product_characteristics($product);
		
		$product->price = round($product->price, -1);
		if(isset($product->sale_price))
		{		
			$product->sale_price = round($product->sale_price, -1);
			if($product->price <> 0) $product->discount = round(($product->price - $product->sale_price) * 100 / $product->price);
		}
		
		$item = array(
			"id" => $product->id,
			"name" => $product->name,
			"price" => $product->sale_price,
			"qty" => 1,
			"item_total" => $product->sale_price
		);
		$item_id = md5($info->id);
		$pre_cart['items'][$item_id] = $item;
		
		$total_qty = 0;
		$total_price = 0;
		foreach($pre_cart['items'] as $item)
		{
			$total_price += $item['price']*$item['qty'];
			$total_qty += $item['qty'];		
		}

		$pre_cart['total_qty'] = $total_qty;
		$pre_cart['total_price'] = $total_price + $info->price;
		$this->session->set_userdata(array('pre_cart' => $pre_cart));
		
		$data = array(
			'item_id' => $item_id,
			'item_qty' => 1,
			'item_price' => $product->sale_price,
			'item_total' => $product->sale_price,
			'total_price' => $pre_cart['total_price'],
			'id' => $info->id,
			'type' => $info->type,
			'action' => "add"
		);
		echo json_encode($data);
	}
	
	public function update_precart(){
		$info = json_decode(file_get_contents('php://input', true));
		
		$pre_cart = $this->session->userdata('pre_cart');
		if($info->action == "plus")
		{
			$pre_cart['items'][$info->item_id]['qty']++;
			$pre_cart['total_price'] = $pre_cart['total_price'] + $pre_cart['items'][$info->item_id]['price'];
		}
		else
		{
			if($pre_cart['items'][$info->item_id]['qty'] > 1)
			{
				$pre_cart['items'][$info->item_id]['qty']--;
				$pre_cart['total_price'] = $pre_cart['total_price'] - $pre_cart['items'][$info->item_id]['price'];
			}
		}
		
		$pre_cart['items'][$info->item_id]['item_total'] = $pre_cart['items'][$info->item_id]['qty']*$pre_cart['items'][$info->item_id]['price'];
		
		$this->session->set_userdata(array('pre_cart' => $pre_cart));
		
		$data = array(
			'item_id' => $info->item_id,
			'item_qty' => $pre_cart['items'][$info->item_id]['qty'],
			'item_total' => $pre_cart['items'][$info->item_id]['item_total'],
			'total_price' => $pre_cart['total_price'],
		);
		echo json_encode($data);
		
	}
	
	public function delete_from_precart()
	{
		$info = json_decode(file_get_contents('php://input', true));
		$item_id = md5($info->id);
		$pre_cart = $this->session->userdata('pre_cart');

		$product = $this->products->get_item($pre_cart['items'][$item_id]['id']);
		
		$product->price = round($product->price, -1);
		if(isset($product->sale_price))
		{		
			$product->sale_price = round($product->sale_price, -1);
			if($product->price <> 0) $product->discount = round(($product->price - $product->sale_price) * 100 / $product->price);
		}
		
		$pre_cart['total_price'] = $pre_cart['total_price'] - $product->sale_price;;
		unset($pre_cart['items'][$item_id]);
		$this->session->set_userdata(array('pre_cart' => $pre_cart));
		
		$data = array(
			'item_id' => $item_id,
			'total_price' => $pre_cart['total_price'],
			'type' => $info->type,
			'id' => $info->id,
			'price' => $product->price,
			'discount' => $product->discount,
			'sale_price' => $product->sale_price,
			'location' => "",
			'place' => $info->place,
			'action' => "delete"
		);
		echo json_encode($data);
	}
	
	public function precart_to_cart()
	{
		$info = json_decode(file_get_contents('php://input', true));
		
		$main_product = $this->products->get_item($info->product_id);
		
		$main_product->price = round($main_product->price, -1);
		if(isset($main_product->sale_price))
		{		
			$main_product->sale_price = round($main_product->sale_price, -1);
			if($main_product->price <> 0) $main_product->discount = round(($main_product->price - $main_product->sale_price) * 100 / $main_product->price);
		}
		
		$cart_item = array(
			"id" => $main_product->id,
			"parent_id" => $main_product->parent_id,
			"name" => $main_product->name,
			"url" => $main_product->url,
			"price" => $main_product->sale_price,
			"discount" => $main_product->discount,
			"qty" => 1
		);
		
		$item_id = $this->cart->insert($cart_item);
		
		$pre_cart = $this->session->userdata('pre_cart');
		if($pre_cart) foreach($pre_cart['items'] as $item)
		{	
			$product = $this->products->get_item($item['id']);
		
			$product->price = round($product->price, -1);
			if(isset($product->sale_price))
			{		
				$product->sale_price = round($product->sale_price, -1);
				if($product->price <> 0) $product->discount = round(($product->price - $product->sale_price) * 100 / $product->price);
			}
		
			$cart_item = array(
				"id" => $product->id,
				"parent_id" => $product->parent_id,
				"name" => $product->name,
				"url" => $product->url,
				"price" => $product->sale_price,
				"discount" => $product->discount,
				"qty" => $item['qty']
			);
			
			$item_id = $this->cart->insert($cart_item);
		}
		
		$data = array(
			'total_qty' => $this->cart->total_qty(),
			'total_price' => $this->cart->total_price(),
			'product_word' => $this->string_edit->set_word_form("товар", $data['total_qty'])
		);
		
		echo json_encode($data);
	}	
}