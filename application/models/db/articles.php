<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Articles extends MY_Model
{
	public $editors = array(
		'Основное' => array(
			'id' => array('id', 'hidden', ''),
			'name' => array('Заголовок', 'text', 'trim|required|htmlspecialchars|name'),
			'en_name' => array('Заголовок (eng)', 'text', 'trim|required|htmlspecialchars'),
			'menu_name' => array('Заголовок в меню', 'text', 'trim|htmlspecialchars|autocomplete[name]'),
			'en_menu_name' => array('Заголовок в меню (eng)', 'text', 'trim|htmlspecialchars|autocomplete[en_name]'),
			'not_list' => array('Не отображать в списке', 'checkbox', ''),
			'not_left_menu' => array('Не отображать в левом меню', 'checkbox', ''),
			'parent_id' => array('Родительская категория', 'select', ''),
			'sort' => array('Сортировка', 'text', ''),
			'description' => array('Текст', 'tiny', ''),
			'en_description' => array('Текст (eng)', 'tiny', ''),
			'full_description' => array('Полный текст', 'tiny', ''),
			'en_full_description' => array('Полный текст (eng)', 'tiny', '')
		),
		'SEO' => array(
			'meta_title' => array('Meta title страницы', 'text', 'trim|htmlspecialchars'),
			'en_meta_title' => array('Meta title страницы (eng)', 'text', 'trim|htmlspecialchars'),
			'meta_keywords' => array('Ключевые слова страницы', 'text', 'trim|htmlspecialchars'),
			'en_meta_keywords' => array('Ключевые слова страницы (eng)', 'text', 'trim|htmlspecialchars'),
			'meta_description' => array('Описание страницы', 'text', 'trim|htmlspecialchars'),
			'en_meta_description' => array('Описание страницы (eng)', 'text', 'trim|htmlspecialchars'),
			'url' => array('url', 'text', 'trim|htmlspecialchars|substituted[name]')
		),
		'Руководитель раздела' => array(
			'direction' => array('Направление', 'text', 'trim|htmlspecialchars'),
			'en_direction' => array('Направление (eng)', 'text', 'trim|htmlspecialchars'),
			'lead_name' => array('Имя руководителя', 'text', 'trim|htmlspecialchars'),
			'en_lead_name' => array('Имя руководителя (eng)', 'text', 'trim|htmlspecialchars'),
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
			if($segment_number == 2) $url = "category/".$url; 
			$this->breadcrumbs->add($url, $child->menu_name);
			
			if($segment_number == 3)
			{
				
				$imp_url = explode("-", $url);
				if($imp_url[0] == "novosti")
				{
					if($this->uri->segment($segment_number+1))
					{
						$parent->news_item = $this->news->get_item_by(array('url' => $this->uri->segment($segment_number+1)));
						$this->breadcrumbs->add($parent->news_item->url, $parent->news_item->name);
						return $parent;
					}
					else
					{
						$article = $this->get_item_by(array("url" => $url));
						$parent->news = $this->news->get_news($article->url);
						$parent->news = $this->news->get_prepared_list($parent->news);
					}
				}
				elseif($this->uri->segment($segment_number+1) <> FALSE)
				{
					$parent->article = $this->get_item_by(array('url' => $this->uri->segment($segment_number+1)));
					$this->breadcrumbs->add($parent->article->url, $parent->article->name);
				}
				else
				{
					$parent->article = $this->get_item_by(array('url' => $url));
					$parent->accordeon = $this->get_list(array('parent_id' => $parent->article->id, "not_list" => 0), 0, 0, 'sort', 'asc');
					$parent->accordeon = $this->get_prepared_list($parent->accordeon);
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
		if(!empty($item))
		{
			$item->full_url = $this->get_url($item->url);
			$item->img = $this->images->get_images(array("object_type" => "articles", "object_id" => $item->id), "lead", 1);
		
			if(LANG == 'eng')
			{
				$item->name = $item->en_name;
				$item->menu_name = $item->en_menu_name;
				$item->description = $item->en_description;
				$item->full_description = $item->en_full_description;
				$item->meta_title = $item->en_meta_title;
				$item->meta_keywords = $item->en_meta_keywords;
				$item->meta_description = $item->en_meta_description;
				$item->direction = $item->en_direction;
				$item->lead_name = $item->en_lead_name;
			}
		
			return $item;
		}
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