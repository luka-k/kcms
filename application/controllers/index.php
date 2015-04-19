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
		//$slider = $this->slider->get_list(FALSE, FALSE, FALSE, "sort", "asc");
		$special = $this->products->get_list(array("is_special" => 1), FALSE, 5);
		$new_products = $this->products->get_list(array("is_new" => 1), FALSE, 5);
		
		$last_news = $this->articles->get_list(array("parent_id" => 1));
		
		$data = array(
			'title' => $this->standart_data['settings']->site_title,
			'select_item' => '',
			'special' => $this->products->prepare_list($special),
			'new_products' => $this->products->prepare_list($new_products),
			'last_news' => $this->articles->prepare_list($last_news),
		);
		$data = array_merge($this->standart_data, $data);
		$this->load->view('client/main.php', $data);
	}	
}

/* End of file Index.php */
/* Location: ./application/controllers/Index.php */