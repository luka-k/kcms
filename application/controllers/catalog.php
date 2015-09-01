<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Catalog class
*
* @package		kcms
* @subpackage	Controllers
* @category	    Catalog
*/
class Catalog extends Client_Controller {

	protected $get = array();

	public function __construct()
	{
		parent::__construct();
		
		$this->config->load('characteristics');
		
		$this->get = $this->input->get();

		if(!isset($this->get['order']))
		{
			$this->get['order'] = "sort";
			$this->get['direction'] = "asc";
		}
		
		$max_value = $max_price = $this->products->get_max('price');
		if(!empty($this->get['price_to'])) $max_value = $this->get['price_to'];

		$min_value = $min_price = $this->products->get_min('price');
		if(!empty($this->get['price_from'])) $min_value = $this->get['price_from'];		
	
		$data = array(
			'title' => "Каталог",
			'select_item' => '',
			'tree' => $this->categories->get_tree(0, "parent_id"),
			'url' => base_url().uri_string()."?".get_filter_string($_SERVER['QUERY_STRING']),
			'min_price' => $min_price,
			'max_price' => $max_price,
			'min_value' => $min_value,
			'max_value' => $max_value,
			'filters_checked' => array("is_active" => ""),
			'left_menu' => $this->categories->get_tree(0, "parent_id")
		);
		
		$this->standart_data = array_merge($this->standart_data, $data);
		
		$this->load->helper('url_helper');
	}
	
	public function index()
	{
		$this->breadcrumbs->add("catalog", "Каталог");
		
		if(isset($this->get['filter']))
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
		$parent_id = 0;
		$data['category'] = new stdClass;
		if($content <> "root")
		{
			$parent_id = $content->id;

			$data = array(
				'title' => $content->name,
				'meta_keywords' => $content->meta_keywords,
				'meta_description' => $content->meta_description,
				'category' => $content
			);
		}
		
		$new_products = $this->products->get_list(array("is_new" => 1), FALSE, 3);
		$special = $this->products->get_list(array("is_special" => 1), FALSE, 3, $this->get['order'], $this->get['direction']);
		
		$data['special'] = $this->products->prepare_list($special);
		$data['new_products'] = $this->products->prepare_list($new_products);
		$data['breadcrumbs'] = $this->breadcrumbs->get();
		$data['category']->sub_categories = $this->categories->prepare_list($this->categories->get_list(array("parent_id" => $parent_id)));
		$data['category']->products = $this->products->prepare_list($this->catalog->get_products($parent_id, $this->get['order'], $this->get['direction']));
		$data['filters'] = $this->characteristics_type->get_filters($data['category']->products);
		$data = array_merge($this->standart_data, $data);
				
		$this->load->view("client/categories", $data);
	}
	
	/**
	* Вывод товаров по фильтру
	*/
	public function filtred()
	{		
		$products = $this->characteristics->get_products_by_filter($this->get, $this->get['order'], $this->get['direction']);
			
		$settings = $this->settings->get_item_by(array('id' => 1));
		
		$data = array(
			'breadcrumbs' => $this->breadcrumbs->get(),
			'filters_values' => $this->get,
			'filters' => $this->characteristics_type->get_filters()
		);
		
		$data = array_merge($this->standart_data, $data);
		
		$data['category'] = new stdClass;
		$data['category']->products = $this->products->prepare_list($products);

		$this->load->view("client/categories", $data);
	}
	
	/**
	* Вывод страницы товара
	*
	* @param object $content
	*/
	private function product($content)
	{
		$new_products = $this->products->get_list(array("is_new" => 1), FALSE, 3);
		$data = array(
			'title' => $content->product->name,
			'meta_keywords' => $content->product->meta_keywords,
			'meta_description' => $content->product->meta_description,
			'breadcrumbs' => $this->breadcrumbs->get(),
			'product' => $this->products->prepare($content->product, FALSE),
			'new_products' => $this->products->prepare_list($new_products)
		);
		
		$data['product']->recommended_products = $this->products->prepare_list($this->products->get_recommended($data['product']->id));
		
		$data = array_merge($this->standart_data, $data);

		$this->load->view("client/product", $data);
	}
}

/* End of file catalog.php */
/* Location: ./application/controllers/catalog.php */