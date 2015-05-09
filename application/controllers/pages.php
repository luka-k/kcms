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
			$template = $root->id == 1 ? "client/news.php" : "client/articles.php";
			
			$content = $page;
			$content->articles = $this->articles->prepare_list($content->articles);
			
			$manufacturer_id = $this->input->get('m_id');
			$selected_manufacturer = "";
			if(!empty($manufacturer_id))
			{
				$selected_news = array();
				foreach ($content->articles as $item)
				{
					if($item->manufacturer_id == $manufacturer_id) $selected_news[] = $item;
				}
				
				$selected_manufacturer = $this->manufacturer->prepare($this->manufacturer->get_item($manufacturer_id));
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
			'manufacturers' => $this->manufacturer->prepare_list($this->manufacturer->get_list(FALSE)),
			'selected_manufacturer' => $selected_manufacturer,
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