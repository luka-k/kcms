<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Testimonials class
*
* @package		kcms
* @subpackage	Models
* @category	   	Testimonials
*/
class Testimonials extends MY_Model
{
	public $editors = array(
		'Основное' => array(
			'id' => array('id', 'hidden'),
			'sort' => array('sort', 'hidden'),
			'name' => array('Имя', 'text', 'trim', 'require'),
			'title' => array('Заголовок', 'text', 'trim|name', 'require'),
			'description' => array('Описание', 'tiny'),
			'upload_file' =>  array('pdf файл', 'upload_file', 'upload_file'),
			'upload_image' => array('Загрузить изображение', 'image_gallery', 'img')
		)
	);
	
	function __construct()
	{
        parent::__construct();
	}
	
	public function prepare($item)
	{
		if(!empty($item))
		{
			$item->img = $this->images->get_cover(array('object_type' => 'testimonials', 'object_id' => $item->id));
			
			$file = $this->files->get_item_by(array("object_id" => $item->id, "object_type" => "testimonials"));
			if(!empty($file)) $item->file = $this->files->prepare($file);
			return $item;
		}	
	}
}