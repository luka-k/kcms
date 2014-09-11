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
			'menu' => $menu
		);
		$this->load->view('client/'.$url_part.'.php', $data);		
	}
	
	public function cart()
	{
		$menu = $this->menus->top_menu;		
		$cart = $this->cart->get_all();
		$total_price = $this->cart->total_price();
		$total_qty = $this->cart->total_qty();
	
		$data = array(
			'title' => "Корзина",
			'meta_title' => "",
			'meta_keywords' => "",
			'meta_description' => "",
			'cart' => $cart,
			'total_price' => $total_price,
			'total_qty' => $total_qty,
			'selects' => array(
				'method_delivery' => $this->config->item('method_delivery'),
				'method_pay' => $this->config->item('method_pay')
			),
			'menu' => $menu
		);
		$this->load->view('client/cart.php', $data);
	}
}

/* End of file pages.php */
/* Location: ./application/controllers/news.php */