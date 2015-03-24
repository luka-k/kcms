<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

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
		
		if(!isset($this->get['filter'])) $this->get['filter'] = FALSE;  
	
		$data = array(
			'title' => "Каталог",
			'tree' => $this->categories->get_tree(0, "parent_id"),
			'url' => base_url().uri_string()."?".get_filter_string($_SERVER['QUERY_STRING']),
			'filters' => $this->characteristics_type->get_filters()
		);
		$this->standart_data = array_merge($this->standart_data, $data);
	}
	
	public function index()
	{
		$this->breadcrumbs->add("catalog", "Каталог");
		
		$filter = $this->get['filter'];
		
		if($filter)
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
	
	private function category($content)
	{	
		$parent_id = 0;
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
		
		$data['breadcrumbs'] = $this->breadcrumbs->get();
		$data['category']->sub_categories = $this->categories->prepare_list($this->categories->get_list(array("parent_id" => $parent_id)));
		$data['category']->products = $this->products->prepare_list($this->catalog->get_products($parent_id, $this->get['order'], $this->get['direction']));
		
		$data = array_merge($this->standart_data, $data);
				
		$this->load->view("client/categories", $data);
	}
	
	public function filtred()
	{		
		$products = $this->characteristics->get_products_by_filter($this->get, $this->get['order'], $this->get['direction']);
			
		$settings = $this->settings->get_item_by(array('id' => 1));
		
		$data = array(
			'breadcrumbs' => $this->breadcrumbs->get(),
			'filters_values' => $this->get,
			
		);
		
		$data = array_merge($this->standart_data, $data);
		
		$data['category']->products = $this->products->prepare_list($products);

		$this->load->view("client/categories", $data);
	}
	
	private function product($content)
	{
		$data = array(
			'title' => $content->product->name,
			'meta_keywords' => $content->product->meta_keywords,
			'meta_description' => $content->product->meta_description,
			'breadcrumbs' => $this->breadcrumbs->get(),
			'product' => $this->products->prepare($content->product, FALSE)
		);
		$data = array_merge($this->standart_data, $data);

		$this->load->view("client/product", $data);
	}
}

/* End of file catalog.php */
/* Location: ./application/controllers/catalog.php */