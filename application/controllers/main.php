<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Главная страница

class Main extends CI_Controller {

	public $menu = array();
	public function __construct()
	{
		parent::__construct();
		$this->menu = array(
			"0" => array("Главная", base_url(), "1"),
			"1" => array("Новости", base_url()."news", "0"),
			"2" => array("Каталог", base_url()."catalog", "0"),
			"3" => array("Блог", base_url()."blog", "0"),
		);
	}
	
	public function index()
	{		
		$settings = $this->settings->get_item_by(array('id' => 1));
		$data = array(
			'title' => $settings->site_title,
			'meta_title' => $settings->site_title,
			'keywords' => $settings->site_keywords,
			'description' => $settings->site_description,
			'menu' => $this->menu
		);
		//$data['page'] = $this->pages->get_item_by(array('url'=>$url));
		//$data['menu'] = $this->menu_model->menu('top_menu');
		$this->load->view('client/main.php', $data);
	}	
}

/* End of file main.php */
/* Location: ./application/controllers/main.php */