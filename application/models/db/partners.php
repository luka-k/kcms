<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Partners class
*
* @package		kcms
* @subpackage	Models
* @category	    Partners
*/
class Partners extends MY_Model
{
	public $editors = array(
		'Основное' => array(
			'id' => array('id', 'hidden'),
			'name' => array('Имя', 'text', 'name'),
			'sort' => array('sort', 'hidden'),
		),
		'Изображение' => array(
			'upload_image' => array('Загрузить изображение', 'image_gallery', 'img')
		)
	);
	
	function __construct()
	{
        parent::__construct();
	}
	
	function prepare($item)
	{
		if(!empty($item))
		{
			$object_info = array(
				"object_type" => $this->_table,
				"object_id" => $item->id
			);
			
			$item->img = $this->images->get_cover($object_info);
			
			return $item;
		}
	}
}