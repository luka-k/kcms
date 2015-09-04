<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//Sitemap class

class Sitemap extends Client_Controller 
{	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$map_type = $this->input->get('type');
		if(empty($map_type)) $map_type = "xml";
		//Возможно этот массив нужно вынести в config
		$types = array("articles", "categories", "products");
		
		$content = array();
		foreach($types as $type)
		{
			$content = array_merge($content, $this->$type->get_prepared_list($this->$type->get_list(FALSE)));
		}
		
		$root = array('works', 'categories');

		
		foreach ($content as $i => $v)
		{
			$url = explode('/', $v->full_url);
			$content[$i]->priority = (13 - count($url)) / 10;
			$content[$i]->changefreq = 'weekly';
			
			if ($content[$i]->priority < 0)
			{
				unset($content[$i]);continue;
			}
			elseif ($content[$i]->description && !isset($v->price) && ($url[3] == $root[0] || $url[3] == $root[1]))
				$content[$i]->priority = 0.9;
		}
		$data = array(
			'title' => "Карта сайта",
			'open_tag' => '<?xml version="1.0" encoding="UTF-8"?>',
			'content' => $content
		);
		$data = array_merge($this->standart_data, $data);
		
		$template = "client/sitemap_".$map_type.".php";
		
		$this->load->view($template, $data);
	}
	
}