<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Documents class
*
* @package		kcms
* @subpackage	Models
* @category	   	Documents
*/
class Documents extends MY_Model
{
	public $editors = array(
		'Основное' => array(
			'id' => array('id', 'hidden'),
			'sort' => array('sort', 'hidden'),
			'name' => array('Имя', 'text', 'trim|name', 'require'),
			'upload_image' => array('Загрузить изображение', 'image_gallery', 'img')
		)
	);
	
	function __construct()
	{
        parent::__construct();
	}
	
	function prepare($item, $cover = TRUE)
	{
		if(!empty($item))
		{
			$object_info = array(
				"object_type" => 'documents',
				"object_id" => $item->id
			);
			
			$item->img = $this->images->get_cover($object_info);
			
			return $item;
		}
	}
}