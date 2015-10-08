<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Import_module
*
* @package		kcms
* @subpackage	controllers
* @category	    import_module
*/
class Import_module extends Admin_Controller 
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('import');
	}
	
	public function import_1c()
	{
		echo '<head><meta charset="UTF-8"></head><body><pre>';
		
		$xmlstr = file_get_contents('import/1c.xml');
		
		$this->import->import_from_1c($xmlstr);
		
		echo "<a href='".base_url()."admin'>На главную</a>";
	}
}