<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends Client_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$page = $this->articles->url_parse(2);
		$this->uri->segment(2) ? $select_item = $this->uri->segment(2) : $select_item = "";
		$data = array(
			'tree' => $this->categories->get_site_tree(0, "parent_id"),
			'top_menu' => $this->top_menu->items,
			'select_item' => $select_item
		);
		
		$url = $this->uri->segment(2);
		$root = $this->menus_items->get_item_by(array("url" => $url));
		if($root && $url <> "podderzhka-klientov") $data['level_2'] = $this->menus_items->menu_tree(1, $root->id);
		
		$sub_level = $this->menus_items->get_item_by(array("url" => $this->uri->segment(3)));
				
		if($sub_level) $data['level_3'] = $this->menus_items->menu_tree(1, $sub_level->id);

		$data['content'] = $page;

		if($page == "404")
		{
			$settings = $this->settings->get_item_by(array("id" => 1));
			$data['title'] = "Страница не найдена";
			$data['meta_title'] = $settings->site_title;
			$data['meta_keywords'] = $settings->site_keywords;
			$data['meta_description'] = $settings->site_description;
			$template="client/404.php";
		}
		else
		{
			if($sub_level->url == "novosti")
			{
				$this->uri->segment(5) ? $sub_template = "single-news" : $sub_template = "news";
			}
			else
			{
				$sub_template = "page";
			}
			$data['title'] = $page->name;
			$data['meta_title'] = $page->meta_title;
			$data['meta_keywords'] = $page->meta_keywords;
			$data['meta_description'] = $page->meta_description;
			$data['breadcrumbs'] = $this->breadcrumbs->get();
			$data['sub_template'] = $sub_template;
			$template="client/articles.php";
		}
		$this->load->view($template, $data);
	}
	
	public function dealers()
	{
		$this->uri->segment(2) ? $select_item = $this->uri->segment(2) : $select_item = "";
		$this->breadcrumbs->Add("articles/gde-kupit", "Где купить");
		$this->breadcrumbs->Add("dealers", "Как стать дилером");
		$data = array(
			'title' => "Дилеры",
			'meta_title' => "",
			'meta_keywords' => "",
			'meta_description' => "",
			'breadcrumbs' => $this->breadcrumbs->get(),
			'top_menu' => $this->top_menu->items,
			'select_item' => $select_item
		);
		
		$root = $this->menus_items->get_item_by(array("url" => $this->uri->segment(2)));
		if($root) $data['level_2'] = $this->menus_items->menu_tree(1, $root->id);
		
		$this->load->view("client/dealers", $data);
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