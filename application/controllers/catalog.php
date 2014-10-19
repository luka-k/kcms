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
		
		$filter = $this->input->get('filter');
		
		$this->breadcrumbs->Add("catalog", "Каталог");
		
		$top_menu = $this->menus->top_menu;
		$top_menu = $this->menus->set_active($top_menu, 'shop');
		$left_menu = $this->categories->get_tree(0, "category_parent_id");
		
		$cart = $this->cart->get_all();
		$total_price = $this->cart->total_price();
		$total_qty = $this->cart->total_qty();
		
		$manufacturer = $this->manufacturer->get_list(FALSE);
		
		$this->load->library('pagination');
		
		$settings = $this->settings->get_item_by(array("id" => 1));
		
		$pagin = $this->input->get('pagination');
		
		if($pagin)
		{
			$per_page = $this->input->get('per_page');
			if($per_page == "") $per_page = 0;
			$from = $per_page;
			$limit = $settings->pagination_page;
		}
		else
		{
			$from = 0;
			$limit = $settings->pagination_page;
		}

		$session = array(
			'categories_checked' => $this->session->userdata('categories_checked'),
			'manufacturer_checked' => $this->session->userdata('manufacturer_checked')
		);
		
		if(!empty($session['categories_checked']))
		{
			foreach($session['categories_checked'] as $key => $item)
			{
				$categories_ch[] = $this->categories->get_item_by(array("id" => $item));
				$categories_checked[$key] = $item;		
			}
		}
		else
		{
			$categories_checked = "";
			$categories_ch = "";
		}

		if(!empty($session['manufacturer_checked']))
		{
			foreach($session['manufacturer_checked'] as $item)
			{
				$manufacturer_checked[] = $item;	
			}
		}
		else
		{
			$manufacturer_checked = "";
		}	
		
		$category = $this->url_model->url_parse(2);
		
		if($filter)
		{
			if(!empty($session['categories_checked'])) $this->db->where_in('parent_id', $categories_checked);
			if(!empty($session['manufacturer_checked'])) $this->db->where_in('manufacturer_id', $manufacturer_checked);
			$query_1 = $this->db->get('products');
			$config['total_rows'] = count($query_1->result_array());
			$query = $this->db->get('products', $limit, $from);
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
				if ($category == FALSE)
				{
					$content = $this->products->get_list(FALSE, $from, $limit, $order, $direction);
					$config['total_rows'] = count($this->products->get_list(FALSE, $from = FALSE, $limit = FALSE, $order, $direction));
				}
				else
				{
					$content = $this->products->get_list(array("parent_id" => $category->id), $from, $limit, $order, $direction);		
					$config['total_rows'] = count($this->products->get_list(array("parent_id" => $category->id), $from = FALSE, $limit = FALSE, $order, $direction));
				}
				$template = "client/categories.php";
				
			}
				$buy = $this->session->userdata('buy');
				if($buy)
				{
					$this->session->unset_userdata('buy');
				}
				else
				{
					$this->session->unset_userdata('categories_checked');
					$this->session->unset_userdata('manufacturer_checked');					
					$categories_checked = "";
					$categories_ch = "";
					$manufacturer_checked = "";
				}
		}
				
		if(!isset($category->product)&&(!empty($content)))
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

		if($filter)
		{
			$config['base_url'] = base_url().uri_string()."?filter=true&pagination=true";
		}
		else
		{
			$config['base_url'] = base_url().uri_string()."?pagination=true";
		}
		$config['page_query_string'] = TRUE;
		$config['per_page'] = 2;

		$this->pagination->initialize($config);

		$pagination = $this->pagination->create_links();
		
		$data = array(
			//'title' => $settings->site_title,
			//'meta_title' => $settings->site_title,
			//'meta_keywords' => $settings->site_keywords,
			//'meta_description' => $settings->site_description,
			'content' => $content,
			'manufacturer' => $manufacturer,
			'breadcrumbs' => $this->breadcrumbs->get(),
			'cart' => $cart,
			'total_price' => $total_price,
			'total_qty' => $total_qty,
			'product_word' => end_maker("товар", $total_qty),
			'top_menu' => $top_menu,
			'left_menu' => $left_menu,
			'categories_checked' => $categories_checked,
			'manufacturer_checked' => $manufacturer_checked,
			'categories_ch' => $categories_ch,
			'pagination' => $pagination
		);
		
		
		$this->load->view($template, $data);

	}
}

/* End of file catalog.php */
/* Location: ./application/controllers/catalog.php */