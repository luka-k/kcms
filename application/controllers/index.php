<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//main page controller

class Index extends Client_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{		
		$settings = $this->settings->get_item_by(array('id' => 1));
		
		//$slider = $this->slider->get_list(FALSE, FALSE, FALSE, "sort", "asc");
		$special = $this->products->get_list(array("is_special" => 1), FALSE, 4);
		$new_products = $this->products->get_list(array("is_new" => 1), FALSE, 4);
		
		$last_news = $this->articles->get_list(array("parent_id" => 3));
		
		$data = array(
			'title' => $settings->site_title,
			'select_item' => '',
			'special' => $this->products->prepare_list($special),
			'new_products' => $this->products->prepare_list($new_products),
			'last_news' => $this->articles->prepare_list($last_news),
			'settings' => $settings
		);
		$data = array_merge($this->standart_data, $data);
		$this->load->view('client/main.php', $data);
	}	
}

/* End of file Index.php */
/* Location: ./application/controllers/Index.php */