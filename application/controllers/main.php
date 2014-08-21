<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Главная страница

class Main extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{		
		$settings = $this->settings->get_item_by(array('id' => 1));
		$menu = $this->menus->top_menu;
		$menu = $this->menus->set_active($menu, 'main');
		$data = array(
			'title' => $settings->site_title,
			'meta_title' => $settings->site_title,
			'meta_keywords' => $settings->site_keywords,
			'meta_description' => $settings->site_description,
			'menu' => $menu,
			'reviews' => $this->reviews->get_list(FALSE),
			'works' => $this->works->get_list(FALSE),
			'partners' => $this->partners->get_list(FALSE)
		);
		//var_dump($data['reviews']);
		$this->load->view('client/index.php', $data);
	}	
}

/* End of file main.php */
/* Location: ./application/controllers/main.php */