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
		$this->config->load('articles');
		
		$vendors = $this->manufacturers->get_vendors();
		foreach($vendors as $i => $v)
		{
			$vendors[$i]->full_url = 'http://brightbuild.ru/vendor/'.strtolower($v->url);
		}
		
		$contractors = $this->manufacturers->get_contractors();
		foreach($contractors as $i => $c)
		{
			$contractors[$i]->full_url = 'http://brightbuild.ru/contractor/'.strtolower($c->url);
		}
				
		$content = array(
			'Новости' => $this->articles->get_tree($this->config->item('news_id'), 'parent_id'),
			'Категории' => $this->categories->get_another_tree(),
			'Производители' => $this->manufacturers->prepare_list($this->manufacturers->get_manufacturers()),
			'Продавцы' => $vendors,
			'Подрядчики' => $contractors,
			'Статьи' => array() //Может как подругому назвать стоит
		);
		
		//my_dump($content);
		
		$single_pages = $this->config->item('sitemap_pages');
		
		foreach($single_pages as $name => $link)
		{
			$item = new stdClass();
			$item->name = $name;
			$item->full_url = base_url().$link;
			$content['Статьи'][] = $item;
		}
		
		$data = array(
			'title' => "Карта сайта",
			'meta_description' => '',
			'meta_keywords' => '',
			'select_item' => '',
			'left_menu' => $this->categories->get_another_tree(),
			'left_active_item' => '',
			'submenu_active_item' => '',
			'open_tag' => '<?xml version="1.0" encoding="UTF-8"?>',
			'content' => $content
		);
		$data = array_merge($this->standart_data, $data);
		
		$template = "client/sitemap_".$map_type.".php";
		$this->load->view($template, $data);
	}
	
}