<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Admin main page
*
* @package		kcms
* @subpackage	controllers
* @category	    index
*/
class Index extends Admin_Controller 
{

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{		
		$data = array(
			'title' => "Главная",
			'error' => "",
			'url' => $this->uri->uri_string()
		);
		$data = array_merge($this->standart_data, $data);

		$this->load->view('admin/admin', $data);
	}
}