<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* import_module class
*
* @package		kcms
* @subpackage	Controllers
* @category	    import_module
*/
class Import_module extends Admin_Controller 
{

	public function __construct()
	{
		parent::__construct();
		
		$this->load->library('import');
	}
	
	public function index()
	{
		$this->load->config('import');
		$data = array(
			'title' => "Импорт",
			'url' => $this->uri->uri_string(),
			'publishers' => $this->config->item('publishers')
		);	
		
		$data = array_merge($this->standart_data, $data);
	
		$this->load->view('admin/import.php', $data);
	}
	
	public function inport_hueber()
	{
		
	}
}