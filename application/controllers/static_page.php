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
		$page = $this->uri->uri_string();
		if($page == 'index') redirect(base_url());
		
		$data = array();
		$data = array_merge($this->standart_data, $data);
		
		if($page == 'joint-business' || $page == 'projects') $data['projects'] = $this->portfolio->prepare_list($this->portfolio->get_list(FALSE, FALSE, FALSE, 'sort', 'asc'));

		$this->load->view('client/'.$page.'.php', $data);
	}
	
}