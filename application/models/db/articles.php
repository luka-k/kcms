<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Articles extends MY_Model
{
	public $editors = array(
		'Основное' => array(
			'id' => array('id', 'hidden', ''),
			'name' => array('Заголовок', 'text', 'trim|required|htmlspecialchars|name'),
			'parent_id' => array('Родительская категория', 'select', ''),
			'sort' => array('Сортировка', 'text', ''),
			'description' => array('Описание', 'tiny', '')
		),
		'SEO' => array(
			'meta_title' => array('Meta title страницы', 'text', 'trim|htmlspecialchars'),
			'meta_keywords' => array('Ключевые слова страницы', 'text', 'trim|htmlspecialchars'),
			'meta_description' => array('Описание страницы', 'text', 'trim|htmlspecialchars'),
			'url' => array('url', 'text', 'trim|htmlspecialchars|substituted[name]')
		)
	);
	
	public $full_url = array();
	
	function __construct()
	{
        parent::__construct();
		$this->load->database();
	}
	
	public function url_parse($segment_number, $parent = FALSE)
	{
		$url = $this->uri->segment($segment_number);
		
		if(!$url) return FALSE;
		
		$child = $this->get_item_by(array('url' => $url, 'parent_id' => isset($parent->id) ? $parent->id : 0));
		if(!$child)
		{
			return '404';
		}
		else
		{
			$this->add_active($child->id);
			if($segment_number == 2) $url = "articles/".$url; 
			$this->breadcrumbs->add($url, $child->name);
			//если дошли до 4 сегмента url
			//то есть до 3 уровняя влодежости
			//формируем статью.
			//собственно для любого уровня вложенности можно ввсети передаваемый параметр
			if($segment_number == 4)
			{
				$parent->article = $this->get_item_by(array('url' => $url));
				return $parent;
			}
			else
			{
				if ($this->uri->segment($segment_number+1))
				{
					return $this->url_parse($segment_number + 1, $child);
				}
				else 
				{
					return $child;
				}
			}
		}
	}
	
	public function get_url($url)
	{
		$this->full_url = NULL;
		$item = $this->get_item_by(array("url" => $url));
		$this->make_full_url($item);
		$full_url = implode("/", array_reverse($this->full_url));
		$full_url = base_url().$full_url;
		return $full_url;		
	}
	
	public function make_full_url($item)
	{
		$this->full_url[] = $item->url;
		if ($item->parent_id <> 0)
		{
			$item = $this->get_item_by(array("id" => $item->parent_id));
			$this->make_full_url($item);
		}
		else
		{
			$this->full_url[] = 'articles';
		}
	}	
	
	function prepare($item)
	{
		//var_dump($item);
		$item->full_url = $this->get_url($item->url);
		return $item;
	}
}