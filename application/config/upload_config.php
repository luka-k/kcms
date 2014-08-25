<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['upload_path'] = FCPATH.'download/images';

$config['thumb_config'] = array(
	"catalog_big" => array(
		'w' => 640,
		'h' => 320,
		'wp' => 640,
		'hp' => 320,
		"zc" => "С",
		"bg" => "ffffff"
	),
	"catalog_mid" => array(
		'w' => 308,
		'h' => 155,
		'wp' => 308,
		'hp' => 155,
		"zc" => "С",
		"bg" => "ffffff"	
	),
	"catalog_small" => array(
		'w' => 163,
		'h' => 82,
		'wp' => 163,
		'hp' => 82,
		"zc" => "С",
		"bg" => "ffffff"	
	)
);




/*$config['allowed_types'] = 'gif|jpg|png|jpeg';
$config['max_size'] = '1000';
$config['max_width'] = '1024';
$config['max_height'] = '1768';

$config['image_library'] = 'gd2';
$config['create_thumb'] = TRUE;
$config['maintain_ratio'] = TRUE;
$config['thumb'] = 2;
$config['width_1'] = 130;
$config['height_1'] = 100;   
$config['width_2'] = 300;
$config['height_2'] = 200;  */
 

/* End of file upload_config.php */
/* Location: ./application/config/upload_config.php */