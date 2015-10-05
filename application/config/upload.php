<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['upload_path'] = FCPATH.'download/images';

$config['thumb_config'] = array(
	"publication" => array(
		'w' => 298,
		'h' => 150,
		'far' => 1,
		"bg" => "ffffff"
	),
	'publication_big' => array(
		'w' => 398,
		'h' => 280,
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
	),
	'products' => array(
		'w' => 288,
		'h' => 290,
		'zc' => 1,
		'far' => 1,
		"bg" => "ffffff"
	)
);

/* End of file upload_config.php */
/* Location: ./application/config/upload_config.php */