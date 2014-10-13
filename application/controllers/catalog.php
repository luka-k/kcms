<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Catalog extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$order = $this->input->get('order');
		
		$direction = $this->input->get('direction');
		
		$this->breadcrumbs->Add("catalog", "Каталог");
		
		$top_menu = $this->menus->top_menu;
		$top_menu = $this->menus->set_active($top_menu, 'shop');
		$left_menu = $this->categories->get_tree(0, "parent_id");
		
		$cart = $this->cart->get_all();
		$total_price = $this->cart->total_price();
		$total_qty = $this->cart->total_qty();
		
		$user_id = $this->session->userdata('user_id');
		$user = $this->users->get_item_by(array("id" => $user_id));
		
		$manufacturer = $this->manufacturer->get_list(FALSE);
		
		$post = $this->input->post();
				
		if($post)
		{
			if(isset($post['cetegories_checked']))
			{
				foreach($post['cetegories_checked'] as $key => $item)
				{
					$categories_ch[] = $this->categories->get_item_by(array("id" => $item));
					$categories_checked[$key] = $item;	
					
				}
				$this->db->where_in('parent_id', $categories_checked);
			}
			else
			{
				$categories_checked = "";
				$categories_ch = "";
			}
			
			//var_dump($categories_ch);
			
			if(isset($post['manufacturer_checked']))
			{
				foreach($post['manufacturer_checked'] as $item)
				{
					$manufacturer_checked[] = $item;	
				}
				$this->db->where_in('manufacturer_id', $manufacturer_checked);
			}
			else
			{
				$manufacturer_checked = "";
			}
			
			$query = $this->db->get('products');
			$result = $query->result_array();
			if(empty($result))
			{
				$content = "";
			}
			else
			{
				foreach($result as $key => $item)
				{
					$content[$key] = (object)$item;
				}
			}
			$template = "client/categories.php";
		}
		else
		{
			$categories_checked = "";
			$manufacturer_checked = "";
			
			$category = $this->url_model->url_parse(2);
			//var_dump($category);
		
			if ($category == FALSE)
			{
				$content = $this->products->get_list(FALSE, $from = FALSE, $limit = FALSE, $order, $direction);
				
				
				$template = "client/categories.php";
			}
			else
			{
				if(isset($category->product))
				{
					$content = $category->product;
					$content->img = $this->images->get_images(array("object_type" => "products", "object_id" => $content->id));
					if(!empty($content->discount))
					{
						$content->sale_price = $content->price*(100 - $content->discount)/100;
					}
					$template = "client/product.php";
				}
				else
				{
					$content = $this->products->get_list(array("parent_id" => $category->id), $from = FALSE, $limit = FALSE, $order, $direction);
					//вынети в хэлпер
					$template = "client/categories.php";
				}
			}
	
		}
				
		if(!isset($category->product))
		{
			$content = $this->images->get_img_list($content, 'products', 'catalog_mid');
			$content = $this->products->get_urls($content);
			foreach($content as $key => $item)
			{
				if(!empty($item->discount))
				{
					$content[$key]->sale_price = $item->price*(100 - $item->discount)/100;
				}
			}
		}
		$data = array(
			//'title' => $settings->site_title,
			//'meta_title' => $settings->site_title,
			//'meta_keywords' => $settings->site_keywords,
			//'meta_description' => $settings->site_description,
			//'tree' => $this->categories->get_tree(0, "parent_id"),
			'content' => $content,
			'manufacturer' => $manufacturer,
			'breadcrumbs' => $this->breadcrumbs->get(),
			'cart' => $cart,
			'total_price' => $total_price,
			'total_qty' => $total_qty,
			'top_menu' => $top_menu,
			'left_menu' => $left_menu,
			'categories_checked' => $categories_checked,
			'manufacturer_checked' => $manufacturer_checked,
			'categories_ch' => $categories_ch,
			'user' => $user
		);
		
		$this->load->view($template, $data);
		

		/*if ($category == FALSE)
		{
			//$content = $this->categories->get_list(FALSE, $from = FALSE, $limit = FALSE, $order, $direction);
			$left_menu = $this->categories->get_tree(0, "parent_id");
			//var_dump($left_menu);
			//$settings = $this->settings->get_item_by(array('id' => 1));
			$data = array(
				//'title' => $settings->site_title,
				//'meta_title' => $settings->site_title,
				//'meta_keywords' => $settings->site_keywords,
				//'meta_description' => $settings->site_description,
				//'tree' => $this->categories->get_tree(0, "parent_id"),
				//'content' => $content,
				'breadcrumbs' => $this->breadcrumbs->get(),
				'cart' => $cart,
				'total_price' => $total_price,
				'total_qty' => $total_qty,
				'top_menu' => $top_menu,
				'left_menu' => $left_menu,
				'url' => $url,
				'user' => $user
			);
			//$data['content'] = $this->images->get_img_list($data['content'], 'categories', 'catalog_mid');
			//$content = $this->categories->get_urls($data['content']);
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
				//$content = $this->categories->get_list(array("parent_id" => $category->id), $from = FALSE, $limit = FALSE, $order, $direction);
				if($content == NULL)
				{
					//$content = $this->products->get_list(array("parent_id" => $category->id), $from = FALSE, $limit = FALSE, $order, $direction);
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
		}*/
	}
}

/* End of file catalog.php */
/* Location: ./application/controllers/catalog.php */