<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Articles extends MY_Model
{
	public $editors = array(
		'Основное' => array(
			'id' => array('id', 'hidden', ''),
			'name' => array('Заголовок', 'text', 'trim|required|htmlspecialchars|name'),
			'date' => array('Дата', 'date', 'set_date'),
			'parent_id' => array('Родительская категория', 'select', ''),
			'sort' => array('Сортировка', 'text', ''),
			'description' => array('Описание', 'tiny', '')
		),
		'SEO' => array(
			'meta_title' => array('Meta title страницы', 'text', 'trim|htmlspecialchars'),
			'meta_keywords' => array('Ключевые слова страницы', 'text', 'trim|htmlspecialchars'),
			'meta_description' => array('Описание страницы', 'text', 'trim|htmlspecialchars'),
			'url' => array('url', 'text', 'trim|htmlspecialchars|substituted[name]'),
			'lastmod' => array('lastmod', 'hidden', '')
		)
	);
	
	public $admin_left_column = array(
		"items_tree" => "articles_tree",
		"item_tree" => "articles_tree",
	);
	
	function __construct()
	{
        parent::__construct();
	}
	
	public function get_url($item)
	{
		$item_url = $this->make_full_url($item);
		$full_url = implode("/", array_reverse($item_url));
		$full_url = base_url().$full_url;
		return $full_url;		
	}
	
	public function make_full_url($item)
	{
		$item_url = array();
		if(!empty($item)) 
		{
		
			$item_url[] = $item->url;
		
			while($item->parent_id <> 0)
			{
				$parent_id = $item->parent_id;
				$item = $this->get_item_by(array("id" => $parent_id));
				$item_url[] = $item->url;
			}
			$item_url[] = 'articles';
		}
		return $item_url;
	}	
	
	function prepare($item)
	{
		if(!empty($item))
		{
			$item->full_url = $this->get_url($item);
			if(!empty($item->date))
			{
				$item_date = new DateTime($item->date);
				$item_date = date_format($item_date, 'd.m.Y');
				$item->date = $item_date;
			}
			return $item;
		}
	}
}