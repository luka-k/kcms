<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Departments class
*
* @package		kcms
* @subpackage	Models
* @category	    Departments
*/
class Departments extends MY_Model
{
	public $editors = array(
		'Основное' => array(
			'id' => array('id', 'hidden'),
			'name' => array('название', 'text', 'trim|htmlspecialchars|name'),
			'address' => array('адресс', 'text'),
			'phone' => array('телефон', 'text'),
			'opened' => array('расписание</br><i>через точку с запятой</i></br><i>Пример: будни:10:00 - 18:00; обед:14:00 - 15:00</i>', 'text')
		)
	);
	
	function __construct()
	{
        parent::__construct();
	}
	
	public function prepare($item)
	{
		$item->opened = explode('; ', $item->opened);
		return $item;
	}
}