<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Client class

class Client extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url', 'translit', 'upload'));
		$this->load->model('client_model');
		$this->load->model('temp_model');
		$this->load->model('menu_model');
	}
	
	public function index($url = false)
	{
		$page = $this->client_model->get_page($url);
		$data = array(
			'id' => $page['id'],
			'meta_title' => $page['meta_title'],
			'title' => $page['title'],
			'full_text' => $page['full_text'],
		);

		$temp[] = 'template.php';
		$this->temp_model->view_temp($temp, $data, 'client');
	}
	
	public function category($url = false)
	{
		$page = $this->client_model->get_category($url);
		var_dump ($page);
		
		$data = array(
			'page' => $page
		);
	}
	
}

/* End of file pages.php */
/* Location: ./application/controllers/pages.php */