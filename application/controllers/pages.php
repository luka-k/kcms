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
		
		if($content == FALSE) redirect(base_url().'pages/page_404');
		
		$root = $this->articles->get_item_by(array('url' => $this->uri->segment(2)));
		
		if(isset($content->article))
		{
			$sub_template = 'single';
		}		
		elseif(isset($content->articles))
		{
			$sub_template = 'list';
								
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
			
			$content->articles = $this->articles->prepare_list($content->articles);
		}
		
		$last_news = $this->articles->get_list(array("parent_id" => $this->config->item('news_id')), 3, 0, 'date', 'desc');
	
		$data = array(
			'title' => $content->name,
			'keywords' => $content->meta_keywords,
			'description' => $content->meta_description,
			'top_menu' => $this->dynamic_menus->get_menu(3)->items,
			'select_item' => "",
			'filters' => $this->characteristics_type->get_filters(),
			'max_price' => $this->products->get_max('price'),
			'min_price' => $this->products->get_min('price'),
			'last_news' => $this->articles->prepare_list($last_news),
			'slider' => $this->sliders->prepare_list($this->sliders->get_list(array('type' => 1), FALSE, FALSE, "sort", "asc")),
			'breadcrumbs' => $this->breadcrumbs->get(),
			'content' => $content,
			'sub_template' => $sub_template
		);
		
		if($root->id == $this->config->item('news_id')) $data['is_news'] = TRUE;

		$data = array_merge($this->standart_data, $data);
		$this->load->view('client/news.php', $data);
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