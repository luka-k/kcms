<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['upload_path'] = FCPATH.'download/images';

$config['thumb_config'] = array(
	"slider" => array(
		'w' => 640,
		'h' => 350,
		"zc" => "с",
		"bg" => "ffffff"
	),
	"news" => array(
		'w' => 150,
		'h' => 150,
		"zc" => "с",
		"bg" => "ffffff"	
	),
	"lead" => array(
		'w' => 70,
		'h' => 83,
		"zc" => "l",
		"bg" => "ffffff"	
	)
);

/* End of file upload_config.php */
/* Location: ./application/config/upload_config.php */