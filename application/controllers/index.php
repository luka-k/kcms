<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Index class
*
* @package		kcms
* @subpackage	Controllers
* @category	    Index
*/
class Index extends Client_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{		
		$this->config->load('articles');
		$last_news = $this->articles->get_list(array("parent_id" => $this->config->item('news_id')), 3, 0, 'date', 'desc');
		$last_events = $this->articles->get_list(array("parent_id" => $this->config->item('events_id')), 3, 0, 'date', 'desc');

		$data = array(
			'title' => $this->standart_data['settings']->site_title,
			'keywords' => '',
			'description' => '',
			'top_menu' => $this->dynamic_menus->get_menu(3)->items,
			'select_item' => '',
			'slider' => $this->sliders->prepare_list($this->sliders->get_list(array('type' => 0), FALSE, FALSE, "sort", "asc")),
			'last_news' => $this->articles->prepare_list($last_news),
			'last_events' => $this->articles->prepare_list($last_events)
		);
		$data = array_merge($this->standart_data, $data);
		$this->load->view('client/main.php', $data);
	}	
}

/* End of file Index.php */
/* Location: ./application/controllers/Index.php */