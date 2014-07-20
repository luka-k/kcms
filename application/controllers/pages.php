<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url', 'translit', 'upload'));
	}
	
	public function index($url_part, $url_page = FALSE)
	{
		if ($url_page == FALSE)
		{
			$news_info = $this->parts->get_item_by(array('url' => $url_part));
		
			$data = array(
				'title' => $news_info->title,
				'meta_title' => $news_info->meta_title,
				'keywords' => $news_info->keywords,
				'description' => $news_info->description,
				'content' => $this->$url_part->get_list(array('is_active' => '1'))
			);
			$this->load->view('client/'.$url_part.'.php', $data);		
		}
		else
		{
			$news_info = $this->$url_part->get_item_by(array('url' => $url_page));
			$data = array(
				'title' => $news_info->title,
				'meta_title' => $news_info->meta_title,
				'keywords' => $news_info->keywords,
				'description' => $news_info->description,
				'content' => $news_info
			);
			$this->load->view('client/news-page.php', $data);		
		}
	}
	
	/*public function news($url = FALSE)
	{
		if ($url == false)
		{
			$news_info = $this->parts->get_item_by(array('url' => 'news'));
		
			$data = array(
				'title' => $news_info->title,
				'meta_title' => $news_info->meta_title,
				'keywords' => $news_info->keywords,
				'description' => $news_info->description,
				'content' => $this->news->get_list(array('is_active' => '1'))
			);
			$this->load->view('client/news.php', $data);
		}
		else
		{
			$news_info = $this->news->get_item_by(array('url' => $url));
			$data = array(
				'title' => $news_info->title,
				'meta_title' => $news_info->meta_title,
				'keywords' => $news_info->keywords,
				'description' => $news_info->description,
				'content' => $news_info
			);
			$this->load->view('client/news-page.php', $data);
		}
	}

	public function blog($url = FALSE)
	{
		if ($url == false)
		{
			$blog_info = $this->parts->get_item_by(array('url' => 'blog'));
		
			$data = array(
				'title' => $blog_info->title,
				'meta_title' => $blog_info->meta_title,
				'keywords' => $blog_info->keywords,
				'description' => $blog_info->description,
				'content' => $this->blog->get_list(array('is_active' => '1'))
			);
			$this->load->view('client/blog.php', $data);
		}
		else
		{
			$blog_info = $this->blog->get_item_by(array('url' => $url));
			$data = array(
				'title' => $blog_info->title,
				'meta_title' => $blog_info->meta_title,
				'keywords' => $blog_info->keywords,
				'description' => $blog_info->description,
				'content' => $blog_info
			);
			$this->load->view('client/blog-page.php', $data);
		}
	}*/	
}

/* End of file news.php */
/* Location: ./application/controllers/news.php */