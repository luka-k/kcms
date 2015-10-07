<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Slider extends MY_Model
{
	public $editors = array(
		'Основное' => array(
			'id' => array('id', 'hidden'),
			'sort' => array('sort', 'hidden'),
			'name' => array('Заголовок', 'text', 'trim|name', 'require'),
			'is_active' => array('Активен', 'checkbox', ''),
			'link' => array('Ссылка', 'text'),
			'description' => array('Описание', 'text'),
			'upload_image' => array('Загрузить изображение', 'image', 'img')
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
			$item->img = $this->images->get_cover(array('object_type' => 'slider', 'object_id' => $item->id));
			return $item;
		}		
	}
}