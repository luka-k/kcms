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
		
		$this->menu = $this->menus->admin_menu;
		$this->user = (array)$this->session->userdata('user');
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
				
		$this->top_menu = $this->articles->get_prepared_list($this->articles->get_site_tree(0, "parent_id"));
		foreach($this->top_menu as $key => $item)
		{
			if(isset($item->childs))
			{
				$item->childs = $this->articles->get_prepared_list($item->childs);
			}
		}
		//Костыль походу дела
		unset($this->top_menu[5]);

		$this->user_id = $this->session->userdata('user_id');
		$this->cart_items = $this->cart->get_all();
		$this->total_price = $this->cart->total_price();
		$this->total_qty = $this->cart->total_qty();
	}
}

/* End of file MY_controller.php */
/* Location: ./application/core/MY_controller.php */