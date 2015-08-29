<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Static_page class
*
* @package		kcms
* @subpackage	Controllers
* @category	    Static_page
*/
class Static_page extends Client_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$url = $this->uri->uri_string();
		if($url == 'index') redirect(base_url());
		
		$this->config->load('static_page');
		$urls_to_views = $this->config->item('urls_to_views');
		
		$data = array();
		$data = array_merge($this->standart_data, $data);
		
		if($url == 'sovmestnyj_biznes' || $url == 'nashi_proekty') $data['projects'] = $this->portfolio->prepare_list($this->portfolio->get_list(FALSE, FALSE, FALSE, 'sort', 'asc'));
		
		if(!isset($urls_to_views[$url])) redirect(base_url()."pages/page_404");
		$view = $urls_to_views[$url];

		$this->load->view('client/'.$view.'.php', $data);
	}
}