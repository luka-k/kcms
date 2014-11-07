<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Catalog extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$url = base_url().uri_string();

		$order = $this->input->get('order');
		
		$direction = $this->input->get('direction');
		
		$this->breadcrumbs->Add("catalog", "Каталог");
		
		$top_menu = $this->menus->top_menu;
		
		$user_id = $this->session->userdata('user_id');
		
		$data = array(
			'tree' => $this->categories->get_site_tree(0, "parent_id"),
			'breadcrumbs' => $this->breadcrumbs->get(),
			'cart' => $this->cart->get_all(),
			'total_price' => $this->cart->total_price(),
			'total_qty' => $this->cart->total_qty(),
			'product_word' => end_maker("товар", $this->cart->total_qty()),
			'top_menu' => $this->menus->set_active($top_menu, 'catalog'),
			'url' => $url,
			'user' => $this->users->get_item_by(array("id" => $user_id))
		);

		$category = $this->url_model->url_parse(2);

		if ($category == FALSE)
		{
			$content = $this->categories->get_list(array("parent_id" => 0), $from = FALSE, $limit = FALSE, $order, $direction);
			$content = $this->categories->get_prepared_list($content);
			
			$settings = $this->settings->get_item_by(array('id' => 1));

			$data['title'] = $settings->site_title;
			$data['meta_title'] = $settings->site_title;
			$data['meta_keywords'] = $settings->site_keywords;
			$data['meta_description'] = $settings->site_description;
			$data['content'] = $content;
			
			$this->load->view('client/categories.php', $data);			
		}
		else
		{
			if(isset($category->product))
			{
				$content = $this->products->get_item_by(array("url" => $category->product->url));
				$content = $this->products->prepare($content);
				
				$template = "client/page.php";
			}
			else
			{
				$content = $this->categories->get_list(array("parent_id" => $category->id), $from = FALSE, $limit = FALSE, $order, $direction);
				if($content == NULL)
				{
					$content = $this->products->get_list(array("parent_id" => $category->id), $from = FALSE, $limit = FALSE, $order, $direction);
					$content = $this->products->get_prepared_list($content);
										
					$template = "client/pages.php";
				}
				else
				{
					$content = $this->categories->get_prepared_list($content);
					
					$template = "client/categories.php";
				}		
			}		

			$data['title'] = $category->name;
			$data['meta_title'] = $category->meta_title;
			$data['meta_keywords'] = $category->meta_keywords;
			$data['meta_description'] = $category->meta_description;
			$data['content'] = $content;
			
			$this->load->view($template, $data);
		}
	}
	
	public function cart()
	{
		$this->breadcrumbs->Add("catalog", "Корзина");
		
		$top_menu = $this->menus->top_menu;
		
		$user_id = $this->session->userdata('user_id');
		
		$settings = $this->settings->get_item_by(array("id" => 1));
		
		$this->config->load('order_config');

		$data = array(
			'title' => "Корзина",
			'meta_title' => $settings->site_title,
			'meta_keywords' => $settings->site_keywords,
			'meta_description' => $settings->site_description,
			'breadcrumbs' => $this->breadcrumbs->get(),
			'cart' => $this->cart->get_all(),
			'total_price' => $this->cart->total_price(),
			'total_qty' => $this->cart->total_qty(),
			'selects' => array(
				'delivery_id' => $this->config->item('method_delivery'),
				'payment_id' => $this->config->item('method_pay')
			),
			'product_word' => end_maker("товар", $this->cart->total_qty()),
			'top_menu' => $this->menus->set_active($top_menu, 'cart'),
			'user' => $this->users->get_item_by(array("id" => $user_id))
		);
		$this->load->view('client/cart.php', $data);
	}
}

/* End of file catalog.php */
/* Location: ./application/controllers/catalog.php */