<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contacts extends Client_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$left_menu = $this->articles->get_site_tree(9, "parent_id");
		
		$data = array(
			'tree' => $left_menu,
			'url' => $this->uri->segment_array()
		);
		$data = array_merge($this->standart_data, $data);
		
		$page = $this->url->url_parse(2);

		if(isset($page->article))
		{
			$content = $page;
			$segment_3 = $this->uri->segment(3);
			
			if(isset($segment_3) && $content->article->id == 12)
			{
				$data['callback'] = TRUE;
			}
			else
			{
				$segment_4 = $this->uri->segment(4);
				/*if($segment_4)*/ $content->article = $this->articles->prepare($page->article);
			}
			$template="client/contact.php";
		}	
		
		if(isset($page->articles) && $page->articles)
		{
			$content = $page;
			if(!$this->uri->segment(3))
			{
				$articles = array();
				foreach($content->articles as $item)
				{
					$sub_articles = $this->articles->get_list(array("parent_id" => $item->id));
					//$sub_articles ? $articles = array_merge($articles, $sub_articles) :	
					$articles[] = $item;
				}
				
				$content->articles = $this->articles->get_prepared_list($articles);
				$template="client/contacts.php";
			}
			else
			{
				
				$content->articles = $this->articles->get_prepared_list($content->articles);
				
				$template="client/contacts.php";
			}
			
		}
		elseif($page == FALSE)
		{
			$content = $this->articles->get_item(9);
			$content->articles = array();
			$template="client/articles.php";
		}
		$data['title'] = $content->name;
		$data['meta_title'] = $content->meta_title;
		$data['meta_keywords'] = $content->meta_keywords;
		$data['meta_description'] = $content->meta_description;
		$data['breadcrumbs'] = $this->breadcrumbs->get();
		$data['content'] = $content;
		
		$this->load->view($template, $data);
	}
}