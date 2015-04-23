<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Главная страница

class Main extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{		
		if ($_POST) die('ok');
		redirect('/shop');
		$settings = $this->settings->get_item_by(array('id' => 1));
		$top_menu = $this->menus->top_menu;
		
		$cart = $this->cart->get_all();
		$total_price = $this->cart->total_price();
		$total_qty = $this->cart->total_qty();
		
		$data = array(
			'title' => $settings->site_title,
			'meta_title' => $settings->site_title,
			'meta_keywords' => $settings->site_keywords,
			'meta_description' => $settings->site_description,
			'top_menu' => $top_menu,
			'cart' => $cart,
			'total_price' => $total_price,
			'total_qty' => $total_qty,
			'product_word' => end_maker("товар", $total_qty)
		);
		$this->load->view('client/main.php', $data);
	}	
}

/* End of file main.php */
/* Location: ./application/controllers/main.php */