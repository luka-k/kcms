<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CI_Url {

	var $CI;
	
	public function __construct()
	{
		$this->CI =& get_instance();
		$this->CI->load->library('session');
	}
	
	public function catalog_url_parse($segment_number, $parent = FALSE)
	{
		$url = $this->CI->uri->segment($segment_number);
		
		if(!$url) return FALSE;
		
		$child = $this->CI->categories->get_item_by(array('url' => $url, 'parent_id' => isset($parent->id) ? $parent->id : 0));
		if(!$child)
		{
			$product = $this->CI->products->get_item_by(array('url' => $url));
			if ($product)
			{
				$this->CI->breadcrumbs->add($url, $product->name);
				$parent->product = $product;
				return $parent;
			}
			else
			{
				return '404';
			}
		}
		else
		{
			//$this->CI->categories->add_active($child->id);
			$this->CI->breadcrumbs->add($url, $child->name);
			$child->parent = $parent;
		
			if ($this->CI->uri->segment($segment_number+1))
			{
				return $this->CI->url_parse($segment_number + 1, $child);
			}
			else 
			{
				$child->products = $this->CI->categories->get_sub_products($child->id);
				return $child;
			}		
		}	
	}
	
	public function url_parse($segment_number, $parent = FALSE)
	{
		$url = $this->CI->uri->segment($segment_number);
		
		if(!$url) return FALSE;
		
		$child = $this->CI->menus_items->get_item_by(array('url' => $url, 'parent_id' => isset($parent->id) ? $parent->id : 0));
	
		if(!$child)
		{
			$child =$this->CI->articles->get_item_by(array("url" => $url));
			
			if($child)
			{
				$this->CI->breadcrumbs->add($url, $child->name);
				return $this->CI->articles->prepare($child);
			}
			else
			{
				'404';
			}	
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