<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['upload_path'] = FCPATH.'download/images';

$config['thumb_config'] = array(
	"catalog_big" => array(
		'w' => 268,
		'h' => 408
	),
	"catalog_mid" => array(
		'w' => 140,
		'h' => 212,
	),
	"catalog_small" => array(
		'w' => 90,
		'h' => 136
	),
	"slider" => array(
		'w' => 1600,
		'h' => 352,
		'zc' => 1,
		'far' => 1,
		"bg" => "ffffff"	
	)
);

/* End of file upload_config.php */
/* Location: ./application/config/upload_config.php */