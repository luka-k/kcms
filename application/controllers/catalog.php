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
		
		$works_id = $this->config->item('works_id');
		$catalog_id = $this->config->item('catalog_id');
		$works_url = $this->config->item('works_url');
		$catalog_url = $this->config->item('catalog_url');
		
		$this->breadcrumbs->add($catalog_url, "Каталог");
		
		$data = array(
			'tree' => $this->categories->get_site_tree($catalog_id, "parent_id"),
			'url' => $this->uri->segment_array()
		);

		$data = array_merge($this->standart_data, $data);
		
		$category = $this->url->categories_url_parse(2);
		if ($category == "root")
		{
			$content = $this->categories->get_list(array("parent_id" => $catalog_id, 'is_active' => true), $from = FALSE, $limit = FALSE, $order, $direction);
			//redirect(base_url().$catalog_url.'/'.$content[0]->url);

			$content = $this->categories->get_prepared_list($content);
			
			$settings = $this->settings->get_item_by(array('id' => 1));

			$data['title'] = "Каталог";
			$data['description'] = $settings->description;
			$data['meta_title'] = $settings->site_title;
			$data['meta_keywords'] = $settings->site_keywords;
			$data['meta_description'] = $settings->site_description;
			$data['breadcrumbs'] = $this->breadcrumbs->get();
			$data['content'] = $content;
			
			$template = 'client/categories.php';		
		}
		else
		{
			if(isset($category->product))
			{
				$content = $this->products->prepare_product($category->product);
				$template = "client/product.php";
				if ($data['url'][1] == 'catalog')
				{
					$data['hide_1st_image'] = true;
					$data['is_catalog'] = true;
					if($this->uri->segments[5] == 'preview')
					{
						unset($category->product);
					}
					//if ($this->uri->segment())
				}
			}
			if(!isset($category->product))
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
				elseif($catalog_url == 'catalog')
				{
					if (count( $data['url'] ) == 2)
					{
						
						$parent_category = $this->categories->get_item_by(array('url' => $data['url'][2], 'parent_id' => 36));
						$content = $this->categories->get_list(array('parent_id' => $parent_category->id), 0, 0, 'sort', 'asc');
						$content = $this->categories->get_prepared_list($content);
						
						$products = array();
						foreach ($content as $_category)
						{
							$category_products = $this->products->get_list(array('parent_id' => $_category->id));
							$category_products = $this->products->get_prepared_list($category_products);
							$products = array_merge($products, $category_products);
						}
						$data['products'] = $products;
						
					//print_r($category);
						$template = "client/categories-catalog.php";	
					} else {
						$content = $this->categories->get_sub_products($category->id);
						
						if($this->uri->segments[5] == 'preview')
						{
							$content = $this->products->get_list(array('url' => $this->uri->segments[4]));
							$category = $content[0];
						}
						$content = $this->products->get_prepared_list($content);
						
						
						if(count($content) <= 1)
						{
							$template = "client/products-catalog-1.php";	
						}
						elseif(count($content) <= 4)
						{
							$template = "client/products-catalog-2.php";	
						}
						else
						{
							$template = "client/products-catalog.php";	
						}
					}
				} elseif(in_array($catalog_url, $data['url']))
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
						$img = $this->images->_get_urls($this->images->get_item_by(array("id" => $i->child_id)));
						if ($img)
							$content[] = $img;
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