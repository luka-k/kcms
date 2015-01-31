<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Base admin class

class Index extends Admin_Controller 
{

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{		
		$this->menu = $this->menus->set_active($this->menu, 'main');

		$data = array(
			'title' => "Главная",
			'meta_title' => "Главная",
			'error' => "",
			'user' => $this->user,
			'menu' => $this->menu
		);
		
		$this->load->view('admin/admin.php', $data);
	}
}