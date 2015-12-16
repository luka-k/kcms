<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['upload_path'] = FCPATH.'download_bb/images';

$config['thumb_config'] = array(
	"catalog_big" => array(
		'w' => 1200,
		'h' => 900,
		'fltr' => array(
			0 => 'wmi|/home/admin/web/brightberry.ru/public_html/template/watermark.png|BR|100|30|30'
		),
		"bg" => "ffffff"
	),
	"catalog_gallery" => array(
		'w' => 626,
		'h' => 467,
		'wp' => 626,
		'hp' => 467,
		"zc" => "l",
		'fltr' => array(
			0 => 'wmi|/home/admin/web/brightberry.ru/public_html/template/watermark-small.png|BR|100|15|15'
		),
		"bg" => "ffffff"
	), 
	"map" => array(
		'w' => 278,
		'h' => 198,
		'wp' => 278,
		'hp' => 198,
		"zc" => "l",
		"bg" => "ffffff"
	),
	"map_print" => array(
		'w' => 531,
		'h' => 452,
		'wp' => 531,
		'hp' => 452,
		"zc" => "l",
		"bg" => "ffffff"
	),
	"catalog_mid" => array(
		'w' => 130,
		'h' => 110,
		'wp' => 130,
		'hp' => 110,
		"zc" => "l",
		"bg" => "ffffff"	
	),
	"catalog_small_v" => array(
		'w' => 123,
		'h' => 89,
		'wl' => 123,
		'hl' => 89,
		'wp' => 100,
		'hp' => 135,
		"bg" => "ffffff"	
	),
	"catalog_small" => array(
		'w' => 123,
		'h' => 89,
		'wl' => 123,
		'hl' => 89,
		"zc" => "l",
		"bg" => "ffffff"	
	),
	"catalog_little_v" => array(
		'w' => 110,
		'h' => 80,
		'wl' => 110,
		'hl' => 80,
		'wp' => 80,
		'hp' => 110,
		"bg" => "ffffff"	
	),
	"catalog_little" => array(
		'w' => 110,
		'h' => 80,
		'wl' => 110,
		'hl' => 80,
		"zc" => "l",
		"bg" => "ffffff"	
	),
	"video" => array(
		'w' => 110,
		'h' => 80,
		'wp' => 110,
		'hp' => 80,
		"zc" => "l",
		"bg" => "ffffff",
		'fltr' => array(
			0 => 'wmi|/home/admin/web/brightberry.ru/public_html/template/client/images/youtube.png|C|100|0|0'
		)
	),
	"categories" => array(
		'w' => 123,
		'h' => 121,
		'wp' => 123,
		'hp' => 121,
		"bg" => "ffffff"	
	),
	"categories2" => array(
		'w' => 135,
		'h' => 133,
		'iar' => 1,
		"bg" => "ffffff"	
	)
);

/* End of file upload_config.php */
/* Location: ./application/config/upload_config.php */