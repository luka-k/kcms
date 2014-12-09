<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends Client_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{	
		$page = $this->articles->url_parse(2);
		$page = $this->articles->prepare($page);
		
		
		$type = $this->uri->segment(2);
		$sub_type = $this->uri->segment(3);
		$parent_info = $this->articles->get_item_by(array("url" => $type));
		$left_menu = $this->articles->get_list(array("parent_id" => $parent_info->id));
		$left_menu = $this->articles->get_prepared_list($left_menu);
		
		$data = array(
			'top_menu' => $this->top_menu,
			'left_menu' => $left_menu,
			'type' => $type,
			'sub_type' => $sub_type
		);
		
		$data['title'] = $page->name;
		$data['meta_title'] = $page->meta_title;
		$data['meta_keywords'] = $page->meta_keywords;
		$data['meta_description'] = $page->meta_description;
		$data['breadcrumbs'] = $this->breadcrumbs->get();
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
}