<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Главная страница

class Main extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{		
		$settings = $this->settings->get_item_by(array('id' => 1));
		$cart = $this->cart->get_all();
		$total_price = $this->cart->total_price();
		$total_qty = $this->cart->total_qty();
		$content = $this->products->get_list(FALSE, $from = FALSE, $limit = FALSE, "sort", "asc");
		$content = $this->images->get_img_list($content, 'products', 'catalog_mid');
		$content = $this->products->get_urls($content);

		$viewed_id = $this->session->userdata('viewed_id');

		if ($viewed_id)
		{
			$viewed = $this->products->get_item_by(array("id" => $viewed_id));
			$viewed->img = $this->images->get_images(array("object_type" => "products", "object_id" => $viewed->id), 1);
		}
		else
		{
			$viewed = "";
		}
		
		$main = $this->information->get_item_by(array("url" => "main"));
		
		$slider = $this->slider->get_list(FALSE);
		$slider = $this->images->get_img_list($slider, 'slider', 'slider');
		$data = array(
			'title' => $settings->site_title,
			'meta_title' => $settings->site_title,
			'meta_keywords' => $settings->site_keywords,
			'meta_description' => $settings->site_description,
			'top_menu' => $this->menus->top_menu,
			'tree' => $this->categories->get_tree(0, "parent_id"),
			'cart' => $cart,
			'viewed' => $viewed,
			'total_price' => $total_price,
			'total_qty' => $total_qty,
			'slider' => $slider,
			'content' => $content,
			'main' => $main,
			'footer_menu' => $this->menus->footer_menu
		);
		
		$this->load->view('client/main.php', $data);
	}	
}

/* End of file main.php */
/* Location: ./application/controllers/main.php */