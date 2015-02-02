<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends Client_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$left_menu = $this->dynamic_menus->get_menu(4);
		//var_dump($left_menu);
		$data = array(
			'tree' => $this->categories->get_site_tree(0, "parent_id"),
			'left_menu' => $left_menu,
		);
		$data = array_merge($this->standart_data, $data);
		
		$page = $this->url->url_parse(2);

		if(isset($page->article))
		{
			$content = $page->article;
			$template="client/article.php";
		}		
		elseif(isset($page->articles))
		{
			$content = $page;
			$content->articles = $this->articles->get_prepared_list($content->articles);
			$template="client/articles.php";
		}
		elseif($page == FALSE)
		{
		
		}
		
		//var_dump($content);
		
		$data['title'] = $content->name;
		$data['meta_title'] = $content->meta_title;
		$data['meta_keywords'] = $content->meta_keywords;
		$data['meta_description'] = $content->meta_description;
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
			'tree' => $this->categories->get_site_tree(0, "parent_id"),
			'left_menu' => $left_menu,
			'wishlist' => $wishlist
		);
		$data = array_merge($this->standart_data, $data);		

		$this->load->view('client/wishlist.php', $data);
	}
}