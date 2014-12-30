<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Articles extends MY_Model
{
	public $editors = array(
		'Основное' => array(
			'id' => array('id', 'hidden', ''),
			'date' => array('Дата', 'hidden', 'set_date'),
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

			//если дошли до 4 сегмента url
			//то есть до 3 уровняя влодежости
			//формируем статью.
			//собственно для любого уровня вложенности можно ввсети передаваемый параметр
			/*if($segment_number == 3)
			{
				$level
				
				/*if($url == "novosti")
				{
					$child->sub_news = $this->get_list(array('parent_id' => $child->id));
					if(!empty($child->news))
					{
						$child->sub_news = $this->get_prepared_list($child->sub_news);
					}
					if($this->uri->segment($segment_number+2))
					{
					
					}
					elseif($this->uri->segment($segment_number+2))
					{
						
					}
					else
					{
						$news = $array();
						foreach()
					}
					return $child;
				}
				else
				{
					$parent->article = $this->get_item_by(array('url' => $url));
					$parent->articles = $this->get_list(array('parent_id' => $parent->article->id));
					if(!empty($parent->articles))
					{
						$parent->articles = $this->get_prepared_list($parent->article);
					}
				}
				
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
			}*/
		}
	}
	
	public function get_url($url)
	{
		$item = $this->get_item_by(array("url" => $url));
		$item_url = $this->make_full_url($item);
		$full_url = implode("/", array_reverse($item_url));
		$full_url = base_url().$full_url;
		return $full_url;		
	}
	
	public function make_full_url($item)
	{
		$item_url = array();
		$item_url[] = $item->url;
		
		while($item->parent_id <> 0)
		{
			$parent_id = $item->parent_id;
			$item = $this->get_item_by(array("id" => $parent_id));
			$item_url[] = $item->url;
		}
		$item_url[] = 'articles';
		return $item_url;
	}	
	
	function prepare($item)
	{
		//var_dump($item);
		$item->full_url = $this->get_url($item->url);
		if(!empty($item->date))
		{
			$item_date = new DateTime($item->date);
			$item_date = date_format($item_date, 'd.m.Y');
			$item->date = $item_date;
		}
		return $item;
	}
}