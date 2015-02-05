<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Works extends Client_Controller {

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
		
		$this->breadcrumbs->add("works", "Наши работы");
		
		$data = array(
			'tree' => $this->categories->get_site_tree(0, "parent_id"),
			'url' => $this->uri->segment_array()
		);

		$data = array_merge($this->standart_data, $data);
		
		$category = $this->url->categories_url_parse(2);
		
		if ($category == "root")
		{
			$content = $this->categories->get_list(array("parent_id" => 0), $from = FALSE, $limit = FALSE, $order, $direction);
			$content = $this->categories->get_prepared_list($content);
			
			$settings = $this->settings->get_item_by(array('id' => 1));

			$data['title'] = "Наши работы";
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
			}
			else
			{
				$content = $this->categories->get_list(array("parent_id" => $category->id), $from = FALSE, $limit = FALSE, $order, $direction);

				if(empty($content))
				{
					// Костылек. Вроде просил жестко не ограничивать но пока так
					// обсудим еще раз структуру доделаю.
					if($category->parent_id == 1)
					{
						$content = $this->products->get_list(array("parent_id" => $category->id), $from = FALSE, $limit = FALSE, $order, $direction);
						$content = $this->products->get_prepared_list($content);
						$template = "client/products.php";
					}
					else
					{
						$template = "client/categories.php";
					}
				
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
			$data['breadcrumbs'] = $this->breadcrumbs->get();
				
		}
		$this->load->view($template, $data);
	}
}