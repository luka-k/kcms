<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//Вывод страниц разделов
class Pages extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		
		$this->config->load('order_config');
	}
	
	public function index($url_part, $pagin = FALSE)
	{		
		$menu = $this->menus->top_menu;
		$menu = $this->menus->set_active($menu, $url_part);
		
		$slider = $this->slider->get_list(FALSE);
		$slider = $this->images->get_img_list($slider, 'slider', 'slider');
		
		$news_info = $this->parts->get_item_by(array('url' => $url_part));
			
		$breadcrumbs = array(
			'Главная' => base_url(),
			$news_info->title => ""
		);
			
		$config['base_url'] = base_url()."pages/".$url_part;
		$config['total_rows'] = count($this->$url_part->get_list(array('is_active' => '1')));
		$config['per_page'] = 3;
		$this->pagination->initialize($config);	
		$pagination = $this->pagination->create_links();
		
		if ($pagin == null)
		{
			$pagin = 1;
		}
		
		$from = $config['total_rows']-$config['per_page']*$pagin;
		if ($from < 0)
		{
			$from = 0;
		}

		$items = $this->$url_part->get_list(array('is_active' => '1'), $from, $config['per_page']);			
		
		$data = array(
			'title' => $news_info->title,
			'meta_title' => $news_info->meta_title,
			'meta_keywords' => $news_info->meta_keywords,
			'meta_description' => $news_info->meta_description,
			'tree' => $this->categories->get_sub_tree(0, "parent_id"),
			'content' => array_reverse($items),
			'breadcrumbs' => $breadcrumbs,
			'pagination' => $pagination,
			'menu' => $menu,
			'slider' => $slider
		);
		$this->load->view('client/'.$url_part.'.php', $data);		
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
	
		$data = array(
			'title' => "Cart",
			'meta_title' => "",
			'meta_keywords' => "",
			'meta_description' => "",
			'error' => '',
			'cart' => $cart,
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