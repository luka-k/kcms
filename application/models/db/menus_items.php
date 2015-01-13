<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menus_items extends MY_Model
{
	public $editors = array(
		'Основное' => array(
			'id' => array('id', 'hidden', ''),
			'menu_id' => array('Меню', 'hidden', ''),
			'name' => array('Заголовок', 'text', 'trim|required|htmlspecialchars|name'),
			'parent_id' => array('Родительский пункт меню', 'select', ''),
			'description' => array('Описание', 'text', ''),
			'item_type' => array('Тип пункта', 'type', ''),
			'url' => array('Ссылка', 'link', '')//,
			//'upload_image' => array('Загрузить изображение', 'image', 'img')
		)
	);
	
	public function menu_tree($menu_id, $parent_id = 0)
	{
		$branches = $this->get_list(array("menu_id" => $menu_id, "parent_id" => $parent_id), $from = FALSE, $limit = FALSE, $order = "sort", $direction = "asc");
		if ($branches) foreach ($branches as $i => $b)
		{
			$url = explode ("://", $b->url, -1);
			empty($url) ? $branches[$i] = $this->prepare($b) : $branches[$i]->full_url = $b->url;

			$branches[$i]->childs = $this->menu_tree($menu_id, $b->id);
		}		
		return $branches;
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
		return $item;
	}
	
	public function url_parse($segment_number, $parent = FALSE)
	{
		$url = $this->uri->segment($segment_number);
		
		if(!$url) return FALSE;
		
		$child = $this->get_item_by(array('url' => $url, 'parent_id' => isset($parent->id) ? $parent->id : 0));
	
		if(!$child)
		{
			$child =$this->articles->get_item_by(array("url" => $url));
			
			return $child ? $this->articles->prepare($child) : '404';
		}
		else
		{
			if($segment_number == 2) $url = "articles/".$url; 
			$this->breadcrumbs->add($url, $child->name);
			
			if ($this->uri->segment($segment_number+1))
			{
				return $this->url_parse($segment_number + 1, $child);
			}
			else 
			{
				if($child->item_type == "articles") 
				{
					$article = $this->articles->get_item_by(array("url" => $child->url));
					$sub_level = $this->articles->get_list(array("parent_id" => $article->id));
				
					$child = $article;
					if($sub_level)
					{
						if($segment_number == 3)
						{
							$child->articles = array();
							foreach($sub_level as $item)
							{
								$sub_items = $this->articles->get_list(array("parent_id" => $item->id));
								//var_dump($sub_items);
								if(!empty($sub_items))foreach($sub_items as $a)
								{
									$child->articles[] = $a;
								}
							}
							$child->articles = $this->articles->get_prepared_list($child->articles);
						}
						elseif($segment_number == 4)
						{
							$child->articles = $this->articles->get_prepared_list($sub_level);
						}
						//var_dump($child);
						return $child;
					}
					else
					{
						return $child;
					}
				}
				else
				{
					return $child;
				}
			}
		}
	}

}