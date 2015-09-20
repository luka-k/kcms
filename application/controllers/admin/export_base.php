<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Export base
*
* @package		kcms
* @subpackage	controllers
* @category	    export
*/
class Export_base extends Admin_Controller 
{

	public function __construct()
	{
		parent::__construct();
	}
	
	public function do_export()
	{
		$this->load->library('export');
		$this->load->config('export');
		
		$tables = $this->config->item('export_tables');
		
		$schools = $this->schools->get_list(FALSE);
		
		//$this->benchmark->mark('code_start');
				
		if($schools) foreach($schools as $sch)
		{
			$this->export->export_school($sch, $tables);
		}
		//$this->benchmark->mark('code_end');
		//echo $this->benchmark->elapsed_time('code_start', 'code_end');
	}
}