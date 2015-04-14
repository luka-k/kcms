<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Sitemap class
*
* @package		kcms
* @subpackage	Controllers
* @category	    Sitemap
*/
class Sitemap extends Client_Controller 
{	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index($map_type = "html")
	{
		//Возможно этот массив нужно вынести в config
		$types = $this->config->item('sitemap_types');
		$content = array();
		foreach($types as $type)
		{
			$content = array_merge($content, $this->$type->prepare_list($this->$type->get_list(FALSE)));
		}
		
		$data = array(
			'title' => "Карта сайта",
			'select_item' => '',
			'open_tag' => '<?xml version="1.0" encoding="UTF-8"?>',
			'content' => $content
		);
		$data = array_merge($this->standart_data, $data);
		
		$template = "client/sitemap_".$map_type.".php";
		$this->load->view($template, $data);
	}
	
}