<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//
//

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

//
//

class Client_Controller extends CI_Controller
{
	protected $top_menu;
	protected $user_id;
	protected $cart_items;
	protected $total_price;
	protected $total_qty;
	
	function __construct()
	{
		parent::__construct();
				
		$this->top_menu = $this->dynamic_menus->get_menu(1);;
		$this->user_id = $this->session->userdata('user_id');
		$this->cart_items = $this->cart->get_all();
		$this->total_price = $this->cart->total_price();
		$this->total_qty = $this->cart->total_qty();
	}
}

/* End of file MY_controller.php */
/* Location: ./application/core/MY_controller.php */