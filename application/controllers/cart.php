<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cart extends Client_Controller 
{	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$this->breadcrumbs->Add("catalog", "Корзина");
		
		$settings = $this->settings->get_item_by(array("id" => 1));
		
		$this->config->load('orders');

		$data = array(
			'title' => "Корзина",
			'breadcrumbs' => $this->breadcrumbs->get(),
			'selects' => array(
				'delivery_id' => $this->config->item('method_delivery'),
				'payment_id' => $this->config->item('method_pay')
			),
			'action' => $this->input->get('action'),
			'order_string' => $settings->order_string
		);
		$data = array_merge($this->standart_data, $data);
		$this->load->view('client/cart.php', $data);
	}
}