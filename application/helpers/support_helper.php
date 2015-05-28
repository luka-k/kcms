<? if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function my_dump($dump)
{
	if(ENVIRONMENT == "development") var_dump($dump);
}

/**
*
*
*/
function add_log($type, $message)
{
	$file_path = FCPATH."logs/".$type.".log";
	$message = date("d/m/Y H:i:s")." - ".$message."\r\n";
	file_put_contents($file_path, $message, FILE_APPEND);
}

function get_logs_names()
{
	$logs = array();
	$dir = opendir(FCPATH."logs/");
		
	while(FALSE !== ($file = readdir($dir)))
	{
		if($file !== "." && $file !== "..")
		{
			$file_name = explode(".", $file); 
			$logs[] = $file_name[0];
		}
	}
	
	return $logs;
}

/**
*
*
*/
function get_log($type)
{	
	$file_path = FCPATH."logs/".$type.".log";
	
	$log = array();
	
	$file = fopen($file_path, "r");
	while(($log_item = fgets($file)) !== false)
	{
		$item = explode(" - ", $log_item, 2);
		$log[$item[0]] = $item[1];
	}
	
	return $log;
}

/**
*
*
*/
function clear_log($type)
{
	if($type == "all")
	{
		$logs = get_logs_names();
		if(!empty($logs))foreach($logs as $log_name)
		{
			$file_path = FCPATH."logs/".$log_name.".log";
			file_put_contents($file_path, "");
		}
	}
	else
	{
		$file_path = FCPATH."logs/".$type.".log";
		file_put_contents($file_path, "");
	}
}