<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['images_upload_path'] = FCPATH.'download/images';
$config['files_upload_path'] = FCPATH.'download/files';

$config['thumb_config'] = array(
	"catalog_big" => array(
		'w' => 470,
		'h' => 470,
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
		'w' => 100,
		'h' => 100,
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