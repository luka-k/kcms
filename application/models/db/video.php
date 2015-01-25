<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Video extends MY_Model
{
	public $editors = array(
		'Основное' => array(
			'id' => array('id', 'hidden', ''),
			'name' => array('Заголовок', 'text', 'trim|required|htmlspecialchars|name'),
			'link' => array('Ссылка', 'text', 'trim|htmlspecialchars'),
			'is_main' => array('На главную', 'checkbox', '')
		)
	);
	
	function __construct()
	{
        parent::__construct();
	}
	
	function prepare($item)
	{
		$item->link = htmlspecialchars_decode($item->link);
		return $item;		
	}
}