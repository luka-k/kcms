<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Catalog extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->config->load('pagination_config');
	}
	
	public function index()
	{
		$order = "name";	
		$direction = "asc";
		
		$filters = $this->input->get();
		//var_dump($filters);
		
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
		$total_rows = "";
		
		$url = current_url();
		//var_dump($url);
		
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
		
		if(!empty($filters['categories_checked']))
		{
			foreach($filters['categories_checked'] as $key => $item)
			{
				
				$categories_ch[] = $this->categories->get_item_by(array("id" => $item));		
			}
		}
		else
		{
			$categories_ch = "";
		}
		
		if(!empty($filters['manufacturer_checked']))
		{
			foreach($filters['manufacturer_checked'] as $key => $item)
			{
				
				$manufacturer_ch[] = $this->manufacturer->get_item_by(array("id" => $item));		
			}
		}
		else
		{
			$manufacturer_ch = "";
		}
		
		
		$category = $this->url_model->url_parse(2);

		if($filters['filter'])
		{
			
			$this->products->set_filters($filters);
			$total_rows = $this->db->count_all_results('products');

			$filters = $this->products->set_filters($filters);
			$this->db->order_by($order, $direction);
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
			$filters = array(
				'parent_checked' => "",
				'categories_checked' => "",
				'manufacturer_checked' => "",
				'attributes_range' => array(
					'width' => (object)array(
						'from' => "",
						'to' => ""
					),
					'height' => (object)array(
						'from' => "",
						'to' => ""
					),
					'depth' => (object)array(
						'from' => "",
						'to' => ""
					)
				),
				'attributes' => array(
					"color" => "",
					"material" => "",
					"finishing" => "",
					"turn" => ""
				)
			);
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
					$total_rows = count($this->products->get_list(FALSE, $from = FALSE, $limit = FALSE, $order, $direction));
				}
				else
				{
					if(count($this->uri->segment_array()) == 2)
					{
						$query = $this->db->get_where("category2category", array("category_parent_id" => $category->id));
						$childs = $query->result();
						
						$childs_id = array();
						foreach($childs as $item)
						{
							$childs_id[] = $item->child_id;
						}
						
						$this->db->where_in("id", $childs_id);
						$this->db->order_by($order, $direction);
						$query = $this->db->get("products", $limit, $from);
						$content = $query->result();
						
						
						$this->db->where_in("id", $childs_id);
						$query = $this->db->get("products");
						$total_rows = $this->db->count_all_results('products');
						
					}
					else
					{
						$content = $this->products->get_list(array("parent_id" => $category->id), $from, $limit, $order, $direction);		
						$total_rows = count($this->products->get_list(array("parent_id" => $category->id), $from = FALSE, $limit = FALSE, $order, $direction));
					}
					
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
					$this->session->unset_userdata('filters');	
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
		
		$pagination_config = $this->config->item('pagination');
		$pagination_config['per_page'] = $settings->pagination_page;
		$pagination_config['total_rows'] = $total_rows;
		
		if(isset($filters['filter']))
		{
			$pagination_config['base_url'] = base_url().uri_string()."?filter=true&pagination=true";
		}
		else
		{
			$pagination_config['base_url'] = base_url().uri_string()."?pagination=true";
		}

		$this->pagination->initialize($pagination_config);
		$pagination = $this->pagination->create_links();
		
		$active_cart = $this->session->userdata('active_cart');
		
		$left_active = "filt-1";
		
		if(empty($filters['categories_checked'])) $filters['categories_checked'] = "";
		if(empty($filters['manufacturer_checked'])) $filters['manufacturer_checked'] = "";
		if(empty($filters['parent_checked'])) $filters['parent_checked'] = "";
		
		//var_dump($filters['categories_checked']);
		//var_dump($filters['manufacturer_checked']);
		//var_dump($manufacturer);
		
		$data = array(
			'content' => $content,
			'manufacturer' => $manufacturer,
			'breadcrumbs' => $this->breadcrumbs->get(),
			'cart' => $cart,
			'total_price' => $total_price,
			'total_qty' => $total_qty,
			'product_word' => end_maker("товар", $total_qty),
			'top_menu' => $top_menu,
			'left_menu' => $left_menu,
			'left_active' => $left_active,
			'categories_checked' => $filters['categories_checked'],
			'categories_ch' => $categories_ch,
			'manufacturer_ch' => $manufacturer_ch,
			'manufacturer_checked' => $filters['manufacturer_checked'],
			'filters' => $filters,
			'parent_checked' => $filters['parent_checked'],
			'pagination' => $pagination
		);
		
		$data['title'] = $settings->site_title;
		$data['meta_title'] = $settings->site_title;
		$data['meta_keywords'] = $settings->site_keywords;
		$data['meta_description'] = $settings->site_description;
		
		$this->load->view($template, $data);
	}
}

/* End of file catalog.php */
/* Location: ./application/controllers/catalog.php */