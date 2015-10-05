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
		
		$settings = $this->settings->get_item(1);

		$content = $this->articles->prepare($content);
		
		$this->config->load('articles');
		
		$under_menu = new stdClass();
		$level_2 = $this->articles->get_item_by(array("url" => $this->uri->segment(2)));
		if($level_2)
			$under_menu = $this->articles->get_list(array("parent_id" => $level_2->id), FALSE, FALSE, 'sort', 'asc');
		
		if($this->uri->segment(3))
		{
			$level_3 = $this->articles->get_item_by(array('url' => $this->uri->segment(3)));
			$categories = $this->articles->get_list(array("parent_id" => $level_3->id), FALSE, FALSE, 'sort', 'asc');
			$categories = $this->articles->prepare_list($categories);

			if($level_3->id == $this->config->item('publication_id'))
			{
				$all_public = new stdClass();
				$all_public->full_url = $this->articles->prepare($this->articles->get_item($this->config->item('publication_id')))->full_url.'/all';
				$all_public->url = 'all';
				$all_public->menu_name = 'Все материалы';
				$categories = array_merge(array(0 => $all_public), $categories);
			}
		}
		else
		{
			$categories = $this->articles->get_list(array("parent_id" => $this->config->item('assortment_id')), FALSE, FALSE, 'sort', 'asc');
			$categories = $this->articles->prepare_list($categories);
		}
		
		$left_menu_select = '';
		$left_menu = array();
		if($this->uri->segment(4) && $this->uri->segment(4) != 'all')
		{
			$level_4 = $this->articles->get_item_by(array('url' => $this->uri->segment(4)));
			$left_menu = $this->articles->get_list(array("parent_id" => $level_4->id), FALSE, FALSE, 'sort', 'asc');
			if($this->uri->segment(5)) $left_menu_select = $this->uri->segment(5);
		}
		
		if($content->articles) 
		{
			$content->articles = $this->articles->prepare_list($content->articles);
			$left_menu_select = $content->articles[0]->url;
		}
		
		$template = 'articles'; //не забыть убрать если в дальнейшем не понадобиться
		if(!empty($content->template)) $template = $content->template; //не забыть убрать если в дальнейшем не понадобиться
		
		$publications = $this->articles->get_all_publication($this->config->item('publication_id'), 0, 6);
		
		$data = array(
			'title' => $content->name,
			'meta_keywords' => $content->meta_keywords,
			'meta_description' => $content->meta_description,
			'breadcrumbs' => $this->breadcrumbs->get(),
			'under_menu' => $this->articles->prepare_list($under_menu),
			'left_menu' => $this->articles->prepare_list($left_menu),
			'select_item' => "",
			'under_menu_select' => $this->uri->segment(2),
			'category_select' => $this->uri->segment(4),
			'left_menu_select' => $left_menu_select,
			'publications' => $this->articles->prepare_list($publications),
			'categories' => $categories,
			'content' => $content
		);
		
		$company = $this->articles->get_item($this->config->item('company_id'));
		
		if($content->id == $this->config->item('publication_id') || (isset($content->parent) && $content->parent->id == $this->config->item('publication_id')))
		{
			$data['no_public'] = TRUE;
			
			
			
			if($this->uri->segment($this->uri->total_segments()) == 'all' || $content->id == $this->config->item('publication_id'))
			{
				$content->articles = $this->articles->get_all_publication($content->id, $this->input->get('from'), $settings->per_page, 'date', 'asc');
				$total_rows = count($this->articles->get_all_publication($content->id));
			}
			else
			{
				$content->articles = $this->articles->get_list(array('parent_id' => $content->id), $this->input->get('from'), $settings->per_page, 'date', 'asc');
				$total_rows = count($this->articles->get_list(array('parent_id' => $content->id)));
			}

			if($content->articles) foreach($content->articles as $key => $article)
			{
				$content->articles[$key]->parent_name = $this->articles->get_item($article->parent_id)->name;
			}
			
			$data['content']->articles = $this->articles->prepare_list($content->articles);

			$config['base_url'] = base_url().uri_string().'?'.get_filter_string($_SERVER['QUERY_STRING']);
			$config['total_rows'] = $total_rows;
			$config['per_page'] = $settings->per_page;

			$this->pagination->initialize($config);

			$data['pagination'] = $this->pagination->create_links();
		}
		
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