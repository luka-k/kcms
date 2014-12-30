<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['upload_path'] = FCPATH.'download/images';

$config['thumb_config'] = array(
	"catalog_big" => array(
		'w' => 470,
		'h' => 470,
		'zc' => 1,
		'far' => 1,
		"bg" => "ffffff"
	),
	"catalog_mid" => array(
		'w' => 225,
		'h' => 170,
		'zc' => 1,
		'far' => 1,
		"bg" => "ffffff"		
	),
	"catalog_small" => array(
		'w' => 100,
		'h' => 100,
		'zc' => 1,
		'far' => 1,
		"bg" => "ffffff"	
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