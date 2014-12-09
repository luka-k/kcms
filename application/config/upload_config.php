<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['upload_path'] = FCPATH.'download/images';

$config['thumb_config'] = array(
	"slider" => array(
		'w' => 640,
		'h' => 350,
		'far' => 1,
		"bg" => "ffffff"
	),
	"news" => array(
		'w' => 150,
		'h' => 150,
		'far' => 1,
		"bg" => "ffffff"	
	),
	"lead" => array(
		'w' => 70,
		'h' => 83,
		'far' => 1,
		"bg" => "ffffff"	
	)
);

/* End of file upload_config.php */
/* Location: ./application/config/upload_config.php */