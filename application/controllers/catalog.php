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
		$cart = $this->cart->get_all();
		$total_price = $this->cart->total_price();
		$total_qty = $this->cart->total_qty();
		$category = $this->url_model->url_parse(2);
		
		$user_id = $this->session->userdata('user_id');
		$user = $this->users->get_item_by(array("id" => $user_id));

		if ($category == FALSE)
		{
			$content = $this->categories->get_list(array("parent_id" => 0), $from = FALSE, $limit = FALSE, $order, $direction);
			$settings = $this->settings->get_item_by(array('id' => 1));
			$data = array(
				'title' => $settings->site_title,
				'meta_title' => $settings->site_title,
				'meta_keywords' => $settings->site_keywords,
				'meta_description' => $settings->site_description,
				'tree' => $this->categories->get_tree(0, "parent_id"),
				'content' => $content,
				'breadcrumbs' => $this->breadcrumbs->get(),
				'cart' => $cart,
				'total_price' => $total_price,
				'total_qty' => $total_qty,
				'menu' => $menu,
				'url' => $url,
				'user' => $user
			);
			$data['content'] = $this->images->get_img_list($data['content'], 'categories', 'catalog_mid');
			$content = $this->categories->get_urls($data['content']);
			$this->load->view('client/categories.php', $data);			
		}
		else
		{
			if(isset($category->product))
			{
				$content = $this->products->get_item_by(array("url" => $category->product->url));
				$content->img = $this->images->get_images(array("object_type" => "products", "object_id" => $content->id));
				$template = "client/page.php";
			}
			else
			{
				$content = $this->categories->get_list(array("parent_id" => $category->id), $from = FALSE, $limit = FALSE, $order, $direction);
				if($content == NULL)
				{
					$content = $this->products->get_list(array("parent_id" => $category->id), $from = FALSE, $limit = FALSE, $order, $direction);
					$content = $this->images->get_img_list($content, 'products', 'catalog_mid');	
					$content = $this->products->get_urls($content);
					$template = "client/pages.php";
				}
				else
				{
					$content = $this->images->get_img_list($content, 'categories', 'catalog_mid');
					$content = $this->categories->get_urls($content);
					$template = "client/categories.php";
				}		
			}		
				$data = array(
					'title' => $category->title,
					'meta_title' => $category->meta_title,
					'meta_keywords' => $category->meta_keywords,
					'meta_description' => $category->meta_description,
					'tree' => $this->categories->get_tree(0, "parent_id"),
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