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
	public function get_products($category_id, $order = 'name', $direction = 'asc', $from = FALSE, $limit = FALSE)
	{
		$products = array();
		$categories_ids = $this->_get_sub_categories_ids($category_id);	
		$categories_ids[] = $category_id;

		if(!empty($categories_ids))
		{
			$this->CI->db->where_in('parent_id', $categories_ids);
			if($order) $this->CI->db->order_by($order, $direction); 
			if($limit) $this->CI->db->limit($limit, $from);
			
			$products = $this->CI->db->get('products')->result();
		}
		
		return $products;
	}
	
	private function _get_sub_categories_ids($category_id)
	{
		$sub_categories = $this->CI->categories->get_list(array("parent_id" => $category_id));

		$ids = array();
		if(!empty($sub_categories)) 
		{
			$ids = array_merge($ids, $this->select_ids($sub_categories));
			foreach($sub_categories as $category)
			{
				$ids = array_merge($ids, $this->_get_sub_categories_ids($category->id));
			}
		}
		return $ids;
	}
	
	/**
	* Возвращает массив id продуктов
	*/
	public function select_ids($items)
	{
		$ids = array();
		foreach($items as $item)
		{
			$ids[] = $item->id;
		}
		return $ids;
	}
}