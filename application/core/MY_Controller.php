<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Base admin class

class Admin_Controller extends CI_Controller 
{
	protected $menu;
	protected $user_name;
	protected $user_id;

	public function __construct()
	{
		parent::__construct();
		
		$user = $this->session->userdata('logged_in');
		$role = $this->session->userdata('role');

		if ((!$user)||($role <> "admin")) die(redirect(base_url().'registration/admin_enter'));	
		
		$this->menu = $this->menus->admin_menu;
		$this->user_name = $this->session->userdata('user_name');
		$this->user_id = $this->session->userdata('user_id');
		
		$this->config->load('emails_config');
	}
}