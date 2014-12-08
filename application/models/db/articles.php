<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Articles extends MY_Model
{
	public $editors = array(
		'Основное' => array(
			'id' => array('id', 'hidden', ''),
			'name' => array('Заголовок', 'text', 'trim|required|htmlspecialchars|name'),
			'menu_name' => array('Заголовок в меню', 'text', 'trim|htmlspecialchars|substituted[name]'),
			'parent_id' => array('Родительская категория', 'select', ''),
			'sort' => array('Сортировка', 'text', ''),
			'description' => array('Описание', 'tiny', '')
		),
		'SEO' => array(
			'meta_title' => array('Meta title страницы', 'text', 'trim|htmlspecialchars'),
			'meta_keywords' => array('Ключевые слова страницы', 'text', 'trim|htmlspecialchars'),
			'meta_description' => array('Описание страницы', 'text', 'trim|htmlspecialchars'),
			'url' => array('url', 'text', 'trim|htmlspecialchars|substituted[name]')
		),
		'Руководитель раздела' => array(
			'direction' => array('Направление', 'text', 'trim|htmlspecialchars'),
			'lead_name' => array('Имя руководителя', 'text', 'trim|htmlspecialchars'),
			'lead_email' => array('Почта руководителя', 'text', 'trim|htmlspecialchars'),
			'upload_image' => array('Фотография', 'image', 'img')
		),
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
			
			
			if($segment_number == 3)
			{
				
				$imp_url = explode("-", $url);
				if($imp_url[0] == "novosti")
				{
					if($this->uri->segment($segment_number+1))
					{
						$parent->news_item = $this->news->get_item_by(array('url' => $this->uri->segment($segment_number+1)));
						return $parent;
					}
					else
					{
						$article = $this->get_item_by(array("url" => $url));
						$parent->news = $this->news->get_news($article->url);
						$parent->news = $this->news->get_prepared_list($parent->news);
					}
				}

				$parent->article = $this->get_item_by(array('url' => $url));
				$parent->accordeon = $this->get_list(array('parent_id' => $parent->article->id));
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
		$item_url[] = 'category';
		return $item_url;
	}	
	
	function prepare($item)
	{
		//var_dump($item);
		$item->full_url = $this->get_url($item->url);
		$item->img = $this->images->get_images(array("object_type" => "articles", "object_id" => $item->id), "lead", 1);
		return $item;
	}
	
	function get_news_tree()
	{
		$news_tree = array();
		$articles = $this->get_list(FALSE);
		foreach($articles as $item)
		{
			if(substr_count( $item->url, "novosti"))
			{
				$news_tree[] = $item;
			}
		}
		
		return $news_tree;
	}
}