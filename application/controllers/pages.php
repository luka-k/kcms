<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//Вывод страниц разделов
class Pages extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		
		$this->config->load('order_config');
	}
	
	public function cart()
	{
		$this->breadcrumbs->Add("catalog", "Корзина");
		
		$top_menu = $this->menus->top_menu;
		$top_menu = $this->menus->set_active($top_menu, 'shop');
		$left_menu = $this->categories->get_tree(0, "category_parent_id");
		
		$cart = $this->cart->get_all();
		$total_price = $this->cart->total_price();
		$total_qty = $this->cart->total_qty();
		
		$settings = $this->settings->get_item_by(array("id" => 1));
		
		$categories_checked = "";
		$categories_ch = "";
		$manufacturer_checked = "";
		
		$manufacturer = $this->manufacturer->get_list(FALSE);
		
		$left_active = "filt-1";
		
		$data = array(
			'title' => "Оформление заказа",
			'meta_title' => $settings->site_title,
			'meta_keywords' => $settings->site_keywords,
			'meta_description' => $settings->site_description,
			'manufacturer' => $manufacturer,
			'breadcrumbs' => $this->breadcrumbs->get(),
			'cart' => $cart,
			'total_price' => $total_price,
			'total_qty' => $total_qty,
			'selects' => array(
				'delivery_id' => $this->config->item('method_delivery'),
				'payment_id' => $this->config->item('method_pay')
			),
			'product_word' => end_maker("товар", $total_qty),
			'top_menu' => $top_menu,
			'left_menu' => $left_menu,
			'left_active' => $left_active,
			'categories_checked' => $categories_checked,
			'manufacturer_checked' => $manufacturer_checked,
			'categories_ch' => $categories_ch
		);
		$this->load->view('client/cart.php', $data);
	}
}

/* End of file pages.php */
/* Location: ./application/controllers/news.php */