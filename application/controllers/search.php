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
		
		$search = $this->input->get('search');

		$this->db->like('name', $search);
		$this->db->or_like('description', $search);
		$query = $this->db->get('products');

		$products = $this->products->get_prepared_list($query->result_array());
		
		$this->db->like('name', $search);
		$this->db->or_like('description', $search);
		$query = $this->db->get('articles');

		$articles = $this->articles->get_prepared_list($query->result_array());
		$content = array_merge($products, $articles);
		//var_dump($content);
		$data = array(
			'title' => "Результаты поиска",
			'breadcrumbs' => $this->breadcrumbs->get(),
			'search' => $search['name'],
			'tree' => $this->categories->get_site_tree($this->config->item('works_id'), "parent_id"),
			'url' => $this->uri->segment_array(),
			'content' => $content
		);
		
		$data = array_merge($this->standart_data, $data);
		
		$this->load->view("client/products", $data);
	}
}