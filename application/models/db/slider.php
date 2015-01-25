<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Slider extends MY_Model
{
	public $editors = array(
		'Основное' => array(
			'id' => array('id', 'hidden', ''),
			'name' => array('Заголовок', 'text', 'trim|required|htmlspecialchars|name'),
			'description' => array('Описание', 'tiny', ''),
			'link' => array('Ссылка', 'text', ''),
			'is_active' => array('Активен', 'checkbox', ''),
			'upload_image' => array('Загрузить изображение', 'image', 'img')
		)
	);
	
	function __construct()
	{
        parent::__construct();
	}
	
	function prepare($item)
	{
		$item->img = $this->images->get_images(array('object_type' => 'slider', 'object_id' => $item->id), 1);
		return $item;		
	}
}