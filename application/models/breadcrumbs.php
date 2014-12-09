<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//Модель хлебные крошки
class Breadcrumbs extends CI_Model 
{
	private $breadcrumbs = array();
	
    function __construct()
	{
        parent::__construct();
		$this->breadcrumbs = array(0 => array('url' => '', 'name' => "Главная"));
	}
	
	public function add($url, $name)
	{
		$this->breadcrumbs[] = array('url' => $url, 'name' => $name);
	}
	
	public function get()
	{
		$bc = $this->breadcrumbs;
		$url = '';
		$output = array();
		foreach ($bc as $i => $b)
		{
			$url = $url.$b['url'] . '/';
			if (!$b['name'])
				continue;
			$output[] = array(
				'url' => $url,
				'name' => $b['name'],
				'first' => $i == 0 ? true : false,
				'last' => $i == count($bc)-1 ? true : false
			);
		}
		return $output;
	}
}