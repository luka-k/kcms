<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['upload_path'] = FCPATH.'download/images';
$config['files_upload_path'] = FCPATH.'download/files';

$config['thumb_config'] = array(
	"documents" => array(
		'w' => 240,
		'h' => 290,
		'far' => 1,
		"bg" => "ffffff"
	),
	"articles" => array(
		'w' => 121,
		'h' => 120,
		'far' => 1,
		"bg" => "ffffff"
	),
	"about" => array(
		'w' => 120,
		'h' => 160,
		'far' => 1,
		"bg" => "ffffff"
	),
	"testimonials" => array(
		'w' => 95,
		'h' => 95,
		'far' => 1,
		"bg" => "ffffff"
	),
	"catalog_small" => array(
		'w' => 100,
		'h' => 100,
		'far' => 1,
		"bg" => "ffffff"	
	)
);

/* End of file upload_config.php */
/* Location: ./application/config/upload_config.php */