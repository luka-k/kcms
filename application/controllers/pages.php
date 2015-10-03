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
		$content = $this->url->url_parse(2);
		
		if($content == FALSE) redirect(base_url()."pages/page_404");
		
		$template = 'articles'; //не забыть убрать если в дальнейшем не понадобиться
		
		$under_menu = new stdClass();
		$root = $this->menus_items->get_item_by(array("url" => $this->uri->segment(2)));
		if($root)
		{
			$under_menu->items = $this->menus_items->menu_tree(5, $root->id);
			$under_menu->active = $this->uri->segment(3);
		}
		
		if($content->articles) $content->articles = $this->articles->prepare_list($content->articles);
		
		if(!empty($content->template)) $template = $content->template; //не забыть убрать если в дальнейшем не понадобиться
		
		$this->config->load('articles');
		
		$publication = $this->articles->get_list(array("parent_id" => $this->config->item('publication_id')), 0, 6);
		
		$data = array(
			'title' => $content->name,
			'meta_keywords' => $content->meta_keywords,
			'meta_description' => $content->meta_description,
			'breadcrumbs' => $this->breadcrumbs->get(),
			'under_menu' => $under_menu,
			'select_item' => "",
			'publication' => $this->articles->prepare_list($publication),
			'content' => $content
		);
		
		$data = array_merge($this->standart_data, $data);
		$this->load->view('client/'.$template, $data);
		
		/*if(isset($page->article))
		{
			$sub_template = "single-news";
			$template = $root->id == 3 ? "client/news.php" : "client/article.php";
			
			$content = $page->article;
		}		
		elseif(isset($page->articles))
		{
			$sub_template = "news";
			$template = $root->id == 3 ? "client/news.php" : "client/articles.php";
			
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
		}*/
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