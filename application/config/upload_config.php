<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['upload_path'] = FCPATH.'download/images';

$config['thumb_config'] = array(
	"catalog_big" => array(
		'w' => 640,
		'h' => 640,
		'wp' => 640,
		'hp' => 640,
		"zc" => "0",
		"bg" => "ffffff"
	),
	"catalog_mid" => array(
		'w' => 360,
		'h' => 360,
		'wp' => 360,
		'hp' => 360,
		"far" => "C",
		"bg" => "ffffff"	
	),
	"catalog_small" => array(
		'w' => 120,
		'h' => 120,
		'wp' => 120,
		'hp' => 120,
		"zc" => "0",
		"bg" => "ffffff"	
	)
);

/* End of file upload_config.php */
/* Location: ./application/config/upload_config.php */