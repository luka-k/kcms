<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['images_upload_path'] = FCPATH.'download/images';
$config['files_upload_path'] = FCPATH.'download/files';

$config['thumb_config'] = array(
	"catalog_big" => array(
		'w' => 1100,
		'h' => 1100,
		'fltr' => "wmi|images/logo.png|BR|75|90|40|",
		'far' => 1,
		"bg" => "ffffff"
	),
	"catalog_mid" => array(
		'w' => 225,
		'h' => 170,
		'far' => 1,
		"bg" => "ffffff"		
	),
	"catalog_small" => array(
		'w' => 150,
		'h' => 150,
		'far' => 1,
		"bg" => "ffffff"	
	),
	"document_main" => array(
		'w' => 168,
		'h' => 235,
		'far' => 1,
		"bg" => "ffffff"	
	),
	"product_small" => array(
		'w' => 222,
		'h' => 222,
		'far' => 1,
		"bg" => "ffffff"	
	),
	"manufacturer" => array(
		'w' => 162,
		'h' => 72,
		'far' => 1,
		"bg" => "ffffff"	
	),
	"small_map" => array(
		'w' => 300,
		'h' => 150,
		'far' => 1,
		'zc' => 1,
		"bg" => "ffffff"	
	)
);

/* End of file upload.php */
/* Location: ./application/config/upload.php */