<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cart extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}
		
	public function add_to_cart($id = FALSE)
	{
		$product = $this->products->get_item_by(array("id" => $id));
		//var_dump($product);
		$cart_item = array(
			"id" => $product->id,
			"title" => $product->title,
			"price" => $product->price,
			"qty" => 1
		);
		$this->cart->insert($cart_item);
		
		//$cart_contents = $this->session->userdata('cart_contents');
		//var_dump($cart_contents);
		//$this->cart->destroy_cart();
		//$cart_contents = $this->session->userdata('cart_contents');
		//var_dump($cart_contents);
	}
	
	public function delete_item($item_id)
	{
		$this->cart->delete_item($item_id);
		redirect(base_url().'pages/cart');
	}
}