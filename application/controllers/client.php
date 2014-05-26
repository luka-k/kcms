<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Client class

class Client extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url', 'translit', 'upload'));
	}
	
	public function index($url = false)
	{
		$data = $this->pages->get_item_by(array('url'=>$url));
		$this->load->view('client/template.php', $data);
	}
	
	public function category($url = false)
	{
		$page = $this->categories->get_item_by(array('url'=>$url));
		var_dump ($page);
		$data = array(
			'page' => $page
		);
	}
	
}

/* End of file pages.php */
/* Location: ./application/controllers/pages.php */