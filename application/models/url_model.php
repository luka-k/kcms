<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Url_model extends MY_Model
{
	var $full_url = array();
	
    function __construct()
	{
        parent::__construct();
		$this->config->load('upload_config');
	}

	public function url_parse($segment_number, $category = FALSE)
	{
		$url = $this->uri->segment($segment_number);
		if (!$url) return FALSE;
		$child_category = $this->categories->get_item_by(array('url' => $url, 'parent_id' => isset($category->id) ? $category->id : 0));
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
		}
	}
	
	public function get_url($url, $type, $path = FALSE)
	{
		$this->full_url = NULL;
		if ($type == "catalog")
		{
			$item = $this->products->get_item_by(array("url" => $url));
			if (empty($item))
			{
				$item = $this->categories->get_item_by(array("url" => $url));
			}
			$this->make_full_url($item);
		}
		elseif($type == "images")
		{
			$this->full_url[] = $url;
			$this->full_url[] = $path;
			$this->full_url[] = "images";
			$this->full_url[] = "download";
		}
		
		$this->full_url[] = base_url();
		$full_url = implode("/", array_reverse($this->full_url));
		return $full_url;
	}
	
	private function make_full_url($item)
	{
		$this->full_url[] = $item->url;
		if ($item->parent_id <> 0)
		{
			$item = $this->categories->get_item_by(array("id" => $item->parent_id));
			$this->make_full_url($item);
		}
		else
		{
			$this->full_url[] = 'catalog';
		}
	}
	
	public function get_full_url($info)
	{
		foreach($info as $item)
		{
			$item->full_url = $this->uri->uri_string()."/".$item->url;
		}
		return $info;
	}
}