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
	
	/**
	* Возвращает массив id продуктов
	*/
	public function get_products_ids($products)
	{
		$ids = array();
		foreach($products as $p)
		{
			$ids[] = $p->id;
		}
		return $ids;
	}
		
	public function get_filters_info($filters, $type, $ch)
	{
		$filters_info = "";
		if(!empty($filters[$ch]))
		{
			switch($type){
				case "characteristics":
					foreach($filters[$ch] as $key => $item)
					{
						$filters_info[] = $item;
					}
					break;
				case "products":
					foreach($filters[$ch] as $key => $item)
					{
						$filters_info[] = $this->CI->$type->get_item_by(array("sku" => $item))->sku;
					}
					break;
				default:
					foreach($filters[$ch] as $key => $item)
					{
						$filters_info[] = $this->CI->$type->get_item($item)->name;
					}
					
					break;
			}
		}

		return $filters_info;
	}
	
	public function get_nok_tree($ids, $selected = array())
	{
		$nok_tree = array();
		$shortdescs = array();
		$to_delete = array();

		$shortnames = $this->CI->characteristics->get_list(array("type" => "shortname"), FALSE, FALSE, "value", "asc");
		
		foreach($shortnames as $sn)
		{
			$nok_tree[$sn->value] = array();
			if(in_array($sn->object_id, $ids)) $to_save[] = $sn->value;
		}
		//var_dump($to_delete);

		foreach($shortnames as $sn)
		{
			$shortdesc = $this->CI->characteristics->get_list(array("type" => "shortdesc", "object_id" => $sn->object_id));
			
			foreach($shortdesc as $sd)
			{
				if(isset($selected['shortdesc']))
				{
					if(in_array($sd->object_id, $ids) || array_key_exists($sd->id, $selected['shortdesc'])) $nok_tree[$sn->value][$sd->id] = $sd->value;
				}
				else
				{
					if(in_array($sd->object_id, $ids)) $nok_tree[$sn->value][$sd->id] = $sd->value;
				}
			}
		}
		
		foreach($nok_tree as $i => $branch)
		{
			if((isset($selected['shortname']) && !in_array($i, $selected['shortname'])) || (!in_array($i, $to_save) && empty($nok_tree[$i]))) unset($nok_tree[$i]);
			if(isset($nok_tree[$i]))
			{
				$nok_tree[$i] = array_unique($branch);
				asort($nok_tree[$i], SORT_STRING);
			}
		}
		
		ksort($nok_tree, SORT_STRING);
		
		return $nok_tree;
	}
}