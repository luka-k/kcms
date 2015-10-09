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
						
			$sort =  $direction == 'asc' ? SORT_ASC : SORT_DESC;
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
		$products = $this->CI->products->get_list(array('parent_id' => $category_id));
			
		$sub_categories = $this->CI->categories->get_list(array('parent_id' => $category_id));
		
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
		$filters_info = '';
		if(!empty($filters[$ch]))
		{
			switch($type){
				case 'characteristics':
					foreach($filters[$ch] as $key => $item)
					{
						$filters_info[] = $item;
					}
					break;
				case 'products':
					foreach($filters[$ch] as $key => $item)
					{
						$filters_info[] = $this->CI->$type->get_item_by(array('sku' => $item))->sku;
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
		//$this->CI->benchmark->mark('code_start');
		$nok_tree = array();
		
		if(empty($ids)) return $nok_tree;

		$sl = array();
		if(!empty($selected['shortdesc']))
		{
			$this->CI->db->select('type, value, id, parent_id');
			if($selected['shortdesc']) $this->CI->db->where_in('id', array_keys($selected['shortdesc']));
			$this->CI->db->where('type', 'shortdesc');
			
			$result = $this->CI->db->get('characteristics')->result();
			if($result) foreach($result as $r)
			{
				$sl[] = $r->parent_id;
			}
		}

		$this->CI->db->where_in('product_id', $ids);
	
		$result = $this->CI->db->get('characteristic2product')->result();
		
		if($result)
		{	
			foreach($result as $r)
			{
				$ch_ids[] = $r->characteristic_id;
			}
			
			$ch_ids = array_unique($ch_ids);
			
			$this->CI->db->select('type, value, id');
			$this->CI->db->where('type', 'shortname');
			if(!empty($ch_ids)) $this->CI->db->where_in('id', $ch_ids);
			
			if(!empty($sl)) $this->CI->db->or_where_in('id', $sl);
			if(!empty($selected['shortname'])) $this->CI->db->or_where_in('value', $selected['shortname']);

			$this->CI->db->order_by('value', 'asc');
			$result = $this->CI->db->get('characteristics')->result();
			
			if($result) foreach($result as $r)
			{
				$this->CI->db->select('type, value, id');
				
				if(!empty($selected['shortdesc'])) $this->CI->db->where_in('id', array_keys($selected['shortdesc']));
				$this->CI->db->where('parent_id', $r->id);
				if(!empty($ch_ids)) $this->CI->db->or_where_in('id', $ch_ids);
				$this->CI->db->where('parent_id', $r->id);
				$this->CI->db->order_by('sort', 'desc');
				$this->CI->db->order_by('value', 'asc');
				$this->CI->db->where('type', 'shortdesc');
				$nok_branch = $this->CI->db->get('characteristics')->result();

				$nok_tree[$r->value] = array();
				if(!empty($nok_branch)) 
				{
					foreach($nok_branch as $nb)
					{
						$nok_tree[$r->value][$nb->id] = $nb->value;
					}
				}
			}
			
		}
		//$this->CI->benchmark->mark('code_end');
		//my_dump($this->CI->benchmark->elapsed_time('code_start', 'code_end'));
		
		return $nok_tree;
	}
	
	public function get_max($items, $field)
	{
		$max = 0;
		foreach($items as $item)
		{
			if($item->$field > $max) $max = $item->$field;
		}
		
		return $max;
	}
	
	public function get_min($items, $field)
	{
		$min = 0;
		if(is_array($items) && !empty($items))
		{
			$min = $items[0]->$field;

			foreach($items as $item)
			{
				if($item->$field < $min) $min = $item->$field;
			}
		}
		return $min;
	}
}