<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends Client_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->config->load('pagination_config');
	}
	
	public function index()
	{
		$order = $this->input->get('order');
		$direction = $this->input->get('direction');
		
		$name = $this->input->get('q');
		
		$p_name = explode ( " - " , $name, 2);
		
		$product = $this->products->get_item_by(array("name" => $p_name[1]));
		
		if(!empty($product))
		{
			$product = $this->products->prepare($product);
			redirect($product->full_url);
		}
		else
		{
			$settings = $this->settings->get_item_by(array('id' => 1));
			
			$this->breadcrumbs->add("catalog", "Каталог");
			$this->breadcrumbs->add("", "Поиск");
			
			$pagin = $this->input->get('pagination');
			$total_rows = "";
		
			if($pagin)
			{
				$per_page = $this->input->get('per_page');
				if($per_page == "") $per_page = 0;
				$from = $per_page;
			}
			else
			{
				$from = 0;
			}
						
			$limit = $settings->pagination_page;
		
			
			$this->db->like('name', $name);
			$total_rows = $this->db->count_all('products');

			$this->db->like('name', $name);
			$query = $this->db->get('products', $limit, $from);
		
			$products = array();
			$pnames = array();
			foreach ($query->result() as $row)
			{
				//if (!$pnames[$row->name])
					$products[] = $row;
				//$pnames[$row->name] = 1;
			}	
			
			$main_category = $this->categories->get_item_by(array('url' => $this->uri->segment(2)));
			
			$query_string = $_SERVER['QUERY_STRING'];

			$pagination_config = $this->config->item('pagination');
			$pagination_config['per_page'] = $settings->pagination_page;
			$pagination_config['total_rows'] = $total_rows;
			$pagination_config['base_url'] = base_url().uri_string()."/?q=".$name."&pagination=true";
			$this->pagination->initialize($pagination_config);				
			$pagination = $this->pagination->create_links();
			//var_dump($pagination);
			$data = array(
				'title' => $settings->site_title,
				'meta_title' => $settings->site_title,
				'meta_keywords' => $settings->site_keywords,
				'meta_description' => $settings->site_description,
				'main_category' => $main_category,
				'breadcrumbs' => $this->breadcrumbs->get(),
				'pagination' => $pagination,
				'tree' => $this->categories->get_site_tree(0, "parent_id"),
				'cart_items' => $this->cart_items,
				'total_price' => $this->total_price,
				'total_qty' => $this->total_qty,
				'product_word' => end_maker("товар", $this->total_qty),
				'top_menu' => $this->top_menu->items,
				'user' => $this->users->get_item_by(array("id" => $this->user_id)),
				'products' => $this->products->get_prepared_list($products)
			);
			$this->load->view("client/search", $data);
		}
	}
}