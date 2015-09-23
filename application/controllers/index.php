<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Static_page class
*
* @package		kcms
* @subpackage	Controllers
* @category	    Static_page
*/
class Index extends Client_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$view = $this->uri->uri_string();

		if($view == '') $view = 'index';
		
		
		//$this->config->load('static_page');
		//$urls_to_views = $this->config->item('urls_to_views');
		
		//$data = array();
		//$data = array_merge($this->standart_data, $data);
		$data = $this->standart_data;

		$this->load->view('client/'.$view.'.php', $data);
	}
}