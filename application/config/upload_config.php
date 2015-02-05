<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['upload_path'] = FCPATH.'download/images';

$config['thumb_config'] = array(
	"catalog_big" => array(
		'w' => 624,
		'h' => 466,
		'wp' => 624,
		'hp' => 466,
		"zc" => "l",
		"bg" => "ffffff"
	),
	"catalog_mid" => array(
		'w' => 130,
		'h' => 110,
		'wp' => 130,
		'hp' => 110,
		"zc" => "l",
		"bg" => "ffffff"	
	),
	"catalog_small" => array(
		'w' => 110,
		'h' => 80,
		'wp' => 110,
		'hp' => 80,
		"zc" => "l",
		"bg" => "ffffff"	
	),
	"categories" => array(
		'w' => 136,
		'h' => 134,
		'wp' => 136,
		'hp' => 134,
		"bg" => "ffffff"	
	)
);

/* End of file upload_config.php */
/* Location: ./application/config/upload_config.php */