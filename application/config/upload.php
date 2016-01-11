<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['upload_path'] = FCPATH.'download/images';

$config['thumb_config'] = array(
	"catalog_big" => array(
		'w' => 268,
		'h' => 408
	),
	"catalog_big_album" => array(
		'w' => 408,
		'h' => 268
	),
	"catalog_big_cd" => array(
		'w' => 268
	),
	"catalog_mid" => array(
		'w' => 140,
		'h' => 212,
	),
	"catalog_mid_album" => array(
		'w' => 212,
		'h' => 140,
	),
	"catalog_mid_cd" => array(
		'w' => 140
	),
	"catalog_small" => array(
		'w' => 90,
		'h' => 136
	),
	"catalog_small_album" => array(
		'w' => 136,
		'h' => 90
	),
	"catalog_small_cd" => array(
		'w' => 90
	)
);

/* End of file upload_config.php */
/* Location: ./application/config/upload_config.php */