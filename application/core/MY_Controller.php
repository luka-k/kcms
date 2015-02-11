<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//
//
class Admin_Controller extends CI_Controller 
{
	protected $menu;
	protected $user;

	public function __construct()
	{
		parent::__construct();
		
		$is_logged = $this->session->userdata('logged_in');
		$user_groups = (array)$this->session->userdata('user_groups');
		
		if ((!$is_logged)||(!in_array("admin", $user_groups))) die(redirect(base_url().'admin/registration/login'));	
		
		$this->menu = $this->dynamic_menus->get_menu(1)->items;

		$this->user = (array)$this->session->userdata('user');
	}
}

//
//

class Client_Controller extends CI_Controller
{
	protected $standart_data = array();

	function __construct()
	{
		parent::__construct();
				
		$settings = $this->settings->get_item_by(array("id" => 1));
		
		
		$this->standart_data = array(
			'meta_title' => $settings->site_title,
			'meta_keywords' => $settings->site_keywords,
			'meta_description' => $settings->site_description,
			"user" => $this->session->userdata('user'),
			"cart_items" => $this->cart->get_all(),
			"total_price" => $this->cart->total_price(),
			"total_qty" => $this->cart->total_qty(),
			'product_word' => end_maker("товар", $this->cart->total_qty()),
			'top_menu' => $this->menus->set_active($this->menus->top_menu, 'main'),
		);
	}
}

/* End of file MY_controller.php */
/* Location: ./application/core/MY_controller.php */