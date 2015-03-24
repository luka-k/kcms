<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends Client_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$page = $this->url->url_parse(2);
		
		if($page == FALSE)
		{
			redirect(base_url()."pages/page_404");
		}
		elseif(isset($page->article))
		{
			$content = $page->article;
			$template="client/article.php";
		}		
		elseif(isset($page->articles))
		{
			$content = $page;
			$content->articles = $this->articles->prepare_list($content->articles);
			$template="client/articles.php";
		}
	
		$data = array(
			'title' => $content->name,
			'meta_keywords' => $content->meta_keywords,
			'meta_description' => $content->meta_description,
			'breadcrumbs' => $this->breadcrumbs->get(),
			'tree' => $this->categories->get_site_tree(0, "parent_id"),
			'left_menu' => $this->dynamic_menus->get_menu(4),
			'content' => $content
		);
		
		$data = array_merge($this->standart_data, $data);
		
		$this->load->view($template, $data);
	}
	
	public function page_404()
	{
		header("HTTP/1.0 404 Not Found");
		$settings = $this->settings->get_item_by(array("id" => 1));
		$data = array(
			'title' => "Страница не найдена",
			'settings' => $this->settings->get_item_by(array('id' => 1)),
		);
		
		$data = array_merge($this->standart_data, $data);
		
		$this->load->view("client/404", $data);
	}
}