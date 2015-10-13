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
			"user" => (array)$this->session->userdata('user')
		);
		
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
		
		define('TMP_PATH', base_url().'template/client/');
		define('IMGS_PATH', base_url().'template/client/images/');
		
		$settings = $this->settings->get_settings();
		
		$phone = $settings['phone']->string_value;
		
		$settings['phone']->span_value = substr($phone, 0, 2).'('.substr($phone, 2, 3).')'.'<span>'.substr($phone, 5, 3).'-'.substr($phone, 8, 2).'-'.substr($phone, 10, 2).'</span>';
		$settings['phone']->modal_value	= substr($phone, 1, 1).'-'.substr($phone, 2, 3).'-'.substr($phone, 5, 3).'-'.substr($phone, 8, 2).'-'.substr($phone, 10, 2);
		
		$phone_saratov = $settings['phone_saratov']->string_value;
		$settings['phone_saratov']->span_value = substr($phone_saratov, 0, 2).'('.substr($phone_saratov, 2, 3).')'.'<span>'.substr($phone_saratov, 5, 3).'-'.substr($phone_saratov, 8, 2).'-'.substr($phone_saratov, 10, 2).'</span>';
		
		$phone_volsk = $settings['phone_volsk']->string_value;
		$settings['phone_volsk']->span_value = substr($phone_volsk, 0, 2).'('.substr($phone_volsk, 2, 3).')'.'<span>'.substr($phone_volsk, 5, 3).'-'.substr($phone_volsk, 8, 2).'-'.substr($phone_volsk, 10, 2).'</span>';
		
		$this->standart_data = array(
			"user" => $this->session->userdata('user'),
			"cart_items" => $this->cart->get_all(),
			"total_price" => $this->cart->total_price(),
			"total_qty" => $this->cart->total_qty(),
			'product_word' => $this->string_edit->set_word_form("товар", $this->cart->total_qty()),
			"top_menu" => $this->dynamic_menus->get_menu(5)->items,
			'settings' => $settings
		);
	}
}

/* End of file MY_controller.php */
/* Location: ./application/core/MY_controller.php */