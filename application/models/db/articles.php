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
			'url' => array('url', 'text', 'trim|htmlspecialchars|substituted[name]')
		)
	);
	
	//items_tree - дерево для списка элементов
	//item_tree - дерево для страницы редактирования элемента
	public $admin_left_column = array(
		"items_tree" => "articles_tree",
		"item_tree" => "articles_tree",
	);
	
	function __construct()
	{
        parent::__construct();
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
			
			if ($this->uri->segment($segment_number+1))
			{
				return $this->url_parse($segment_number + 1, $child);
			}
			else 
			{
				$sub_level = $this->get_list(array("parent_id" => $child->id));
				if($sub_level)
				{
					if($segment_number == 3)
					{
						$child->articles = array();
						foreach($sub_level as $item)
						{
							$sub_items = $this->get_list(array("parent_id" => $item->id));
							if(!empty($sub_items))foreach($sub_items as $article)
							{
								$child->articles[] = $article;
							}
						}
						$child->articles = $this->get_prepared_list($child->articles);
					}
					elseif($segment_number == 4)
					{
						$child->articles = $this->get_prepared_list($sub_level);
					}
					return $child;
				}
				else
				{
					return $child;
				}
				
			}
		}
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
		if(!empty($item)) $item->full_url = $this->get_url($item);
		if(!empty($item->date))
		{
			$item_date = new DateTime($item->date);
			$item_date = date_format($item_date, 'd.m.Y');
			$item->date = $item_date;
		}
		return $item;
	}
}