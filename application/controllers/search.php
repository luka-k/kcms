<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Search class
*
* @package		kcms
* @subpackage	Controllers
* @category	    Search
*/
class Search extends Client_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$data = array(
			'select_item' => '',
			'tree' => $this->categories->get_tree(0, "parent_id"),
			'url' => base_url().uri_string(),
			'filters' => $this->characteristics_type->get_filters(),
			'min_price' => $this->products->get_min('price'),
			'max_price' => $this->products->get_max('price'),
			'min_value' => $this->products->get_min('price'),
			'max_value' => $this->products->get_max('price'),
			'filters_checked' => array("is_active" => ""),
			'left_menu' => $this->categories->get_tree(0, "parent_id")
		);
		
		$this->standart_data = array_merge($this->standart_data, $data);
	}
	
	public function index()
	{
		$this->breadcrumbs->add("catalog", "Каталог");
		$this->breadcrumbs->add("", "Поиск");
		
		$search = $this->input->get();
		
		$product = $this->products->get_item_by(array("name" => $search['name']));
		
		if(!empty($product))
		{
			$product = $this->products->prepare($product);
			redirect($product->full_url);
		}
		else
		{
			$this->db->like('name', $search['name']);
			$this->db->or_like('isbn', $search['name']);
			$this->db->or_like('autor', $search['name']);
			$this->db->order_by('name', 'asc');
			//$this->db->limit();
			$query = $this->db->get('products');
			$products = $query->result_array();
			//var_dump($products);
			$data = array(
				'title' => "Поиск",
				'breadcrumbs' => $this->breadcrumbs->get(),
				'tree' => $this->categories->get_tree(0, "parent_id"),
				'search' => $search['name'],
				'left_menu' => $this->categories->get_tree(0, "parent_id"),
				'filters' => $this->characteristics_type->get_filters($products)
			);
			
			$data['category'] = new stdClass;
			$data['category']->products = $this->products->prepare_list($products);
		
			$data = array_merge($this->standart_data, $data);
		
			$this->load->view("client/categories", $data);
		}
	}
}