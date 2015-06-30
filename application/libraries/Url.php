<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Url class
* 
* @package		kcms
* @subpackage	Libraries
* @category	    Url
*/

class CI_Url {

	var $CI;
	
	public function __construct()
	{
		$this->CI =& get_instance();
	}
	
	/**
	* Парсер url каталога магазина
	*
	* @param integer $segment_number
	* @param integer $parent
	* @return object
	*/
	public function shop_url_parse($segment_number, $parent = FALSE)
	{
		$url = $this->CI->uri->segment($segment_number);
		if(!$url)
		{
			return $segment_number ==  2 ? "root" : FALSE;
		}
		
		$child = $this->CI->categories->get_item_by(array('url' => $url));

		if(empty($child))
		{
			$child = $parent;
			$child->product = $this->CI->products->get_item_by(array('url' => $url));
			if(!$child->product) return FALSE;
			
			$manufacturer = $this->CI->manufacturers->get_item($child->product->manufacturer_id);
			$breadcrumb = (string)$manufacturer->name." ".(string)$child->product->sku;
			$this->CI->breadcrumbs->add($url, $breadcrumb);	
		}
		else
		{
			$this->CI->breadcrumbs->add($url, $child->name);
			$child->parent = $parent;
		
			if ($this->CI->uri->segment($segment_number+1))	return $this->CI->url->shop_url_parse($segment_number + 1, $child);	
		}	
		return $child;
	}
	
	/**
	* Парсер url каталога
	*
	* @param integer $segment_number
	* @return object
	*/
	public function catalog_url_parse($segment_number, $parent = FALSE)
	{
		$url = $this->CI->uri->segment($segment_number);

		if(!$url)
		{
			return $segment_number == 2 ? "root" : FALSE; 
		}
		$content = new stdClass();
		
		$child = $this->CI->categories->get_item_by(array('url' => $url));
		if(empty($child))
		{
			$manufacturer = $this->CI->manufacturers->get_item_by(array("url" => $url));
			if(empty($manufacturer))
			{
				$this->CI->config->load('types');
				$doc_types = $this->CI->config->item('doc_type');
				
				if(!array_key_exists($url, $doc_types)) return FALSE;

				$content->doc_type = array(
					'value' => $url,
					'title' => $doc_types[$url]
				);
			}
			else
			{
				$this->CI->breadcrumbs->add($url, $manufacturer->name);
				$content->manufacturer = $manufacturer;
				$content->doc_type = array(
					'value' => "catalogs",
					'title' => "каталоги"
				);
			}
			
			if(isset($parent->parent_category)) $content->parent_category = $parent->parent_category;
			$content->category = $parent->category;
			if(isset($parent->manufacturer)) $content->manufacturer = $parent->manufacturer;
		}
		else
		{
			$this->CI->breadcrumbs->add($url, $child->name);
			$content->category = $child;
			if($parent) $content->parent_category = $parent->category;
		}
		
		if($this->CI->uri->segment($segment_number + 1)) return $this->catalog_url_parse($segment_number + 1, $content);

		return $content;
	}
	
	public function contractors_url_parse($segment_number, $parent = FALSE)
	{
		$url = $this->CI->uri->segment($segment_number);

		if(!$url)
		{
			return $segment_number == 2 ? "root" : FALSE; 
		}
		
		$content = new stdClass();
		
		$child = $this->CI->services->get_item_by(array('url' => $url));
		
		if(empty($child))
		{
			$manufacturer = $this->CI->manufacturers->get_item_by(array("url" => $url));
			
			if(empty($manufacturer)) return FALSE;
			
			$this->CI->breadcrumbs->add($url, $manufacturer->name);
			$content->manufacturer = $manufacturer;
			
			if(isset($parent->parent_service)) $content->parent_service = $parent->parent_service;

			$content->service = $parent->service;
		}
		else
		{
			$this->CI->breadcrumbs->add($url, $child->name);
			$content->service = $child;
			if($parent) $content->parent_service = $parent->service;
		}
		
		if($this->CI->uri->segment($segment_number + 1)) return $this->contractors_url_parse($segment_number + 1, $content);
		
		return $content;
	}
	
	/**
	* Парсер url
	*
	* @param integer $segment_number
	* @param integer $parent
	* @return object	
	*/
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
	
	/**
	* Добавляет подстатьи
	*
	* @param object $child
	* @param string $url
	* @return object
	*/
	private function get_child_info($child, $url)
	{
		$child->articles = $this->CI->articles->get_list(array("parent_id" => $child->id), FALSE, FALSE, "date", "desc");
		
		if (!$child->articles)
		{
			$child->article = $this->CI->articles->get_item_by(array("url" => $url));
			if (!$child->article) return FALSE;
		}
		return $child;
	}
}