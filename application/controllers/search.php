<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends Client_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
	
		$this->breadcrumbs->add("catalog", "Каталог");
		$this->breadcrumbs->add("", "Поиск");
		
		$name = $this->input->get('name');
		$this->db->like('name', $name);
		$query = $this->db->get('products');
		
		$products = array();
		foreach ($query->result() as $row)
		{
			$products[] = $row;
		}	
		
		$settings = $this->settings->get_item_by(array('id' => 1));

		$data = array(
			'title' => $settings->site_title,
			'breadcrumbs' => $this->breadcrumbs->get(),
			'tree' => $this->categories->get_site_tree(0, "parent_id"),
			'search' => $this->products->get_prepared_list($products)
		);
		
		$data = array_merge($this->standart_data, $data);
		
		$this->load->view("client/search", $data);
	}
}