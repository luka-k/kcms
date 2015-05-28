<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Logs page
*
* @package		kcms
* @subpackage	controllers
* @category	    Logs
*/
class Logs extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		
		$data = array(
			'title' => "Логи",
			'log_items' => get_log()
		);
		
		$data = array_merge($this->standart_data, $data);
	
		$this->load->view('admin/logs.php', $data);
	}
	
	public function clear()
	{
		clear_log();
		redirect(base_url()."admin/logs");
	}
}