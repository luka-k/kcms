<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['settings_id'] = 1;

$config['import_status'] = array(
	'next' => array(
		'operating', 
		'load1C-end', 
		'load1COffers-end', 
		'load1CRecommended-end', 
		'load1CImageCovers-end', 
		'load1CImage-end', 
		'updateFullUrl-end',
		'updateRanging-end',
		'cacheClear-end',
		'refreshCategories-end',
		'refreshManufacturerByCategories-end'
	),
	'die' => array(
		'load1C-start', 
		'load1COffers-start', 
		'load1CCattegories-start', 
		'load1CRecommended-start', 
		'load1CImageCovers-start', 
		'load1CImage-start', 
		'updateFullUrl-start',
		'updateRanging-start',
		'cacheClear-start',
		'refreshCategories-start',
		'refreshManufacturerByCategories-start',
		'refreshManufacturers-start',
		'refreshManufacturers-end'
	)
);

$config['import_routing'] = array(
	'operating' => 'admin/import/load1C',
	'load1C-end' => 'admin/import/load1COffers',
	'load1COffers-end' => 'admin/',
	'load1CCategories-end' => '',
	'load1CRecommended-end' => '',
	'load1CImageCovers-end' => '',
	'load1CImage-end' => '',
	'updateFullUrl-end' => '',
	'updateRanging-end' => '',
	'cacheClear-start' => '',
	'refreshCategories-end' => '',
	'refreshManufacturerByCategories-end' => ''
);