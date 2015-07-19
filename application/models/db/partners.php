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
			'name' => array('Заголовок', 'text', 'trim|name', 'require'),
			'link' => array('Ссылка', 'text'),
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
		$item->img = $this->images->get_cover(array('object_type' => 'partners', 'object_id' => $item->id));
		return $item;		
	}
}