<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends Client_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$left_menu = $this->dynamic_menus->get_menu(4);
		
		$data = array(
			'tree' => $this->categories->get_site_tree(0, "parent_id"),
			'top_menu' => $this->top_menu,
			'left_menu' => $left_menu,
			'type' => $this->uri->segment(2)
		);
		
		$page = $this->articles->url_parse(2);

		if(isset($page->id))
		{
			$content = $page;
			$template="client/article.php";
		}		
		else
		{
			$content = $this->articles->get_list(array("parent_id" => $page->id));
			$content = $this->articles->get_prepared_list($content);
			$template="client/articles.php";
		}
		
		$data['title'] = $page->name;
		$data['meta_title'] = $page->meta_title;
		$data['meta_keywords'] = $page->meta_keywords;
		$data['meta_description'] = $page->meta_description;
		$data['breadcrumbs'] = $this->breadcrumbs->get();
		$data['content'] = $content;
		
		$this->load->view($template, $data);
	}
	
	// wishlist()
	// вывод вишлиста
	public function wishlist()
	{
		$left_menu = $this->dynamic_menus->get_menu(4);
		
		$wishlist = $this->wishlist->get();

		$data = array(
			'title' => "вишлист",
			'meta_title' => "",
			'meta_keywords' => "",
			'meta_description' => "",
			'tree' => $this->categories->get_site_tree(0, "parent_id"),
			'cart_items' => $this->cart_items,
			'total_price' => $this->total_price,
			'total_qty' => $this->total_qty,
			'product_word' => end_maker("товар", $this->total_qty),
			'top_menu' => $this->menus->set_active($this->top_menu, 'wishlist'),
			'left_menu' => $left_menu,
			'user' => $this->users->get_item_by(array("id" => $this->user_id)),
			'wishlist' => $wishlist
		);

		$this->load->view('client/wishlist.php', $data);
	}
}