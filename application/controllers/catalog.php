<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Catalog extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$this->breadcrumbs->Add("catalog", "Каталог");
		$menu = $this->menus->top_menu;
		$menu = $this->menus->set_active($menu, 'catalog');
		$cart = $this->cart->cart_contents();
		$total_price = $this->cart->total_price();
		$total_qty = $this->cart->total_qty();
		$category = $this->url_model->url_parse(2);
		if ($category == FALSE)
		{
			$content = $this->categories->get_list(array("parent_id" => 0));
			$settings = $this->settings->get_item_by(array('id' => 1));
			$data = array(
				'title' => $settings->site_title,
				'meta_title' => $settings->site_title,
				'meta_keywords' => $settings->site_keywords,
				'meta_description' => $settings->site_description,
				'tree' => $this->categories->get_sub_tree(0, "parent_id"),
				'content' => $content,
				'breadcrumbs' => $this->breadcrumbs->get(),
				'cart' => $cart,
				'total_price' => $total_price,
				'total_qty' => $total_qty,
				'menu' => $menu
			);
			$data['content'] = $this->images->get_img_list($data['content'], 'categories');
			$data['content'] = $this->url_model->get_full_url($data['content']);
			
			$this->load->view('client/categories.php', $data);	
		}
		else
		{
			if(isset($category->product))
			{
				$content = $this->products->get_item_by(array("url" => $category->product->url));
				$data = array(
					'title' => $content->title,
					'meta_title' => $content->meta_title,
					'meta_keywords' => $content->meta_keywords,
					'meta_description' => $content->meta_description,
					'tree' => $this->categories->get_sub_tree(0, "parent_id"),
					'content' => $content,
					'breadcrumbs' => $this->breadcrumbs->get(),
					'cart' => $cart,
					'total_price' => $total_price,
					'total_qty' => $total_qty,
					'menu' => $menu
				);				
				$data['content']->img = $this->images->get_images(array("object_type" => "products", "object_id" => $data['content']->id));
				$template = "client/page.php";
			}
			else
			{
				$content = $this->categories->get_list(array("parent_id" => $category->id));
				if($content == NULL)
				{
					$content = $this->products->get_list(array("parent_id" => $category->id));
					$content = $this->images->get_img_list($content, 'products');	
					$content = $this->url_model->get_full_url($content);
					$template = "client/pages.php";
				}
				else
				{
					$content = $this->images->get_img_list($content, 'categories');	
					$content = $this->url_model->get_full_url($content);
					$template = "client/categories.php";
				}
				$data = array(
					'title' => $category->title,
					'meta_title' => $category->meta_title,
					'meta_keywords' => $category->meta_keywords,
					'meta_description' => $category->meta_description,
					'tree' => $this->categories->get_sub_tree(0, "parent_id"),
					'content' => $content,
					'breadcrumbs' => $this->breadcrumbs->get(),
					'cart' => $cart,
					'total_price' => $total_price,
					'total_qty' => $total_qty,
					'menu' => $menu
				);			
			}			
			$this->load->view($template, $data);
		}
	
	}
}

/* End of file catalog.php */
/* Location: ./application/controllers/catalog.php */