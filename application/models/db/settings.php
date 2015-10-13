<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Settings class
*
* @package		kcms
* @subpackage	Models
* @category	   	Settings
*/
class Settings extends MY_Model
{
	public $editors = array(
		'Основное' => array(
			'id' => array('id', 'hidden'),
			'uniq_text_id' => array('Текстовый индетификатор', 'text', 'trim|name', 'require'),
			'string_value' => array('Строка', 'text'),
			'text_value' => array('Текст', 'textarea'),
			//'image' => array('Иконка', 'image', 'img')
		)
	);
	
	function __construct()
	{
        parent::__construct();
	}
	
	public function get_settings()
	{
		$settings_list = $this->get_list(FALSE);
		
		$settings = array();
		
		if(!empty($settings_list)) foreach($settings_list as $s)
		{
			$settings[$s->uniq_text_id] = $s;
		}
		
		return $settings;
	}
}