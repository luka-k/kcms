<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends Client_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$page = $this->url->url_parse(2);

		$root = $this->articles->get_item_by(array("url" => $this->uri->segment(2)));
		if($page == FALSE)
		{
			redirect(base_url()."pages/page_404");
		}
		elseif(isset($page->article))
		{
			$sub_template = "";
			if($root->id == 3)
			{
				$sub_template = "single-news";
				$template="client/news.php";
			}
			else
			{
				$template="client/article.php";
			}
			
			$content = $page->article;
		}		
		elseif(isset($page->articles))
		{
			if($root->id == 3)
			{
				$sub_template = "news";
				$template="client/news.php";
			}
			else
			{
				$template="client/article.php";
			}
			$content = $page;
			$content->articles = $this->articles->prepare_list($content->articles);
		}
	
		$data = array(
			'title' => $content->name,
			'meta_keywords' => $content->meta_keywords,
			'meta_description' => $content->meta_description,
			'breadcrumbs' => $this->breadcrumbs->get(),
			'tree' => $this->categories->get_tree(0, "parent_id"),
			'select_item' => "",
			'content' => $content,
			'sub_template' => $sub_template
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
			'select_item' => "",
			'settings' => $this->settings->get_item_by(array('id' => 1)),
		);
		
		$data = array_merge($this->standart_data, $data);
		
		$this->load->view("client/404", $data);
	}
}