<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['upload_path'] = FCPATH.'download/images';

$config['import_upload_path'] = FCPATH.'download\import';

$config['thumb_config'] = array(
	"catalog_big" => array(
		'w' => 180,
		'h' => 240,
		'far' => 1,
		"bg" => "ffffff"
	),
	"catalog_mid" => array(
		'w' => 170,
		'h' => 225,
		'far' => 1,
		"bg" => "ffffff"		
	),
	"catalog_small" => array(
		'w' => 80,
		'h' => 100,
		'far' => 1,
		"bg" => "ffffff"	
	),
	"main_slider" => array(
		'w' => 717,
		'h' => 360,
		'zc' => 1,
		'far' => 1,
		"bg" => "ffffff"	
	),
	"shop_slider" => array(
		'w' => 844,
		'h' => 360,
		'zc' => 1,
		'far' => 1,
		"bg" => "ffffff"	
	)
);

/* End of file upload_config.php */
/* Location: ./application/config/upload_config.php */