<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* File_cashe class
* 
* @package		kcms
* @subpackage	Libraries
* @category	    File_cashe
*/
class CI_File_cache {
	
	var $CI;
	
	public function __construct()
	{
		$this->CI =& get_instance();
	}
		
	public function insert($cache_id, $data)
	{
		$cache_info = serialize($data);
		
		$file_name = $cache_id.".cache";
		$file_path = FCPATH."cache/".$file_name;
		$file = fopen($file_path, "w");
		ftruncate($file, 0);
		fwrite($file, $cache_info);
		
		fclose($file);
	}
	
	public function get($cache_id)
	{
		$file_name = $cache_id.".cache";
		$file_path = FCPATH."cache/".$file_name;
		if(file_exists($file_path))
		{
			$file = fopen($file_path, "r");
			$cache_info = fread($file, filesize($file_path)); 
			fclose($file);
			
			return unserialize($cache_info);
		}
		else
		{
			return FALSE;
		}
		
		
	}	
}