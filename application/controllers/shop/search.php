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
	}
	
	public function index()
	{
		$this->breadcrumbs->add(base_url()."catalog", "Каталог");
		$this->breadcrumbs->add("", "Поиск");

		$this->post = $this->input->post();
		
		$search = $this->input->get();

		$product = $this->products->get_item_by(array("name" => rawurldecode($search['name'])));
		if(!empty($product))
		{
			$product = $this->products->prepare($product, FALSE);
			redirect($product->full_url);
		}
		else
		{		
			$this->db->like('name', rawurldecode($search['name']));
			$this->db->limit(10, 0);
			$query = $this->db->get('products');
			$products = $query->result();
			
			$this->db->like('name', rawurldecode($search['name']));
			$query = $this->db->get('products');
			$all_products = $query->result();
			
			$all_products_ids = $this->catalog->get_products_ids($all_products);
			
			$data = array(
				'title' => 'Поиск',
				'url' => base_url().uri_string().'?'.get_filter_string($_SERVER['QUERY_STRING']),
				'top_active' => 'shop',
				'price_from' => $this->products->get_min('price'),
				'price_to' => $this->products->get_max('price'),
				'price_min' => $this->products->get_min('price'),
				'price_max' => $this->products->get_max('price'),
				'width_from' => $this->products->get_min('width'),
				'width_to' => $this->products->get_max('width'),
				'width_min' => $this->products->get_min('width'),
				'width_max' => $this->products->get_max('width'),
				'height_from' => $this->products->get_min('height'),
				'height_to' => $this->products->get_max('height'),
				'height_min' => $this->products->get_min('height'),
				'height_max' => $this->products->get_max('height'),
				'depth_from' => $this->products->get_min('depth'),
				'depth_to' => $this->products->get_max('depth'),
				'depth_min' => $this->products->get_min('depth'),
				'depth_max' => $this->products->get_max('depth'),
				'filters_checked' => array(),
				'left_menu' => $this->categories->get_tree($all_products, $this->post),
				'manufacturer' => $this->manufacturers->get_tree($all_products, $this->post),
				'sku_tree' => $this->manufacturers->get_tree($all_products, $this->post),
				'collection' => $this->collections->get_tree($all_products_ids, $this->post),
				'filters' => $this->characteristics_type->get_filters($all_products, $this->post),
				'nok' => $this->catalog->get_nok_tree($all_products_ids, $this->post),
				'ajax_from' => '',
				'childs_categories' => '',
				'breadcrumbs' => $this->breadcrumbs->get(),
				'search' => rawurldecode($search['name']),
				'no_shadow' => TRUE,
				'total_rows' => count($all_products)
			);

			$data['category'] = new stdClass;
			$data['category']->products = $this->products->prepare_list($products);

			$data = array_merge($this->standart_data, $data);
		
			$this->load->view("client/shop/categories", $data);
		}
	}
}