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
		
		$search = $this->input->get();
		$this->db->like('name', $search['name']);
		$query = $this->db->get('products');
		
		$products = array();
		foreach ($query->result() as $row)
		{
			$products[] = $row;
		}	
		
		$settings = $this->settings->get_item_by(array('id' => 1));
		$left_menu = $this->categories->get_site_tree(0, "parent_id");

		$data = array(
			'title' => "Поиск",
			'meta_title' => $settings->site_title,
			'meta_keywords' => $settings->site_keywords,
			'meta_description' => $settings->site_description,
			'tree' => $this->categories->get_site_tree(0, "parent_id"),
			'cart_items' => $this->cart_items,
			'total_price' => $this->total_price,
			'total_qty' => $this->total_qty,
			'product_word' => end_maker("товар", $this->total_qty),
			'top_menu' => $this->top_menu->items,
			'select_item' => "",
			'left_menu' => $left_menu,
			'url' => "",
			'user' => $this->users->get_item_by(array("id" => $this->user_id)),
			'settings' => $settings,
			'breadcrumbs' => $this->breadcrumbs->get(),
			'search' => $search['name'],
			'content' => $this->products->get_prepared_list($products)
		);
		$this->load->view("client/search", $data);
	}
}