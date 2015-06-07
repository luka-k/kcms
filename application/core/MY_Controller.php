<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Класс контроллеров
*
* @package		kcms
* @subpackage	Models
* @category	    Articles
*/
class Admin_Controller extends CI_Controller 
{
	protected $standart_data = array();

	public function __construct()
	{
		parent::__construct();
				
		$is_logged = $this->session->userdata('logged_in');
		$user_groups = (array)$this->session->userdata('user_groups');
		
		if ((!$is_logged)||(!in_array("admin", $user_groups))) die(redirect(base_url().'admin/registration/login'));
		
		$this->standart_data = array(
			'error' => "",
			'url' => $this->uri->uri_string(),
			"menu" => $this->dynamic_menus->get_menu(1)->items,
			"user" => (array)$this->session->userdata('user'),
			"user_groups" => $user_groups
		);
		
		if(!$this->users_groups->access_by_manufacturer($this->standart_data['user'])) die(redirect(base_url().'admin/content/access_disabled'));
		
		$this->load->helper('admin');
	}
}

/**
* Класс контроллеров
*
* @package		kcms
* @subpackage	Models
* @category	    Articles
*/
class Client_Controller extends CI_Controller
{
	protected $standart_data = array();

	function __construct()
	{
		parent::__construct();
				
		$settings = $this->settings->get_item_by(array("id" => 1));
		$settings->site_description = htmlspecialchars_decode($settings->site_description);
		
		$this->standart_data = array(
			'meta_keywords' => $settings->site_keywords,
			'meta_description' => $settings->site_description,
			"user" => $this->session->userdata('user'),
			"cart_items" => $this->cart->get_all(),
			"total_price" => $this->cart->total_price(),
			"total_qty" => $this->cart->total_qty(),
			'product_word' => $this->string_edit->set_word_form("товар", $this->cart->total_qty()),
			"top_menu" => $this->dynamic_menus->get_menu(4)->items,
			'settings' => $settings
		);
	}
}

/* End of file MY_controller.php */
/* Location: ./application/core/MY_controller.php */