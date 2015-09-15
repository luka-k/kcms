<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends Client_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{	
		$page = $this->articles->url_parse(2);
		if($page == "404")
		{
			$page = $this->articles->get_item_by(array("url" => "study"));
	
			$page->description = "Sorry, this page is under construction.</br></br>Please, come again later"; 
			$page->en_description = "Sorry, this page is under construction.</br></br>Please, come again later"; 
		}

		$page = $this->articles->prepare($page);
	
		$type = $this->uri->segment(2);
		$sub_type = $this->uri->segment(3);

		$parent_info = $this->articles->get_item_by(array("url" => $type));
		$left_menu = $this->articles->get_list(array("parent_id" => $parent_info->id, "not_left_menu" => 0), FALSE, FALSE, "sort", "asc");
		$left_menu = $this->articles->get_prepared_list($left_menu);
		
		$data = array(
			'top_menu' => $this->top_menu,
			'left_menu' => $left_menu,
			'type' => $type,
			'sub_type' => $sub_type
		);
		
		if(isset($page->news_item))
		{
			$page->news_item = $this->news->prepare($page->news_item);
			
			if(empty($page->news_item->name)) redirect(base_url().'category/study/page-is-under-construction/');
			
			$data['title'] = $page->news_item->name;
			$data['meta_title'] = $page->news_item->meta_title;
			$data['meta_keywords'] = $page->news_item->meta_keywords;
			$data['meta_description'] = $page->news_item->meta_description;
		}
		elseif(empty($page->article))
		{
			if(empty($page->name)) redirect(base_url().'category/study/page-is-under-construction/');
			$data['title'] = $page->name;
			$data['meta_title'] = $page->meta_title;
			$data['meta_keywords'] = $page->meta_keywords;
			$data['meta_description'] = $page->meta_description;
		}
		else
		{
			$page->article = $this->articles->prepare($page->article);
			
			if(empty($page->article->name)) redirect(base_url().'category/study/page-is-under-construction/');
			
			$data['title'] = $page->article->name;
			$data['meta_title'] = $page->article->meta_title;
			$data['meta_keywords'] = $page->article->meta_keywords;
			$data['meta_description'] = $page->article->meta_description;
		}
		
		$data['url'] = $this->uri->uri_string();
		
		$sub_type_page = $this->articles->get_item_by(array('url' => $sub_type));
		if($sub_type_page->id == $this->config->item('callback_id')) $data['callback'] = TRUE;
		$data['content'] = $page;
		$data['breadcrumbs'] = $this->breadcrumbs->get();	
		$this->load->view("client/article.php", $data);
	}
	
	//Думаю это костыль
	//но подругому как сохранить url от предидушего варианта сайта не придумал пока
	public function redirect_page()
	{
		$url = uri_string();
		if ($url == "contacts/feedback") redirect(base_url()."category/kontakty/obratnaya-svyaz", 'location', 301);
	}
	
	public function page_under_constract()
	{

	}
}