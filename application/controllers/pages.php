<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Pages class
*
* @package		kcms
* @subpackage	Controllers
* @category	    Pages
*/
class Pages extends Client_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$page = $this->url->url_parse(2);

		$root = $this->articles->get_item_by(array("url" => $this->uri->segment(2)));
		
		if($page == FALSE) redirect(base_url()."pages/page_404");
		
		if(isset($page->article))
		{
			$sub_template = "single-news";
			$template = $root->id == 1 ? "client/news.php" : "client/article.php";
			
			$content = $page->article;
		}		
		elseif(isset($page->articles))
		{
			$sub_template = "news";
			$template = $root->id == 1 ? "client/news.php" : "client/article.php";
			
			$content = $page;
			$content->articles = $this->articles->prepare_list($content->articles);
			
			$select_date = $this->input->get('date');
			if(!empty($select_date))
			{
				$selected_news = array();
				foreach ($content->articles as $item)
				{
					$item->date = new DateTime($item->date);
					$item->date = date_format($item->date, 'm/d/Y');
					if($item->date == $select_date) $selected_news[] = $item;
				}
				$content->articles = $selected_news;
			}
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
	
	/**
	* Страница 404
	*/
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