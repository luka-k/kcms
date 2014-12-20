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
		$slider = $this->slider->get_list(FALSE);
		
		$good_buy = $this->products->get_list(array("is_good_buy" => 1));
		$new_products = $this->products->get_list(array("is_new" => 1));
		$last_news = $this->articles->get_list(array("parent_id" => 1));
		
		$video = $this->video->get_list(array("is_main" => 1));
		
		$settings = $this->settings->get_item_by(array("id" => 1));
		
		$data = array(
			'title' => $settings->site_title,
			'meta_title' => $settings->site_title,
			'meta_keywords' => $settings->site_keywords,
			'meta_description' => $settings->site_description,
			'top_menu' => $this->top_menu,
			'slider' => $this->slider->get_prepared_list($slider),
			'good_buy' => $this->products->get_prepared_list($good_buy),
			'new_products' => $this->products->get_prepared_list($new_products),
			'last_news' => $this->articles->get_prepared_list($last_news),
			'video' => $this->video->get_prepared_list($video),
			'settings' => $settings
		);
		//var_dump($data['good_buy']);
		$this->load->view('client/main.php', $data);
	}	
}

/* End of file index.php */
/* Location: ./application/controllers/index.php */