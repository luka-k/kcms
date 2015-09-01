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
}