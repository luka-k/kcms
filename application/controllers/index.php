<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//main page controller

class Index extends Client_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{		
		$settings = $this->settings->get_item_by(array('id' => 1));
		
		//$left_menu = $this->dynamic_menus->get_menu(4);
		
		$data = array(
			'title' => $settings->site_title,
			'tree' => $this->categories->get_site_tree(0, "parent_id"),
			'url' => $this->uri->segment_array()
			//'left_menu' => $left_menu
		);
		$data = array_merge($this->standart_data, $data);

		$this->load->view('client/index', $data);
	}	
}

/* End of file index.php */
/* Location: ./application/controllers/index.php */