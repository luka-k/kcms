<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Url_model extends MY_Model
{	
    function __construct()
	{
        parent::__construct();
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
}