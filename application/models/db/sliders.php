<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Articles class
*
* @package		kcms
* @subpackage	Models
* @category	    Sliders
*/
class Sliders extends MY_Model
{
	public $editors = array(
		'Основное' => array(
			'id' => array('id', 'hidden'),
			'name' => array('Заголовок', 'text', 'trim|name', 'require'),
			'link' => array('Ссылка', 'text'),
			'type' => array('Тип слайдера', 'simple_select'),
			'sort' => array('Сортировка', 'text')
		),
		'Изображения' => array(
			'upload_image' => array('Загрузить изображение', 'image', 'img')
		)
	);
	
	function __construct()
	{
        parent::__construct();
	}
	
	function prepare($item)
	{
		$item->img = $this->images->get_cover(array('object_type' => 'sliders', 'object_id' => $item->id));
		return $item;		
	}
}