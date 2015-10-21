<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Log extends CI_Log {

	var $CI;
	
	public function __construct()
	{
		$this->CI =& get_instance();
	}
	
	public function sql_log($type, $time = FALSE)
	{	
		$file_path = FCPATH."logs/log-".date("dmYH").".log";
		
		$message = $type;
		if($time) $message .= ' - '.$time;
		$message .= "\r\n";
		file_put_contents($file_path, $message, FILE_APPEND);
		
		$last_query = $this->CI->db->last_query();
		
		$message = '"'.$last_query.'"'."\r\n\r\n";

		file_put_contents($file_path, $message, FILE_APPEND);
	}
	
	public function put_elapsed_time($message, $time)
	{
		$file_path = FCPATH."logs/sql_logs-".date("dmYH").".log";

		$string = $time." - ".$message."\r\n\r\n";
		
		file_put_contents($file_path, $string, FILE_APPEND);
	}
}