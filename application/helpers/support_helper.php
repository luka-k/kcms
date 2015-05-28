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
	$file_path = FCPATH."logs/logs-".date("d-m-Y").".log";
	$message = date("H:i:s")." - ".$type." - ".$message."\r\n";
	file_put_contents($file_path, $message, FILE_APPEND);
}

/**
*
*
*/
function get_log()
{	
	$file_path = FCPATH."logs/logs-".date("d-m-Y").".log";
	
	$log = array();
	if(file_exists($file_path))
	{
		$file = fopen($file_path, "r");
		while(($log_item = fgets($file)) !== false)
		{
			$log[] = explode(" - ", $log_item, 3);
		}
	}
	return $log;
}

/**
*
*
*/
function clear_log()
{
	$file_path = FCPATH."logs/logs-".date("d-m-Y").".log";
	file_put_contents($file_path, "");

}