<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Catalog class
*
* @package		kcms
* @subpackage	Controllers
* @category	    Catalog
*/
class Catalog extends Client_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->config->load('characteristics');
		
		$max_price = $this->products->get_max('price');
		if($this->input->get('price_to')) $max_price = $this->input->get('price_to');

		$min_price = $this->products->get_min('price');
		if($this->input->get('price_from')) $min_price = $this->input->get('price_from');		
			
		$last_news = $this->articles->get_list(array("parent_id" => $this->config->item('news_id')), 3, 0, 'date', 'desc');
		
		$data = array(
			'title' => "Каталог",
			'shop' => TRUE,
			'top_menu' => $this->dynamic_menus->get_menu(2)->items,
			'select_item' => '',
			'tree' => $this->categories->get_tree(0, "parent_id"),
			'url' => base_url().uri_string()."?".get_filter_string($_SERVER['QUERY_STRING']),
			'min_price' => $min_price,
			'max_price' => $max_price,
			'filters' => $this->characteristics_type->get_filters(),
			'filters_checked' => array(),
			'left_menu' => $this->categories->get_tree(0, "parent_id"),
			'last_news' => $this->articles->prepare_list($last_news),
			'slider' => $this->sliders->prepare_list($this->sliders->get_list(array('type' => 1), FALSE, FALSE, "sort", "asc")),
			'order' => 'name',
			'direction' => 'asc'
		);
		
		if($this->input->get('order'))
		{
			$data['order'] = $this->input->get('order');
			$data['direction'] = $this->input->get('direction');
		}
		
		$this->standart_data = array_merge($this->standart_data, $data);
		
		$this->load->helper('url_helper');
	}
	
	public function index()
	{
		$this->breadcrumbs->add("catalog", "Каталог");
		
		if($this->input->get('filter'))
		{
			 $this->filtred();
		}
		else
		{		
			$content = $this->url->catalog_url_parse(2);
			if($content == FALSE) redirect(base_url()."pages/page_404"); 
			
			isset($content->product) ? $this->product($content) : $this->category($content);
		}
	}
	
	/**
	* Вывод категории товаров
	*
	* @param object $content
	*/
	private function category($content)
	{	
		$data['category'] = $content;	
		
		if($content == "root")
		{
			$data['new_products'] = $this->products->prepare_list($this->products->get_list(array("is_new" => 1), FALSE, 5));
			$data['special_products'] = $this->products->prepare_list($this->products->get_list(array("is_special" => 1), FALSE, 5));	
		}
		else
		{			
			$data['title'] = $content->name;
			$data['keywords'] = $content->meta_keywords;
			$data['description'] = $content->meta_description;
			
			$data['products'] = $this->products->prepare_list($this->catalog->get_products($content->id, $this->standart_data['order'], $this->standart_data['direction']));
			$data['filters'] = $this->characteristics_type->get_filters($data['products']);
			
		}
		
		$data['breadcrumbs'] = $this->breadcrumbs->get();
		
		$data = array_merge($this->standart_data, $data);
				
		$this->load->view("client/categories", $data);
	}
	
	/**
	* Вывод товаров по фильтру
	*/
	public function filtred()
	{		
		
		$products = $this->characteristics->get_products_by_filter($this->input->get(), $this->standart_data['order'], $this->standart_data['direction']);
					
		$data = array(
			'breadcrumbs' => $this->breadcrumbs->get(),
			'filters_values' => $this->input->get(),
			'filters' => $this->characteristics_type->get_filters()
		);
		
		$data = array_merge($this->standart_data, $data);
		
		$data['category'] = new stdClass;
		$data['products'] = $this->products->prepare_list($products);

		$this->load->view("client/categories", $data);
	}
	
	/**
	* Вывод страницы товара
	*
	* @param object $content
	*/
	private function product($content)
	{
		$data = array(
			'title' => $content->product->name,
			'keywords' => $content->product->meta_keywords,
			'description' => $content->product->meta_description,
			'breadcrumbs' => $this->breadcrumbs->get(),
			'product' => $this->products->prepare($content->product, FALSE)
		);
		
		$data['product']->recommended_products = $this->products->prepare_list($this->products->get_recommended($data['product']->id));
		
		$data = array_merge($this->standart_data, $data);

		$this->load->view("client/product", $data);
	}
}

/* End of file catalog.php */
/* Location: ./application/controllers/catalog.php */