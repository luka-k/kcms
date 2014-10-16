<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Url_model extends MY_Model
{	
    function __construct()
	{
        parent::__construct();
	}

	public function url_parse($segment_number)
	{
		$url = $this->uri->segment($segment_number);

		if (!$url) return FALSE;
		
		$child_category = $this->categories->get_item_by(array("url" => $url));
		
		if($child_category)
		{
			$this->breadcrumbs->add($url, $child_category->name);
			if($this->uri->segment($segment_number + 1))
			{
				return $this->url_parse($segment_number + 1);
			}
			else
			{
				return $child_category;
			}
		}
		else
		{
			$product = $this->products->get_item_by(array('url' => $url));
			if ($product)
			{
				$this->breadcrumbs->add($url, $product->name);
				$category->product = $product;
				return $category;
			}
			else
			{
				return '404';
			}			
		}
			
		/*$query = $this->db->get_where('category2category', array("parent_id" => 0));
		$child = $query->result_array();//$this->categories->get_item_by(array('url' => $url, 'parent_id' => isset($category->id) ? $category->id : 0));
		foreach($child as $item)
		{
			$category = $this->categories->get_item_by(array("id" => $item['id'], "url" => $url));
		}
		var_dump($category);
		if(isset($category->id))
		{
			$this->categories->add_active($category->id);
		}
		if (!$child_category)
		{
			$product = $this->products->get_item_by(array('url' => $url));
			if ($product)
			{
				$this->breadcrumbs->add($url, $product->title);
				$category->product = $product;
				return $category;
            }
			else
			{
				return '404';
			}
		} 
		else 
		{
			$this->categories->add_active($child_category->child_id);
			$child_category->parent = $category;
			
			$this->breadcrumbs->add($url, $child_category->title);
	
			if ($this->uri->segment($segment_number+1))
			{
				return $this->url_parse($segment_number + 1, $child_category);
			}
			else 
			{
				return $child_category;
			}
		}*/
	}
	
	public function admin_url_parse()
	{
		$type = $this->uri->segment(2);
		$base = $this->uri->segment(3);
		$id = $this->uri->segment(4);
		if(($type == "item")and($base == "products"))
		{
			$item = $this->products->get_item_by(array("id" => $id));
		}
		else
		{
			$item = $this->$base->get_item_by(array("id" => $id));
			$this->$base->add_active($id);
		}
		if (!empty($item))
		{
			
			$parent_id = $item->parent_id;
			while($parent_id <> 0)
			{
				$this->$base->add_active($item->parent_id);
				$item = $this->$base->get_item_by(array("id" => $parent_id));
				$this->$base->add_active($item->parent_id);
				$parent_id = $item->parent_id;
			}	
			return TRUE;
		}	
		else
		{
			return TRUE;
		}	
	}
}