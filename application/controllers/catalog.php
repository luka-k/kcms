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
			'cart_items' => $this->cart_items,
			'total_price' => $this->total_price,
			'total_qty' => $this->total_qty,
			'product_word' => end_maker("товар", $this->total_qty),
			'top_menu' => $this->menus->set_active($this->top_menu, 'catalog'),
			'url' => $url,
			'filters' => $filters,
			'user' => $this->users->get_item_by(array("id" => $this->user_id))
		);
		
		
	
		if(isset($get['filter']))
		{
			$content = $this->products->get_filtred((object)$get, $order, $direction);
			$content = $this->products->get_prepared_list($content);
			
			$settings = $this->settings->get_item_by(array('id' => 1));

			$data['title'] = $settings->site_title;
			$data['meta_title'] = $settings->site_title;
			$data['meta_keywords'] = $settings->site_keywords;
			$data['meta_description'] = $settings->site_description;
			$data['breadcrumbs'] = $this->breadcrumbs->get();
			$data['content'] = $content;
			$template = "client/products.php";
		}
		else
		{
			$category = $this->categories->url_parse(2);

			if ($category == FALSE)
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
			'meta_title' => $settings->site_title,
			'meta_keywords' => $settings->site_keywords,
			'meta_description' => $settings->site_description,
			'breadcrumbs' => $this->breadcrumbs->get(),
			'cart_items' => $this->cart_items,
			'total_price' => $this->total_price,
			'total_qty' => $this->total_qty,
			'selects' => array(
				'delivery_id' => $this->config->item('method_delivery'),
				'payment_id' => $this->config->item('method_pay')
			),
			'product_word' => end_maker("товар", $this->cart->total_qty()),
			'top_menu' => $this->menus->set_active($this->top_menu, 'cart'),
			'user' => $this->users->get_item_by(array("id" => $this->user_id))
		);
		$this->load->view('client/cart.php', $data);
	}
}

/* End of file catalog.php */
/* Location: ./application/controllers/catalog.php */