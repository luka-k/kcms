<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//Вывод страниц разделов
class Pages extends CI_Controller {

	public $menu = array();
	
	public function __construct()
	{
		parent::__construct();
		$this->menu = array(
			"0" => array("Главная", base_url(), "0"),
			"1" => array("Новости", base_url()."news", "0"),
			"2" => array("Каталог", base_url()."catalog", "0"),
			"3" => array("Блог", base_url()."blog", "0"),
		);
	}
	
	public function index($url_part, $url_page = FALSE)
	{		
		switch ($url_part) 
		{
			case "news": $this->menu[1][2] = 1;
			break;
			case "blog": $this->menu[3][2] = 1;
			break;
		}
		
		if ($url_page == FALSE)
		{
			$news_info = $this->parts->get_item_by(array('url' => $url_part));
			
			$breadcrumbs = array(
				'Главная' => base_url(),
				$news_info->title => ""
			);
		
			$data = array(
				'title' => $news_info->title,
				'meta_title' => $news_info->meta_title,
				'keywords' => $news_info->keywords,
				'description' => $news_info->description,
				'tree' => $this->categories->get_sub_tree(0, "parent"),
				'content' => array_reverse($this->$url_part->get_list(array('is_active' => '1'))),
				'breadcrumbs' => $breadcrumbs,
				'menu' => $this->menu
			);
			$this->load->view('client/'.$url_part.'.php', $data);		
		}
		else
		{
			$part = $this->parts->get_item_by(array('url' => $url_part));
			$news_info = $this->$url_part->get_item_by(array('url' => $url_page));
			
			$breadcrumbs = array(
				'Главная' => base_url(),
				$part->title => base_url()."/".$url_part,
				$news_info->title => ""
			);
			
			$data = array(
				'title' => $news_info->title,
				'meta_title' => $news_info->meta_title,
				'keywords' => $news_info->keywords,
				'description' => $news_info->description,
				'tree' => $this->categories->get_sub_tree(0, "parent"),
				'content' => $news_info,
				'breadcrumbs' => $breadcrumbs,
				'menu' => $menu
			);
			$this->load->view('client/news-page.php', $data);		
		}
	}
	
}

/* End of file pages.php */
/* Location: ./application/controllers/news.php */