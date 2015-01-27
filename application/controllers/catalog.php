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
		$link_url = base_url().uri_string()."?".$query_string;
		$get = $this->input->get();
		
		//!isset($get['order']) ? $order = "name" : $order = $get['order'];		
		//!isset($get['direction']) ? $direction = "acs" : $direction = $get['direction'];
		
		if(!isset($get['order']))
		{
			$order = "name";
			$direction = "acs";

			$order_price = array(
				"link" => $link_url."&order=price&direction=asc",
				"active" => FALSE,
				"icon" => FALSE
			);
			
			$order_name = array(
				"link" => $link_url."&order=name&direction=asc",
				"active" => FALSE,
				"icon" => FALSE
			);
			
		}
		else
		{
			$order = $get['order'];
			$direction = $get['direction'];
			
			if($order == "name")
			{
				$order_price = array(
					"link" => $link_url."&order=price&direction=asc",
					"active" => FALSE,
					"icon" => FALSE
				);
				if($direction == "asc")
				{				
					$order_name = array(
						"link" => $link_url."&order=name&direction=desc",
						"active" => TRUE,
						"icon" => "asc"
					);
				}
				else
				{
					$order_name = array(
						"link" => $link_url."&order=name&direction=asc",
						"active" => TRUE,
						"icon" => "desc"
					);
				}
			}
			elseif($order == "price")
			{
				$order_name = array(
					"link" => $link_url."&order=name&direction=asc",
					"active" => FALSE,
					"icon" => FALSE
				);
				
				if($direction == "asc")
				{				
					$order_price = array(
						"link" => $link_url."&order=price&direction=desc",
						"active" => TRUE,
						"icon" => "asc"
					);
				}
				else
				{
					$order_price = array(
						"link" => $link_url."&order=price&direction=asc",
						"active" => TRUE,
						"icon" => "desc"
					);
				}
			}
		}

		
		$this->breadcrumbs->add("catalog", "Каталог");
		
		$this->config->load('characteristics_config');
		
		$filters = $this->characteristics->get_filters();
		
		!empty($get['use']) ? $filters_checked['use'] = $get['use'] : $filters_checked['use'] = "";
		isset($get['is_active']) ? $filters_checked['is_active'] = $get['is_active'] : $filters_checked['is_active'] = "";

		$left_menu = $this->categories->get_site_tree(0, "parent_id");
		$new_products = $this->products->get_list(array("is_new" => 1), FALSE, 3);
		
		$settings = $this->settings->get_item_by(array("id" => 1));
		
		$this->db->select_max('price');
		$query = $this->db->get('products');
		$max_price = $query->row()->price;
		empty($get['price_to']) ? $max_value = $max_price : $max_value = $get['price_to'];

		$this->db->select_min('price');
		$query = $this->db->get('products');
		$min_price = $query->row()->price;

		empty($get['price_from']) ? $min_value = $min_price : $min_value = $get['price_from'];

		$data = array(
			'tree' => $this->categories->get_site_tree(0, "parent_id"),
			'left_menu' => $left_menu,
			'url' => $url,
			'select_item' => "",
			'order_price' => $order_price,
			'order_name' => $order_name,
			'filters' => $filters,
			'filters_checked' => $filters_checked,
			'min_price' => $min_price,
			'max_price' => $max_price,
			'min_value' => $min_value,
			'max_value' => $max_value,
			'settings' => $settings
		);
		
		$data = array_merge($this->standart_data, $data);
		
		if(isset($get['filter']))
		{
			$this->breadcrumbs->add("", "Поиск");
			$category = new stdClass();
			$category->name = "Результаты поиска";
			$category->products = $this->characteristics->get_filtered_products((object)$get, $order, $direction);
			$category->products = $this->products->get_prepared_list($category->products);

			$settings = $this->settings->get_item_by(array('id' => 1));

			$data['title'] = $settings->site_title;
			$data['meta_title'] = $settings->site_title;
			$data['meta_keywords'] = $settings->site_keywords;
			$data['meta_description'] = $settings->site_description;
			$data['breadcrumbs'] = $this->breadcrumbs->get();
			$data['content'] = $category;
			$template = "client/products.php";
		}
		else
		{
			$category = $this->categories->url_parse(2);
			
			if($category == "404")
			{
				$settings = $this->settings->get_item_by(array("id" => 1));
				$data['title'] = "Страница не найдена";
				$data['meta_title'] = $settings->site_title;
				$data['meta_keywords'] = $settings->site_keywords;
				$data['meta_description'] = $settings->site_description;
				$template="client/404.php";
			}
			else
			{
				if ($category == FALSE)
				{
					$good_buy = $this->products->get_list(array("is_good_buy" => 1), FALSE, 3, $order, $direction);
			
					$settings = $this->settings->get_item_by(array('id' => 1));

					$data['title'] = $settings->site_title;
					$data['meta_title'] = $settings->site_title;
					$data['meta_keywords'] = $settings->site_keywords;
					$data['meta_description'] = $settings->site_description;
					$data['breadcrumbs'] = $this->breadcrumbs->get();
					$data['good_buy'] = $this->products->get_prepared_list($good_buy);
					$data['new_products'] = $this->products->get_prepared_list($new_products);
					$template = 'client/products.php';		
				}
				else
				{
					if(isset($category->product))
					{
						$content = $this->products->prepare_product($category->product);
						$new_products = $this->products->get_list(array("is_new" => 1), FALSE, 4);
						$template = "client/product.php";
					}
					elseif(isset($category->products))
					{
						$category->products = $this->products->get_prepared_list($category->products);
						
						//Сортировка продуктов полученных функцией url_parse
						
						foreach ($category->products as $key => $row) 
						{
							if($order == "name")
							{
								$volume[$key]  = $row->name;
							}
							elseif($order == "price")
							{
								$volume[$key]  = $row->price;
							}
						}
						
						$direction == "asc" ? $sort = SORT_ASC : $sort = SORT_DESC;
						array_multisort($volume, $sort, $category->products);
						
						$content = $category;
						$template = "client/products.php";	
					}		

					$data['title'] = $category->name;
					$data['meta_title'] = $category->meta_title;
					$data['meta_keywords'] = $category->meta_keywords;
					$data['meta_description'] = $category->meta_description;
					$data['new_products'] = $this->products->get_prepared_list($new_products);
					$data['content'] = $content;
					$data['breadcrumbs'] = $this->breadcrumbs->get();
				}
			}
		}
		$this->load->view($template, $data);
	}
	
	public function cart()
	{
		$this->breadcrumbs->Add("catalog", "Корзина");
		
		$this->input->post('amount');
		
		$settings = $this->settings->get_item_by(array("id" => 1));
		
		$this->config->load('order_config');
		if($this->standart_data['cart_items'])	$this->standart_data['cart_items'] = $this->products->get_prepared_list($this->standart_data['cart_items']);

		$data = array(
			'title' => "Корзина",
			'breadcrumbs' => $this->breadcrumbs->get(),
			'select_item' => "",
			'action' => $this->input->get('action'),
			'settings' => $this->settings->get_item_by(array('id' => 1))
		);
		
		$data = array_merge($this->standart_data, $data);
		$this->load->view('client/cart.php', $data);
	}
}

/* End of file catalog.php */
/* Location: ./application/controllers/catalog.php */