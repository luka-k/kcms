<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Slider extends MY_Model
{
	public $editors = array(
		'Основное' => array(
			'id' => array('id', 'hidden', 'name'),
			'description' => array('Описание', 'tiny', '')
		),
		'Изображение' => array(
			'upload_image' => array('Изображение', 'image', 'img')
		)
	);
	
	function __construct()
	{
        parent::__construct();
		$this->load->database();
	}
	
	function prepare($item)
	{
		$item->img = $this->images->get_images(array("object_type" => "slider", "object_id" => $item->id), "slider", 1);
		return $item;
	}
}