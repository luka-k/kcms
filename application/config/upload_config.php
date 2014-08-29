<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['upload_path'] = FCPATH.'download/images';

$config['thumb_config'] = array(
	"catalog_big" => array(
		'w' => 640,
		'h' => 320,
		"bg" => "ffffff"
	),
	"catalog_mid" => array(
		'w' => 308,
		'h' => 155,
		"zc" => 1,
		"bg" => "ffffff"	
	),
	"catalog_small" => array(
		'w' => 180,
		//'h' => 94,
		"bg" => "ffffff"	
	)
);

/* End of file upload_config.php */
/* Location: ./application/config/upload_config.php */