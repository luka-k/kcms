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
		);
		
		$page = $this->articles->url_parse(2);
		if(isset($page->article))
		{
			$content = $page->article;
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
}