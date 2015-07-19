<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Partneri class
*
* @package		kcms
* @subpackage	Controllers
* @category	    Partneri
*/
class Partneri extends Client_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$this->breadcrumbs->add('partneri', 'Партнеры');
		
		$data = array(
			"title" => 'Партнеры',
			'keywords' => '',
			'description' => '',
			'top_menu' => $this->dynamic_menus->get_menu(3)->items,
			"select_item" => 'partneri',
			'breadcrumbs' => $this->breadcrumbs->get(),
			'partners' => $this->partners->prepare_list($this->partners->get_list(FALSE))
		);
		$data = array_merge($this->standart_data, $data);
		$this->load->view('client/partners.php', $data);
	}
}