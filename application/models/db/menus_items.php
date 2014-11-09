<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menus_items extends MY_Model
{
	public $editors = array(
		'Основное' => array(
			'id' => array('id', 'hidden', ''),
			'name' => array('Заголовок', 'text', 'trim|required|htmlspecialchars|name'),
			'parent_id' => array('Родительский пункт меню', 'select', ''),
			'description' => array('Описание', 'tiny', ''),
			'link' => array('Заголовок', 'text', '')
		)
	);
	
	
}