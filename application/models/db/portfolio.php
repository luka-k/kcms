<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Portfolio class
*
* @package		kcms
* @subpackage	Models
* @category	    Portfolio
*/
class Portfolio extends MY_Model
{
	public $editors = array(
		'Основное' => array(
			'id' => array('id', 'hidden'),
			'is_active' => array('Активна', 'checkbox'),
			'in_work' => array('В разработке', 'checkbox'),
			'name' => array('Заголовок проекта', 'text', 'trim|htmlspecialchars|name', 'require'),
			'sort' => array('sort', 'hidden'),
			'description' => array('Описание', 'tiny', 'trim'),
			'short_description' => array('Описание 2(тип проекта и тд)', 'tiny-2', 'trim')
		),
		'Изображения' => array(
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
			$object_info = array(
				"object_type" => 'portfolio',
				"object_id" => $item->id
			);
			
			$item->img = $this->images->get_cover($object_info);
			
			if(isset($item->description)) $item->description = htmlspecialchars_decode($item->description);
			if(isset($item->short_description)) $item->short_description = htmlspecialchars_decode($item->short_description);
			return $item;
		}	
	}

}