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
		$left_menu_select = '';
		$this->config->load('articles');
		
		$under_menu = new stdClass();
		$root = $this->menus_items->get_item_by(array("url" => $this->uri->segment(2)));
		if($root)
		{
			$under_menu->items = $this->menus_items->menu_tree(5, $root->id);
			$under_menu->active = $this->uri->segment(3);
		}
		
		if($content->articles) 
		{
			$content->articles = $this->articles->prepare_list($content->articles);
			$left_menu_select = $content->articles[0]->url;
		}
		
		if(!empty($content->template)) $template = $content->template; //не забыть убрать если в дальнейшем не понадобиться
		
		
		$publication = $this->articles->get_list(array("parent_id" => $this->config->item('publication_id')), 0, 6);
		$product_categories = $this->articles->get_list(array("parent_id" => $this->config->item('assortment_id')), FALSE, FALSE, 'sort', 'asc');
		
		$level_3 = $this->articles->get_item_by(array('url' => $this->uri->segment(4)));
		$left_menu = $this->articles->get_list(array("parent_id" => $level_3->id), FALSE, FALSE, 'sort', 'asc');
		
		if($this->uri->segment(5)) $left_menu_select = $this->uri->segment(5);
		
		$data = array(
			'title' => $content->name,
			'meta_keywords' => $content->meta_keywords,
			'meta_description' => $content->meta_description,
			'breadcrumbs' => $this->breadcrumbs->get(),
			'under_menu' => $under_menu,
			'left_menu' => $this->articles->prepare_list($left_menu),
			'select_item' => "",
			'product_select' => $this->uri->segment(4),
			'left_menu_select' => $left_menu_select,
			'publication' => $this->articles->prepare_list($publication),
			'product_categories' => $this->articles->prepare_list($product_categories),
			'content' => $this->articles->prepare($content)
		);
		
		//my_dump($content);
		
		$data = array_merge($this->standart_data, $data);
		$this->load->view('client/'.$template, $data);
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