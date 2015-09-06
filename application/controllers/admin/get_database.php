<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Get_database extends CI_Controller 
{

	public function __construct()
	{
		parent::__construct();
	}
	
	public function index($school_id)
	{			
		$file_path = FCPATH."export/export_{$school_id}.sqlite";

		$modified_time = filemtime($file_path);
		$modified_time_str = gmdate('D, d M Y H:i:s', $modified_time).' GMT';

		if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) && strtotime($_SERVER['HTTP_IF_MODIFIED_SINCE']) >= $modified_time)	
		{
			header('HTTP/1.1 304 Not Modified');
			header('Last-Modified: '.$modified_time_str);
			
			exit();
		}

		header('Last-Modified: '.$modified_time_str);
		echo file_get_contents($file_path);
	}
	
	public function test(){
		//$header = array('If-Modified-Since: '.date('D, d M Y H:i:s').' GMT');
		$header = array('If-Modified-Since: Mon, 26 Jul 1997 00:00:00 GMT');
		
		if($curl = curl_init(base_url().'admin/get_database/shkola-1')) 
		{
			curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
			$out = curl_exec($curl);
			echo $out;
			curl_close($curl);
		}

	}
}