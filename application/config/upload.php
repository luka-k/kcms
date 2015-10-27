<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['images_upload_path'] = FCPATH.'download/images';
$config['files_upload_path'] = FCPATH.'download/files';

$config['thumb_config'] = array(
	'admin' => array(
		'q' => 95,
		'w' => 150,
		'h' => 150,
		'far' => 1,
		"bg" => "ffffff"
	),
	"catalog_big" => array(
		'q' => 95,
		'w' => 1100,
		'h' => 1100,
		'fltr' => "wmi|images/logo.png|BR|75|90|40|",
		"bg" => "ffffff"
	),
	"catalog_mid" => array(
		'q' => 95,
		'w' => 225,
		'h' => 170,
		"bg" => "ffffff"		
	),
	"catalog_small" => array(
		'q' => 95,
		'w' => 150,
		'h' => 150,
		"bg" => "ffffff"	
	),
	"document_main" => array(
		'q' => 95,
		'w' => 170,
		'h' => 237,
		'far' => 'C',
		"bg" => "ffffff"	
	),
	"product_small" => array(
		'q' => 95,
		'w' => 222,
		'h' => 222,
		"bg" => "ffffff"	
	),
	"manufacturer" => array(
		'q' => 95,
		'w' => 162,
		'h' => 72,
		/*'zc' => '1',*/
		'far' => 'C',
		"bg" => "ffffff"	
	),
	"small_map" => array(
		'q' => 95,
		'w' => 300,
		'h' => 150,
		'zc' => 1,
		"bg" => "ffffff"	
	)
);

/* End of file upload.php */
/* Location: ./application/config/upload.php */