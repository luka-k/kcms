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
	
	public function import_xml()
	{
		echo '<head><meta charset="UTF-8"></head><body><pre>';
		
		$xml_content = file_get_contents(FCPATH.'/import/yml_products.xml');
		
		$xml = simplexml_load_string($xml_content);
		
		//$this->import->import_categories($xml->shop->categories);
		
		$this->import->import_offers($xml->shop->offers);
		
		echo "<a href='".base_url()."admin'>На главную</a>";
	}
}