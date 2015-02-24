<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Catalog extends Client_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$this->load->helper('url_helper');
			
		//!isset($get['order']) ? $order = "name" : $order = $get['order'];		
		//!isset($get['direction']) ? $direction = "acs" : $direction = $get['direction'];
		$order = "sort";
		$direction = "acs";
		
		$this->breadcrumbs->add("works", "Каталог");
		
		$data = array(
			'tree' => $this->categories->get_site_tree(36, "parent_id"),
			'url' => $this->uri->segment_array()
		);

		$data = array_merge($this->standart_data, $data);
		
		$category = $this->url->categories_url_parse(2);

		if ($category == "root")
		{
			
			$content = $this->categories->get_list(array("parent_id" => 36), $from = FALSE, $limit = FALSE, $order, $direction);
			redirect(base_url().'catalog/'.$content[0]->url);
			
			$settings = $this->settings->get_item_by(array('id' => 1));

			$data['title'] = "Каталог";
			$data['description'] = $settings->description;
			$data['meta_title'] = $settings->site_title;
			$data['meta_keywords'] = $settings->site_keywords;
			$data['meta_description'] = $settings->site_description;
			$data['breadcrumbs'] = $this->breadcrumbs->get();
			$data['content'] = $content;
			
			$template = 'client/products.php';		
		}
		else
		{
			if(isset($category->product))
			{
				$content = $this->products->prepare_product($category->product);
				$template = "client/product.php";
			}
			else
			{
				if(in_array("obekty", $data['url']))
				{
					$content = $this->products->get_list(array("parent_id" => $category->id), $from = FALSE, $limit = FALSE, $order, $direction);
					
					if(empty($content))
					{
						$content = $this->categories->get_list(array("parent_id" => $category->id), $from = FALSE, $limit = FALSE, $order, $direction);
						$content = $this->categories->get_prepared_list($content);

						$template = "client/categories.php";
					}
					else
					{
						$content = $this->products->get_prepared_list($content);
						$template = "client/products.php";
					}
				}
				elseif(in_array("catalog", $data['url']))
				{
					$content = $this->categories->get_sub_products($category->id);
					$content = $this->products->get_prepared_list($content);
					$template = "client/products.php";	
				}
				else
				{
					$this->db->select('child_id');
					$img_ids = $this->images2categories->get_list(array("category_parent_id" => $category->id));
					
					$sub_category = $this->categories->get_list(array("parent_id" => $category->id), $from = FALSE, $limit = FALSE, $order, $direction);
					if($sub_category) foreach($sub_category as $s_c)
					{
						$this->db->select('child_id');
						$img_ids = array_merge($img_ids, $this->images2categories->get_list(array("category_parent_id" => $s_c->id)));
					}
					
					$content = array();
					
					foreach($img_ids as $i)
					{
						$content[] = $this->images->_get_urls($this->images->get_item_by(array("id" => $i->child_id)));
					}
					
					$template = "client/gallery_categories.php";
				}
			}	

			

			$data['title'] = $category->name;
			$data['meta_title'] = $category->meta_title;
			$data['meta_keywords'] = $category->meta_keywords;
			$data['meta_description'] = $category->meta_description;
			$data['category_id'] = $category->id;
			$data['content'] = $content;
			$data['breadcrumbs'] = $this->breadcrumbs->get();
				
		}
		$this->load->view($template, $data);
	}
}