<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CI_Catalog {

	var $CI;
	
	public function __construct()
	{
		$this->CI =& get_instance();
	}
	
	/**
	* Получение продуктов
	* 
	* @param integer $category_id
	* @param string $order
	* @param string $direction
	* @return array
	*/
	public function get_products($category_id, $order, $direction)
	{
		$products = $this->_get_products($category_id);
	
		if($products)
		{
			foreach ($products as $key => $row) 
			{
				$volume[$key]  = $row->$order;
			}
						
			$sort =  $direction == "asc" ? SORT_ASC : SORT_DESC;
			array_multisort($volume, $sort, $products);
		}
		
		return $products;
	}
	
	/**
	* Получение продуктов из подкатегорий категории
	*
	* @param integer $category_id
	* @return array
	*/
	public function _get_products($category_id)
	{
		$products = $this->CI->products->get_list(array("parent_id" => $category_id));
			
		$sub_categories = $this->CI->categories->get_list(array("parent_id" => $category_id));
		
		if($sub_categories) foreach($sub_categories as $category)
		{
			$products = array_merge($products, $this->_get_products($category->id));
		}
	
		return $products;
	}
	
	public function get_max_for_filtred($products, $field)
	{
		//var_dump(co$products);
		$max = 0;
		foreach($products as $product)
		{
			if($product->$field > $max) $max = $product->$field;
		}
		return $max;
	}
	
	public function get_min_for_filtred($products, $field)
	{
		$min = 0;
		foreach($products as $product)
		{
			if($product->$field < $min) $min = $product->$field;
		}
		return $min;
	}
	
	public function get_nok_tree($products)
	{
		$nok_tree = array();
		
		foreach($products as $product)
		{
			$product_shortnames = $this->CI->characteristics->get_list(array("type" => "shortname", "object_id" => $product->id), FALSE, FALSE, "value", "asc");
			
			if($product_shortnames) foreach($product_shortnames as $p_sn)
			{
				$product_shortdescs = $this->CI->characteristics->get_list(array("type" => "shortdesc", "object_id" => $product->id), FALSE, FALSE, "value", "asc");

				if($product_shortdescs) foreach($product_shortdescs as $p_sd)
				{
					$nok_tree[$p_sn->value][] = $p_sd->value;
				}
				$nok_tree[$p_sn->value] = array_unique($nok_tree[$p_sn->value]);
			}
		}
		ksort($nok_tree, SORT_STRING);
		
		return $nok_tree;
	}
	
	
}