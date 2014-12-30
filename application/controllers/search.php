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
		
		$name = $this->input->get('q');
		$this->db->like('name', $name);
		$query = $this->db->get('products');
		
		$products = array();
		$pnames = array();
		foreach ($query->result() as $row)
		{
			if (!$pnames[$row->name])
				$products[] = $row;
			$pnames[$row->name] = 1;
		}	
		
		$settings = $this->settings->get_item_by(array('id' => 1));

		$data = array(
			'title' => $settings->site_title,
			'meta_title' => $settings->site_title,
			'meta_keywords' => $settings->site_keywords,
			'meta_description' => $settings->site_description,
			'breadcrumbs' => $this->breadcrumbs->get(),
			'tree' => $this->categories->get_site_tree(0, "parent_id"),
			'cart_items' => $this->cart_items,
			'total_price' => $this->total_price,
			'total_qty' => $this->total_qty,
			'product_word' => end_maker("товар", $this->total_qty),
			'top_menu' => $this->menus->set_active($this->top_menu, 'catalog'),
			'user' => $this->users->get_item_by(array("id" => $this->user_id)),
			'products' => $this->products->get_prepared_list($products)
		);
		$this->load->view("client/products", $data);
	}
}