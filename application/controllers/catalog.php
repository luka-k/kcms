<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Catalog extends Client_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$url = base_url().uri_string();
		
		$this->load->helper('url_helper');
		
		//функция get_filter_string убирает из строки запроса get параметры order и direction
		//что бы в последствии правильно постройть ссылки на сортировку.
		//возможно это костыль
		$query_string = get_filter_string($_SERVER['QUERY_STRING']);
		$url = base_url().uri_string()."?".$query_string;
		$get = $this->input->get();

		!isset($get['order']) ? $order = "name" : $order = $get['order'];		
		!isset($get['direction']) ? $direction = "acs" : $direction = $get['direction'];
		
		$this->breadcrumbs->add("catalog", "Каталог");
		
		$this->config->load('characteristics_config');
		//Тут наверно в последстивии понадобиться  
		//придумать какуюнить умную функцию
		//что бы отбирать характеристики товаров
		//которые нужны в этой подкатегори
		//$filters = $this->characteristics->filters;
		$filters = $this->characteristics->get_filters();
		
		$data = array(
			'tree' => $this->categories->get_site_tree(0, "parent_id"),
			'url' => $url,
			'filters' => $filters
		);
		$data = array_merge($this->standart_data, $data);
		
	
		if(isset($get['filter']))
		{
			$content = $this->products->get_filtred((object)$get, $order, $direction);
			$content = $this->products->get_prepared_list($content);
			
			$settings = $this->settings->get_item_by(array('id' => 1));

			$data['title'] = $settings->site_title;
			$data['breadcrumbs'] = $this->breadcrumbs->get();
			$data['content'] = $content;
			$template = "client/products.php";
		}
		else
		{
			$category = $this->url->catalog_url_parse(2);
			
			if ($category == "root")
			{
				$content = $this->categories->get_list(array("parent_id" => 0), $from = FALSE, $limit = FALSE, $order, $direction);
				$content = $this->categories->get_prepared_list($content);
			
				$settings = $this->settings->get_item_by(array('id' => 1));

				$data['title'] = $settings->site_title;
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
					$content = $this->products->prepare($category->product);
					$template = "client/product.php";
				}
				else
				{
					$content = $this->categories->get_list(array("parent_id" => $category->id), $from = FALSE, $limit = FALSE, $order, $direction);
					if($content == NULL)
					{
						$content = $this->products->get_list(array("parent_id" => $category->id), $from = FALSE, $limit = FALSE, $order, $direction);
						$content = $this->products->get_prepared_list($content);			
						$template = "client/products.php";
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
		}
		$this->load->view($template, $data);
	}
	
	public function cart()
	{
		$this->breadcrumbs->Add("catalog", "Корзина");
		
		$settings = $this->settings->get_item_by(array("id" => 1));
		
		$this->config->load('order_config');

		$data = array(
			'title' => "Корзина",
			'breadcrumbs' => $this->breadcrumbs->get(),
			'selects' => array(
				'delivery_id' => $this->config->item('method_delivery'),
				'payment_id' => $this->config->item('method_pay')
			)
		);
		$data = array_merge($this->standart_data, $data);
		$this->load->view('client/cart.php', $data);
	}
}

/* End of file catalog.php */
/* Location: ./application/controllers/catalog.php */