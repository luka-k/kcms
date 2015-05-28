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
		$logs = get_logs_names();
		
		$data = array(
			'title' => "Логи",
			'logs' => $logs
		);
		
		if($logs)
		{
			$log_type = $this->input->get("log_type");
			if($log_type == FALSE) $log_type = $logs[0];
			
			$data['log_items'] = get_log($log_type);
			$data['viewed_log'] = $log_type;		
			
		}
		$data = array_merge($this->standart_data, $data);
	
		$this->load->view('admin/logs.php', $data);
	}
	
	public function clear($type = "all")
	{
		if($type == "all")
		{
			$logs = get_logs_names();
			if(!empty($logs))foreach($logs as $log_name)
			{
				clear_log($log_name);
			}
		}
		else
		{
			clear_log($type);
		}
		redirect(base_url()."admin/logs");
	}
}