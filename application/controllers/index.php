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

		$left_menu = $this->dynamic_menus->get_menu(4);
		
		$data = array(
			'title' => $settings->site_title,
			'meta_title' => $settings->site_title,
			'meta_keywords' => $settings->site_keywords,
			'meta_description' => $settings->site_description,
			'cart_items' => $this->cart_items,
			'total_price' => $this->total_price,
			'total_qty' => $this->total_qty,
			'product_word' => end_maker("товар", $this->total_qty),
			'products_special' => $this->products->get_prepared_list($this->products->get_list(array('new' => 1), 0, 4, 'id', 'desc')),
			'top_menu' => $this->menus->set_active($this->top_menu, 'main'),
			'left_menu' => $left_menu,
			'news' => $this->articles->get_prepared_list($this->articles->get_list(array('parent_id' => 3), 0, 5, 'id', 'desc')),
			'articles' => $this->articles->get_prepared_list($this->articles->get_list(array('parent_id' => 1), 0, 5, 'id', 'desc')),
			'content' => $this->articles->get_item_by(array('url' => '/'))
			//'video' => $this->articles-get_list(array())
		);
		//var_dump($data['products_special']);
		$this->load->view('client/main.php', $data);
	}	
}

/* End of file index.php */
/* Location: ./application/controllers/index.php */