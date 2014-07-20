<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url', 'translit', 'upload'));
	}
	
	public function index($id = FALSE)
	{
		if ($id == false)
		{
			$news_info = $this->parts->get_item_by(array('url' => 'news'));
			var_dump($news_info);
			/*$data = array(
				'title' => $settings->site_title,
				'meta_title' => $settings->site_title,
				'keywords' => $settings->site_keywords,
				'description' => $settings->site_description
			);*/
			//$data['page'] = $this->pages->get_item_by(array('url'=>$url));
			//$data['menu'] = $this->menu_model->menu('top_menu');
			$this->load->view('client/news.php', $data);
		}
	}	
}

/* End of file news.php */
/* Location: ./application/controllers/news.php */