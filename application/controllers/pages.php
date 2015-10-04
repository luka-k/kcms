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
		
		$this->config->load('articles');
		
		$under_menu = new stdClass();
		$level_2 = $this->articles->get_item_by(array("url" => $this->uri->segment(2)));
		if($level_2)
			$under_menu = $this->articles->get_list(array("parent_id" => $level_2->id), FALSE, FALSE, 'sort', 'asc');
		
		$left_menu_select = '';
		$level_3 = $this->articles->get_item_by(array('url' => $this->uri->segment(4)));
		$left_menu = $this->articles->get_list(array("parent_id" => $level_3->id), FALSE, FALSE, 'sort', 'asc');
		if($this->uri->segment(5)) $left_menu_select = $this->uri->segment(5);
		
		if($content->articles) 
		{
			$content->articles = $this->articles->prepare_list($content->articles);
			$left_menu_select = $content->articles[0]->url;
		}
		
		$template = 'articles'; //не забыть убрать если в дальнейшем не понадобиться
		if(!empty($content->template)) $template = $content->template; //не забыть убрать если в дальнейшем не понадобиться
		
		$publications = $this->articles->get_list(array("parent_id" => $this->config->item('publication_id')), 0, 6);
		$product_categories = $this->articles->get_list(array("parent_id" => $this->config->item('assortment_id')), FALSE, FALSE, 'sort', 'asc');
		
		$data = array(
			'title' => $content->name,
			'meta_keywords' => $content->meta_keywords,
			'meta_description' => $content->meta_description,
			'breadcrumbs' => $this->breadcrumbs->get(),
			'under_menu' => $this->articles->prepare_list($under_menu),
			'left_menu' => $this->articles->prepare_list($left_menu),
			'select_item' => "",
			'under_menu_select' => $this->uri->segment(2),
			'product_select' => $this->uri->segment(4),
			'left_menu_select' => $left_menu_select,
			'publications' => $this->articles->prepare_list($publications),
			'product_categories' => $this->articles->prepare_list($product_categories),
			'content' => $this->articles->prepare($content)
		);
		
		$company = $this->articles->get_item($this->config->item('company_id'));
		if($company->url == $this->uri->segment(2)) $data['no_public'] = TRUE;

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