<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//main page controller

class Index extends Client_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{		
		$settings = $this->settings->get_item_by(array('id' => 1));
		
		$news_lt = $this->news->get_news("novosti-lt-pro", 3);
		$news_lt = $this->news->get_prepared_list($news_lt);
		$news_camb = $this->news->get_news("novosti-cambridge", 3);
		$news_camb = $this->news->get_prepared_list($news_camb);
		$news_ielts = $this->news->get_news("novosti-ielts", 3);
		$news_ielts = $this->news->get_prepared_list($news_ielts);
		$news_pearson = $this->news->get_news("novosti-pearson", 3);
		$news_pearson = $this->news->get_prepared_list($news_pearson);
		
		$slider = $this->slider->get_list(FALSE, FALSE, FALSE, "sort", "asc");
		$slider = $this->slider->get_prepared_list($slider);
		
		$data = array(
			'title' => $settings->site_title,
			'meta_title' => $settings->site_title,
			'meta_keywords' => $settings->site_keywords,
			'meta_description' => $settings->site_description,
			'top_menu' => $this->top_menu,
			'news_lt' => $news_lt,
			'news_camb' => $news_camb,
			'news_ielts' => $news_ielts,
			'news_pearson' => $news_pearson,
			'slider' => $slider,
			'url' => ''
		);
		$this->load->view('client/main.php', $data);
	}	
}

/* End of file index.php */
/* Location: ./application/controllers/index.php */