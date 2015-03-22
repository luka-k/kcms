<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Catalog extends Client_Controller {

	protected $get = array();

	public function __construct()
	{
		parent::__construct();
		
		$this->config->load('characteristics_config');
		$filters = $this->characteristics_type->get_filters();
		
		$this->get = $this->input->get();

		if(!isset($this->get['order']))
		{
			$this->get['order'] = "sort";
			$this->get['direction'] = "asc";
		}
		
		if(!isset($this->get['filter'])) $this->get['filter'] = FALSE;  
		
		$data = array(
			'title' => "Каталог",
			'tree' => $this->categories->get_site_tree(0, "parent_id"),
			'filters' => $filters
		);
		$this->standart_data = array_merge($this->standart_data, $data);
	}
	
	public function index()
	{
		$filter = $this->get['filter'];
		$this->breadcrumbs->add("catalog", "Каталог");
		
		if($filter)
		{
			 $this->filtred();
		}
		else
		{		
			$content = $this->url->catalog_url_parse(2);
			if($content == FALSE) redirect(base_url()."pages/page_404", "location", 404); //работает через раз. разобраться!!!!!!
			
			isset($content->product) ? $this->product($content) : $this->category($content);
		}
	}
	
	private function category($content)
	{		
		if($content == "root")
		{
			$parent_id = 0;
			$data['category'] = new stdClass();
		}
		else
		{
			$parent_id = $content->id;

			$data = array(
				'title' => $content->name,
				'meta_keywords' => $content->meta_keywords,
				'meta_description' => $content->meta_description,
				'category' => $content
			);
		}
		$data = array_merge($this->standart_data, $data);
		
		$query_string = get_filter_string($_SERVER['QUERY_STRING']);
		
		$data['url'] = base_url().uri_string()."?".$query_string;
		$data['breadcrumbs'] = $this->breadcrumbs->get();
		$data['category']->sub_categories = $this->categories->prepare_list($this->categories->get_list(array("parent_id" => $parent_id)));
		$data['category']->products = $this->products->prepare_list($this->catalog->get_products($parent_id, $this->get['order'], $this->get['direction']));
				
		$this->load->view("client/categories", $data);
	}
	
	public function filtred()
	{		
		$products = $this->characteristics->get_products_by_filter($this->get, $this->get['order'], $this->get['direction']);
			
		$settings = $this->settings->get_item_by(array('id' => 1));

		$data['breadcrumbs'] = $this->breadcrumbs->get();
		$data['filters_values'] = $this->get;

		$data['category'] = new stdClass();
		$data['category']->products = $this->products->prepare_list($products);

		$query_string = get_filter_string($_SERVER['QUERY_STRING']);
		$data['url'] = base_url().uri_string()."?".$query_string;
		$data = array_merge($this->standart_data, $data);
		
		$this->load->view("client/categories", $data);
	}
	
	private function product($content)
	{
		$data = array(
			'title' => $content->product->name,
			'meta_keywords' => $content->product->meta_keywords,
			'meta_description' => $content->product->meta_description,
			'breadcrumbs' => $this->breadcrumbs->get(),
			'tree' => $this->categories->get_site_tree(0, "parent_id"),
			'product' => $this->products->prepare($content->product, FALSE)
		);
		$data = array_merge($this->standart_data, $data);

		$this->load->view("client/product", $data);
	}
	
	/*public function index()
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
			$products = $this->products->get_filtred((object)$get, $order, $direction);
			
			$settings = $this->settings->get_item_by(array('id' => 1));

			$data['title'] = $settings->site_title;
			$data['breadcrumbs'] = $this->breadcrumbs->get();
			$data['products'] = $this->products->get_prepared_list($products);
			$template = "client/products.php";
		}
		else
		{
			$category = $this->url->catalog_url_parse(2);

			if ($category == "root")
			{
				$categories = $this->categories->get_list(array("parent_id" => 0), $from = FALSE, $limit = FALSE, $order, $direction);
			
				$settings = $this->settings->get_item_by(array('id' => 1));

				$data['title'] = $settings->site_title;
				$data['meta_title'] = $settings->site_title;
				$data['meta_keywords'] = $settings->site_keywords;
				$data['meta_description'] = $settings->site_description;
				$data['breadcrumbs'] = $this->breadcrumbs->get();
				$data['categories'] =  $this->categories->get_prepared_list($categories);
			
				$template = 'client/categories.php';		
			}
			else
			{
				if(isset($category->product))
				{
					$data['product'] = $this->products->prepare($category->product, FALSE);
					$template = "client/product.php";
				}
				else
				{
					$categories = $this->categories->get_list(array("parent_id" => $category->id), $from = FALSE, $limit = FALSE, $order, $direction);
					if($categories == NULL)
					{
						$product = $this->products->get_list(array("parent_id" => $category->id), $from = FALSE, $limit = FALSE, $order, $direction);
						$data['products'] = $this->products->get_prepared_list($product);					
						$template = "client/products.php";
					}
					else
					{
						$data['categories']  = $this->categories->get_prepared_list($categories);
						$template = "client/categories.php";
					}		
				}		

				$data['title'] = $category->name;
				$data['meta_title'] = $category->meta_title;
				$data['meta_keywords'] = $category->meta_keywords;
				$data['meta_description'] = $category->meta_description;
				$data['breadcrumbs'] = $this->breadcrumbs->get();
			}
		}
		$this->load->view($template, $data);
	}*/
	
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
			),
			'action' => $this->input->get('action'),
			'order_string' => $settings->order_string
		);
		$data = array_merge($this->standart_data, $data);
		$this->load->view('client/cart.php', $data);
	}
}

/* End of file catalog.php */
/* Location: ./application/controllers/catalog.php */