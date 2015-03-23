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
		
		
		/**********************************************************
		* мысль ридумать что то подобное зрела уже давно.
		* в частности очень не удобно что нельзя назвать контроллер по имени таблицы, потому что так названа модель.
		* что предлагаю. все модели именовать с суффиксом _model 
		* что бы автоматизировать процесс подключения моделей я сделал конфиг model
		* соответственно в нем содержаться все модели которые надо подгрузить автоматом
		* что бы не перепиливать весь код и в дальнейшем обращатся к моделям без суффикса
		* я подключаю их ниже через короткое имя
		* а вообще мне кажется в дальнейшем надо убрать из автозагрузки те модели которые используются не везде.
		* например модели характеристик нужны только товарам. модели рассылок и тд. их можно подключать только в соответсвтующих контроллерах
		**********************************************************/
		$this->config->load("model");
		$autoload = $this->config->item("autoload");
		
		foreach($autoload as $item)
		{
			$short_name = str_replace(array("db/", "_model"), "", $item);
			$this->load->model($item, $short_name);
		}
		
		$this->menu = $this->dynamic_menus->get_menu(1)->items;
		$this->user = (array)$this->session->userdata('user');
		
		$this->load->helper('admin');
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
		
		$this->config->load("model");
		$autoload = $this->config->item("autoload");
		
		foreach($autoload as $item)
		{
			$short_name = str_replace(array("db/", "_model"), "", $item);
			$this->load->model($item, $short_name);
		}
				
		$settings = $this->settings->get_item_by(array("id" => 1));
		
		
		$this->standart_data = array(
			'meta_title' => $settings->site_title,
			'meta_keywords' => $settings->site_keywords,
			'meta_description' => $settings->site_description,
			"user" => $this->session->userdata('user'),
			"cart_items" => $this->cart->get_all(),
			"total_price" => $this->cart->total_price(),
			"total_qty" => $this->cart->total_qty(),
			'product_word' => $this->string_edit->set_word_form("товар", $this->cart->total_qty()),
			'top_menu' => $this->menus->set_active($this->menus->top_menu, 'main'),
		);
	}
}

/* End of file MY_controller.php */
/* Location: ./application/core/MY_controller.php */