<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends Client_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
	
		$this->breadcrumbs->add($this->config->item('works_url'), "Наши работы");
		$this->breadcrumbs->add("", "Результаты поиска");
		
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
			$query = $this->db->get('products');

			$products = array();
			foreach ($query->result() as $row)
			{
				$products[] = $row;
			}	

			$data = array(
				'title' => "Результаты поиска",
				'breadcrumbs' => $this->breadcrumbs->get(),
				'search' => $search['name'],
				'tree' => $this->categories->get_site_tree($this->config->item('works_id'), "parent_id"),
				'url' => $this->uri->segment_array(),
				'content' => $this->products->get_prepared_list($products)
			);
		
			$data = array_merge($this->standart_data, $data);
		
			$this->load->view("client/products", $data);
		}
	}
}