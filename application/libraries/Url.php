<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CI_Url {

	var $CI;
	
	public $active_branch = array();
	
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
			$this->add_active($id);
		}
		else
		{
			$item = $this->CI->$base->get_item_by(array("id" => $id));
			$this->add_active($id);
		}
		
		if (!empty($item))
		{
			$parent_id = $item->parent_id;
			while($parent_id <> 0)
			{
				$this->add_active($item->parent_id);
				$item = $this->CI->$base->get_item_by(array("id" => $parent_id));
				$this->add_active($item->parent_id);
				$parent_id = $item->parent_id;
			}	
			return TRUE;
		}	
		else
		{
			return TRUE;
		}	
	}
	
	public function add_active($id)
	{
		$this->active_branch[] = $id;
	}
	
	public function set_active_class($active_branch, $branch)
	{
		foreach($active_branch as $element)
		{
			if($branch->id == $element)
			{
				$branch->class = "active";
				return TRUE;
			}
		}	
	}
	
	public function catalog_url_parse($segment_number, $parent = FALSE)
	{
		$url = $this->CI->uri->segment($segment_number);
		
		if(!$url)
		{
			return $segment_number == 2 ? "root" : FALSE;
		}
		
		$child = $this->CI->categories->get_item_by(array('url' => $url, 'parent_id' => isset($parent->id) ? $parent->id : 0));
		if(!$child)
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
		
			if ($this->CI->uri->segment($segment_number+1)) return $this->catalog_url_parse($segment_number + 1, $child);

			$child->products = $this->CI->categories->get_sub_products($child->id);

		}	
		return $child;
	}
	
	public function url_parse($segment_number, $parent = FALSE)
	{
		$url = $this->CI->uri->segment($segment_number);

		if(!$url) return FALSE;
		
		$child = $this->CI->menus_items->get_item_by(array('url' => $url, 'parent_id' => isset($parent->id) ? $parent->id : 0));
		
		if(!$child)
		{
			$child =$this->CI->articles->get_item_by(array("url" => $url));

			if(!$child) return FALSE;

			$this->CI->breadcrumbs->add($url, $child->name);
			return $this->CI->articles->prepare($child);
		}
		else
		{
			if($segment_number == 2) $url = "articles/".$url; 
			$this->CI->breadcrumbs->add($url, $child->name);
			
			if ($this->CI->uri->segment($segment_number+1))
			{
				return $this->url_parse($segment_number + 1, $child);
			}
			else 
			{
				if($child->item_type == "articles") 
				{
					$article = $this->CI->articles->get_item_by(array("url" => $child->url));
					$sub_level = $this->CI->articles->get_list(array("parent_id" => $article->id));
				
					$child = $article;

					if($sub_level)
					{
						if($segment_number == 3)
						{
							$child->articles = array();
							foreach($sub_level as $item)
							{
								$sub_items = $this->CI->articles->get_list(array("parent_id" => $item->id));

								if(!empty($sub_items))foreach($sub_items as $a)
								{
									$child->articles[] = $a;
								}
							}
							$child->articles = $this->CI->articles->get_prepared_list($child->articles);
						}
						elseif($segment_number == 4)
						{
							$child->articles = $this->CI->articles->get_prepared_list($sub_level);
						}
					}
				}
				return $child;
			}
		}
	}
}