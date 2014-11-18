<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Главная страница

class Main extends Client_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{		
		$settings = $this->settings->get_item_by(array('id' => 1));
		
		$left_menu = $this->dynamic_menus->get_menu(4);
		
		$data = array(
			'title' => $settings->site_title,
			'meta_title' => $settings->site_title,
			'meta_keywords' => $settings->site_keywords,
			'meta_description' => $settings->site_description,
			'top_menu' => $this->menus->set_active($this->top_menu, 'main'),
			'left_menu' => $left_menu
		);
		$this->load->view('client/main.php', $data);
	}	
}

/* End of file main.php */
/* Location: ./application/controllers/main.php */