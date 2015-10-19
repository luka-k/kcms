<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CI_Url {

	var $CI;
	
	public function __construct()
	{
		$this->CI =& get_instance();
	}
	
	public function admin_url_parse()
	{
		$type = $this->CI->uri->segment(3);
		if($type == "item")
		{
			$base = $this->CI->uri->segment(5);
			$id = $this->CI->uri->segment(6);
		}
		else
		{
			$base = $this->CI->uri->segment(4);
			$id = $this->CI->uri->segment(5);
		}

		if(($type == "item")and($base == "products"))
		{
			$item = $this->CI->$base->get_item_by(array("id" => $id));
			$base = "categories";
		}
		elseif(($type == "items")and($base == "products"))
		{
			$base = "categories";
			$item = $this->CI->$base->get_item_by(array("id" => $id));
			$this->CI->$base->add_active($id);
		}
		else
		{
			$item = $this->CI->$base->get_item_by(array("id" => $id));
			$this->CI->$base->add_active($id);
		}
		
		if (!empty($item))
		{
			$parent_id = $item->parent_id;
			while($parent_id <> 0)
			{
				$this->CI->$base->add_active($item->parent_id);
				$item = $this->CI->$base->get_item_by(array("id" => $parent_id));
				$this->CI->$base->add_active($item->parent_id);
				$parent_id = $item->parent_id;
			}	
			return TRUE;
		}	
		else
		{
			return TRUE;
		}	
	}
	
	public function categories_url_parse($segment_number, $parent = FALSE)
	{
		$url = $this->CI->uri->segment($segment_number);
		if(!$url)
		{
			return $segment_number == 2 ? "root" : FALSE;
		}
		

		$this->CI->config->item('works_id');
		$this->CI->config->item('catalog_id');
		
		if($this->CI->uri->segment(1) == "works") $parent_id = $this->CI->config->item('works_id');
		if($this->CI->uri->segment(1) == "catalog") $parent_id = $this->CI->config->item('catalog_id');
		
		$child = $this->CI->categories->get_item_by(array('url' => $url, 'parent_id' => isset($parent->id) ? $parent->id : $parent_id));
		
			if(empty($child))
		{
			$child = $parent;
			$child->product = $this->CI->products->get_item_by(array('url' => $url));
			if(!$child->product) return FALSE;
				
			$this->CI->breadcrumbs->add($url, $child->product->name);
			
		}
		else
		{
			$this->CI->breadcrumbs->add($url, $child->name);
			$child->parent = $parent;

			if ($this->CI->uri->segment($segment_number+1))	return $this->CI->url->categories_url_parse($segment_number + 1, $child);	
		}	
		return $child;
	}
	
	public function get_imgs_by_href($href)
	{
		$ex_href = explode('/', $href);
		//var_dump($ex_href);
		if(empty($ex_href[0])) return FALSE;
		
		$this->CI->load->helper('url_helper');
		
		$works_id = $this->CI->config->item('works_id');
		$catalog_id = $this->CI->config->item('catalog_id');
		$works_url = $this->CI->config->item('works_url');
		$catalog_url = $this->CI->config->item('catalog_url');
		
		$imgs = array();
		if($ex_href[0] == 'articles')
		{
			$content = $this->_parse_articles_href($ex_href);
			if($content) $imgs = $this->CI->images->get_images(array('object_type' => 'articles', 'object_id' => $content->id));
		}
		elseif($ex_href[0] == $works_url)
		{
			$content = $this->_parse_categories_href($ex_href, $works_id);
			if($content) $imgs = $this->CI->images->get_images(array('object_type' => 'products', 'object_id' => $content->id));
		}
		elseif($ex_href[0] == $catalog_url)
		{
			$content = $this->_parse_categories_href($ex_href, $catalog_id);
			if($content) $imgs = $this->CI->images->get_images(array('object_type' => 'products', 'object_id' => $content->id));
		}

		return $imgs;
	}
	
	protected function _parse_articles_href($href, $parent_id = 0, $segment = 1)
	{
		$content = $this->CI->articles->get_item_by(array('url' => $href[$segment], 'parent_id' => $parent_id));
		
		if(!$content) return FALSE;
		
		if(isset($href[$segment + 1]) && !empty($href[$segment + 1]))
		{
			return $this->_parse_articles_href($href, $content->id, $segment + 1);
		}
		else
		{
			return $content;
		}
		
	}
	
	protected function _parse_categories_href($href, $parent_id = 1, $segment = 1)
	{
		$content = $this->CI->categories->get_item_by(array('url' => $href[$segment], 'parent_id' => $parent_id));

		if(!$content)
		{
			$content = $this->CI->products->get_item_by(array('url' => $href[$segment], 'parent_id' => $parent_id));
				
			if(!$content) return FALSE;
				
			return $content;	
		}
		
		if(isset($href[$segment + 1]) && !empty($href[$segment + 1]))
		{
			return $this->_parse_categories_href($href, $content->id, $segment + 1);
		}
		else
		{
			return $content;
		}
	}
	
	
	public function url_parse($segment_number, $parent = FALSE)
	{
		$url = $this->CI->uri->segment($segment_number);
		
		if(!$url) return FALSE;
		
		$child = $this->CI->menus_items->get_item_by(array('url' => $url, 'parent_id' => isset($parent->id) ? $parent->id : 0));
		
		if(!$child)
		{
			$child = $this->CI->articles->get_item_by(array("url" => $url));
			
			if(!$child) return FALSE;
			
			$segment_number == 2 ? $this->CI->breadcrumbs->add("articles/".$url, $child->name) : $this->CI->breadcrumbs->add($url, $child->name);

			return $this->CI->uri->segment($segment_number+1) ? $this->url_parse($segment_number + 1, $child) : $this->get_child_info($child, $url);
		}
		else
		{
			$segment_number == 2 ? $this->CI->breadcrumbs->add("articles/".$url, $child->name) : $this->CI->breadcrumbs->add($url, $child->name);
			
			if ($this->CI->uri->segment($segment_number+1))
			{
				return $this->url_parse($segment_number + 1, $child);
			}
			else
			{
				$child = $this->CI->articles->get_item_by(array("url" => $url));
				
				if(!$child) return FALSE;
				
				return $this->get_child_info($child, $url);
			}
		}
	}
	
	private function get_child_info($child, $url)
	{
		if($child->id == 3)
			$child->articles = $this->CI->articles->get_list(array("parent_id" => $child->id), 0, 0, 'date', 'desc');
		else
			$child->articles = $this->CI->articles->get_list(array("parent_id" => $child->id), 0, 0, 'sort', 'asc');
		
		if (!$child->articles)
		{
			$child->article = $this->CI->articles->get_item_by(array("url" => $url));
			if (!$child->article) return FALSE;
		}
		else
		{
			$f = array();
			foreach($child->articles as $item)
			{
				$f = array_merge($f, $this->CI->articles->get_list(array("parent_id" => $item->id)));
			}

			if(empty($f) && $child->id <> 3) $child->article = $child->articles[0];
		}
		
		return $child;
	}
}