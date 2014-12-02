<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends Client_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{		
		$page = $this->articles->url_parse(2);
		
		$type = $this->uri->segment(2);
		$parent_info = $this->articles->get_item_by(array("url" => $type));
		$left_menu = $this->articles->get_list(array("parent_id" => $parent_info->id));
		$left_manu = $this->articles->get_prepared_list($left_menu);
		
		$data = array(
			'top_menu' => $this->top_menu,
			'left_menu' => $left_menu,
		);

		if(!empty($page->acordeon))
		{
			$content = $page->acordeon;
			$template="client/articles_acordeon.php";
		}
		elseif(isset($page->article))
		{
			$content = $page->article;
			$template="client/article.php";
		}		
		else
		{
			$content = $this->articles->get_item_by(array("id" => $page->id));
			$template="client/article.php";
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