<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dynamic_menus extends MY_Model
{
	public $editors = array(
		'Основное' => array(
			'id' => array('id', 'hidden', ''),
			'name' => array('Заголовок', 'text', 'trim|required|htmlspecialchars|name'),
			'description' => array('Описание', 'text', 'trim|htmlspecialchars'),
			'upload_image' => array('Загрузить изображение', 'image', 'img')
		)
	);
	
	
}