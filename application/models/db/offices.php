<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Offices class
*
* @package		kcms
* @subpackage	Models
* @category	    Offices
*/
class Offices extends MY_Model
{
	public $editors = array(
		'Основное' => array(
			'id' => array('id', 'hidden'),
			'name' => array('Название офиса', 'text', 'name'),
			'description' => array('Описание', 'tiny', 'trim'),
			'ya_map' => array('yandex карта', 'textarea', 'trim|htmlspecialchars')
		),
		'Изображение' => array(
			'upload_image' => array('Карта проезда', 'image', 'img')
		)
	);
	
	function __construct()
	{
        parent::__construct();
	}
	
	/**
	* 
	*
	* @param object $item
	* @return object
	*/
	function prepare($item)
	{
		if(!empty($item))
		{
			$item->img = $this->images->get_cover(array("object_type" => 'offices', "object_id" => $item->id));
			
			if(isset($item->description)) $item->description = htmlspecialchars_decode($item->description);
			return $item;
		}
	}
}