<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//Вывод страниц разделов
class Pages extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		
		$this->config->load('order_config');
	}
	
	public function index($part_url, $url)
	{	
		$top_menu = $this->menus->top_menu;
		$footer_menu = $this->menus->footer_menu;
		
		$slider = $this->slider->get_list(FALSE);
		$slider = $this->images->get_img_list($slider, 'slider', 'slider');
		
		$cart = $this->cart->get_all();
		$total_price = $this->cart->total_price();
		$total_qty = $this->cart->total_qty();	
		
		$viewed_id = $this->session->userdata('viewed_id');
		if (isset($viewed_id))
		{
			$viewed = $this->products->get_item_by(array("id" => $viewed_id));
			$viewed->img = $this->images->get_images(array("object_type" => "products", "object_id" => $viewed->id), 1);
		}
		
		$item = $this->information->get_item_by(array("url" => $url));
		
		if ($item == NULL)
		{
			$this->load->view('client/404.php', $data);
		}

		$data = array(
			'title' => $item->title,
			'meta_title' => $item->meta_title,
			'meta_keywords' => $item->meta_keywords,
			'meta_description' => $item->meta_description,
			'tree' => $this->categories->get_tree(0, "parent_id"),
			'cart' => $cart,
			'viewed' => $viewed,
			'total_price' => $total_price,
			'total_qty' => $total_qty,
			'content' => $item,
			'top_menu' => $top_menu,
			'footer_menu' => $footer_menu,
			'slider' => $slider
		);

		$this->load->view('client/pages.php', $data);
	}
	
	public function contact()
	{
		$top_menu = $this->menus->top_menu;
		$footer_menu = $this->menus->footer_menu;
		
		$slider = $this->slider->get_list(FALSE);
		$slider = $this->images->get_img_list($slider, 'slider', 'slider');
		
		$cart = $this->cart->get_all();
		$total_price = $this->cart->total_price();
		$total_qty = $this->cart->total_qty();	
		
		$viewed_id = $this->session->userdata('viewed_id');
		if (isset($viewed_id))
		{
			$viewed = $this->products->get_item_by(array("id" => $viewed_id));
			$viewed->img = $this->images->get_images(array("object_type" => "products", "object_id" => $viewed->id), 1);
		}
		
		$item = $this->settings->get_item_by(array("id" => 1));

		$data = array(
			'title' => $item->site_title,
			'meta_title' => $item->site_title,
			'meta_keywords' => $item->site_keywords,
			'meta_description' => $item->site_description,
			'tree' => $this->categories->get_tree(0, "parent_id"),
			'cart' => $cart,
			'viewed' => $viewed,
			'total_price' => $total_price,
			'total_qty' => $total_qty,
			'content' => $item,
			'top_menu' => $top_menu,
			'footer_menu' => $footer_menu,
			'slider' => $slider
		);
		$this->load->view('client/contact.php', $data);
	}
	
	public function cart($step = 1, $error = 0)
	{
		$top_menu = $this->menus->top_menu;		
		$footer_menu = $this->menus->footer_menu;
		
		$slider = $this->slider->get_list(FALSE);
		$slider = $this->images->get_img_list($slider, 'slider', 'slider');
		
		$user_id = $this->session->userdata('user_id');
		$user = $this->users->get_item_by(array("id" => $user_id));
		
		$cart = $this->cart->get_all();
		$total_price = $this->cart->total_price();
		$total_qty = $this->cart->total_qty();
		
		$viewed_id = $this->session->userdata('viewed_id');
		if (isset($viewed_id))
		{
			$viewed = $this->products->get_item_by(array("id" => $viewed_id));
			$viewed->img = $this->images->get_images(array("object_type" => "products", "object_id" => $viewed->id), 1);
		}
	
		$data = array(
			'title' => "Cart",
			'meta_title' => "",
			'meta_keywords' => "",
			'meta_description' => "",
			'error' => '',
			'cart' => $cart,
			'viewed' => $viewed,
			'total_price' => $total_price,
			'total_qty' => $total_qty,
			'selects' => array(
				'method_delivery' => $this->config->item('method_delivery'),
				'method_pay' => $this->config->item('method_pay')
			),
			'top_menu' => $top_menu,
			'footer_menu' => $footer_menu,
			'slider' => $slider,
			'tree' => $this->categories->get_tree(0, "parent_id"),
			'user' => $user
		);
		
		if ($error == 1)
		{
			$data['error'] = "Данные не верны. Повторите ввод.";
			$this->load->view('client/cart_registration.php', $data);
		}
		else
		{
			switch($step){
				case 1:		
				if (isset($cart))
				{
					foreach($cart as $item_id => $item)
					{
						$product = $this->products->get_item_by(array("id" => $item['id']));
						$cart[$item_id]['img'] = $this->images->get_images(array("object_id" => $item['id'], "object_type" => "products"), "1");
						$cart[$item_id]['img']->url = $this->images->get_url($cart[$item_id]['img']->url, 'catalog_small');
					}
					$data['cart'] = $cart;
				}
				$this->load->view('client/cart.php', $data);
				break;
				case 2:
				$this->load->view('client/cart_registration.php', $data);
				case 3:
				$this->load->view('client/cart_address.php', $data);
				case 4:
				$this->load->view('client/cart_payment.php', $data);
			}
		}
		
	}
}

/* End of file pages.php */
/* Location: ./application/controllers/news.php */