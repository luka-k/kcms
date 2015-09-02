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
	
	public function ids_in_array($items)
	{
		$ids = array();
		foreach($items as $i)
		{
			$ids[] = $i->id;
		}
		return $ids;
	}
}