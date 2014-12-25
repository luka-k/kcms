<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Catalog extends Client_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$url = base_url().uri_string();

		$order = $this->input->get('order');
		
		$direction = $this->input->get('direction');
		
		$this->breadcrumbs->add("catalog", "Каталог");
		
		$this->config->load('characteristics_config');
		//Тут наверно в последстивии понадобиться  
		//придумать какуюнить умную функцию
		//что бы отбирать характеристики товаров
		//которые нужны в этой подкатегори
		//$filters = $this->characteristics->filters;
		$filters = $this->characteristics->get_filters();
		
		$main_category = $this->categories->get_item_by(array('url' => $this->uri->segment(2)));
		
		$data = array(
			'tree' => $this->categories->get_site_tree($main_category->id, "parent_id"),
			'main_category' => $main_category,
			'cart_items' => $this->cart_items,
			'total_price' => $this->total_price,
			'total_qty' => $this->total_qty,
			'product_word' => end_maker("товар", $this->total_qty),
			'top_menu' => $this->menus->set_active($this->top_menu, 'catalog'),
			'url' => $url,
			'filters' => $filters,
			'news' => $this->articles->get_prepared_list($this->articles->get_list(array('parent_id' => 3), 0, 3, 'date', 'desc')),
			'articles' => $this->articles->get_prepared_list($this->articles->get_list(array('parent_id' => 1), 0, 3, 'id', 'desc')),
			'user' => $this->users->get_item_by(array("id" => $this->user_id))
		);
		
		$get = $this->input->get();
		
		if($get)
		{
			$content = $this->products->get_filtred((object)$get);
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
					$data['product'] = $content;
				}
				else
				{
					$content = $this->categories->get_list(array("parent_id" => $category->id), $from = FALSE, $limit = FALSE, $order, $direction);
					$content = $this->categories->get_prepared_list($content);
					$names = array();
					foreach ($content as $i=>$c)
					{
						$level = count(explode('/', $c->full_url));
						$names[] = $level < 6 ? $c->name : $c->caption;
						if ($level > 6 && $content[$i]->caption) 
							$content[$i]->name = $content[$i]->caption;
					}
					array_multisort($names, $content);
					$template = "client/categories.php";	
					$products = $this->products->get_prepared_list($this->products->get_list(array('parent_id' => $category->id)));
					foreach ($content as $c)
					{
						$products = array_merge($products, $this->products->get_prepared_list($this->products->get_list(array('parent_id' => $c->id))));
					}
				
				}
				$data['title'] = $category->name;
				$data['current_category'] = $category;
				$data['products'] = $products;
				$parent_category =  $this->categories->get_item($category->parent_id);
				$data['parent_category'] = $parent_category ? $this->categories->prepare($parent_category) : false;
				$data['meta_title'] = $category->meta_title;
				$data['meta_keywords'] = $category->meta_keywords;
				$data['meta_description'] = $category->meta_description;
				$data['subcategories'] = $content;
				if ($this->uri->segment(4) && $category && !isset($category->product))
					$data['subcategories'][] = $this->categories->prepare($category);
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