<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Index class
*
* @package		kcms
* @subpackage	Controllers
* @category	    Index
*/
class Index extends Client_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{		
		$slider = $this->slider->get_list(FALSE, FALSE, FALSE, "sort", "asc");
		
		$max_value = $max_price = $this->products->get_max('price');
		$min_value = $min_price = $this->products->get_min('price'); 
		
		$products = $this->products->get_list(FALSE, 0, 10);
			
		$this->load->config('articles');
		$last_news = $this->articles->get_list(array("parent_id" => $this->config->item('news_id')), FALSE, 4);

		$data = array(
			'title' => $this->standart_data['settings']->site_title,
			'select_item' => '',
			'slider' => $this->slider->prepare_list($slider),
			'filters' => $this->characteristics_type->get_filters(),
			'min_price' => $min_price,
			'max_price' => $max_price,
			'min_value' => $min_value,
			'max_value' => $max_value,
			'products' => $this->products->prepare_list($products),
			'last_news' => $this->articles->prepare_list($last_news),
			'is_main' => TRUE
		);
		if($this->standart_data['cart_items'])	$this->standart_data['cart_items'] = $this->products->prepare_list($this->standart_data['cart_items']);
		$data = array_merge($this->standart_data, $data);
		$this->load->view('client/index.php', $data);
	}	
}

/* End of file Index.php */
/* Location: ./application/controllers/Index.php */