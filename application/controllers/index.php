<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Static_page class
*
* @package		kcms
* @subpackage	Controllers
* @category	    Static_page
*/
class Index extends Client_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$view = $this->uri->uri_string();

		if($view == '') $view = 'index';
		
		$data = $this->standart_data;
		$user_name = explode(" ", $data['user']->name);
		$data['user']->short_name = $user_name[0].' '.mb_substr($user_name[1], 0, 1).'. '.mb_substr($user_name[2], 0, 1).'.'; // Тут есть сомнение что все прям будут полное имя указывать. и надо подумать над отображением

		$this->load->view('client/'.$view.'.php', $data);
	}
}