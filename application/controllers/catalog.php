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
		
		$menu = $this->menus->top_menu;
		$menu = $this->menus->set_active($menu, 'catalog');
		
		$user_id = $this->session->userdata('user_id');
		$user = $this->users->get_item_by(array("id" => $user_id));
		
		$cart = $this->cart->get_all();
		$total_price = $this->cart->total_price();
		$total_qty = $this->cart->total_qty();
		
		$category = $this->url_model->url_parse(2);

		if ($category == FALSE)
		{
			$content = $this->categories->get_list(array("parent_id" => 0), $from = FALSE, $limit = FALSE, $order, $direction);
			$content = $this->categories->get_prepared_list($content);
			
			$settings = $this->settings->get_item_by(array('id' => 1));
			$data = array(
				'title' => $settings->site_title,
				'meta_title' => $settings->site_title,
				'meta_keywords' => $settings->site_keywords,
				'meta_description' => $settings->site_description,
				'tree' => $this->categories->get_site_tree(0, "parent_id"),
				'content' => $content,
				'breadcrumbs' => $this->breadcrumbs->get(),
				'cart' => $cart,
				'total_price' => $total_price,
				'total_qty' => $total_qty,
				'menu' => $menu,
				'url' => $url,
				'user' => $user
			);
			
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
				$data = array(
					'title' => $category->name,
					'meta_title' => $category->meta_title,
					'meta_keywords' => $category->meta_keywords,
					'meta_description' => $category->meta_description,
					'tree' => $this->categories->get_site_tree(0, "parent_id"),
					'content' => $content,
					'breadcrumbs' => $this->breadcrumbs->get(),
					'cart' => $cart,
					'total_price' => $total_price,
					'total_qty' => $total_qty,
					'menu' => $menu,
					'url' => $url,
					'user' => $user
				);		
			$this->load->view($template, $data);
		}
	}
}

/* End of file catalog.php */
/* Location: ./application/controllers/catalog.php */