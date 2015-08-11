<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Slider extends MY_Model
{
	public $editors = array(
		'Основное' => array(
			'id' => array('id', 'hidden', 'name'),
			'sort' => array('Сортировка', 'text', ''),
			'description' => array('Описание', 'tiny', ''),
			'en_description' => array('Описание (eng)', 'tiny', '')
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