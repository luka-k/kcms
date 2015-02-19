<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Characteristics_type extends MY_Model
{
	public $editors = array(
		'Основное' => array(
			'id' => array("id", "hidden", ""),
			'name' => array("Название типа", "text", "trim|required|htmlspecialchars|name"),
			'url' => array("тип фильтра", "hidden", "substituted[name]")
		)
	);
	
	function __construct()
	{
        parent::__construct();
	}
}