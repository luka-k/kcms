<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Characteristics class
*
* @package		kcms
* @subpackage	Models
* @category	    Characteristics
*/
class Characteristics extends MY_Model
{
	function __construct()
	{
        parent::__construct();
	}
	
	/**
	* Получение продуктов по фильтру
	*
	* @param array $filter
	* @param string $order
	* @param string $direction
	* @param integer $limit
	* @param integer $from
	* @return array
	*/
	function get_products_by_filter($filter, $order, $direction, $limit = FALSE, $from = FALSE, $null_to_end = FALSE)
	{
		$values = array();
		$id = array();
		$counter = 0;
		$filters_type = $this->characteristics_type->get_list(FALSE);
		
		$ff = array();
		if(isset($filter['shortdesc']))
		{
			foreach($filter['shortdesc'] as $shortdesc)
			{
				$sd = explode ('/', $shortdesc);
	 			
				$this->db->where('type', 'shortname');
				$this->db->where('value', $sd[0]);
				$this->db->select('object_id');
				$results = $this->db->get('characteristics')->result();
				
				$object_ids = array();
				if(!empty($results))foreach($results as $r)
				{
					$object_ids[] = $r->object_id;
				}	

				$this->db->where('type', 'shortdesc');
				$this->db->where('value', $sd[1]);
				$this->db->where_in('object_id', $object_ids);
				$result = $this->db->get('characteristics')->result();

				if(!empty($result))foreach($result as $r)
				{
					$values[] = $r->object_id;
					$ff[] = $r->object_id;
				}
			}

		}

		if(isset($filter['shortname']))
		{
			$this->db->where('type', 'shortname');
			$this->db->where_in('value', $filter['shortname']);
			$this->db->select('object_id');
			$result = $this->db->get('characteristics')->result();
			if($result) foreach($result as $r)
			{
				if(!in_array($r->object_id, $ff))$values[] = $r->object_id;
			}
			++$counter;
		}
		
		foreach($filters_type as $f)
		{
			if($f->url <> 'shortname' && $f->url <> 'shortdesc')
			{
				if(isset($filter[$f->url]))
				{
					$this->db->distinct();
					$this->db->where('type', $f->url);
					$this->db->where_in('value', $filter[$f->url]);
					$values = $this->_update_values($values);
					++$counter;
				}
			}
		}

		if($counter > 1)
		{
			$values = array_count_values($values);
			foreach($values as $key => $counter_value)
			{
				if($counter_value == $counter) $id[] = $key;
			}
		}
		else
		{
			$id = $values;
		}

		if(!empty($id) || (empty($id) && $counter == 0))
		{
			$query = "SELECT * FROM products ";
			
			if(!empty($id) || isset($filter['is_sale']) || isset($filter['collection_checked']) || isset($filter['categories_checked']) || isset($filter['manufacturer_checked']) || isset($filter['sku_checked']) || isset($filter['name']) || isset($filter['width_from']) || isset($filter['height_from']) || isset($filter['depth_from']) || isset($filter['price_from']))
					$query .= "WHERE ";
					
			if(isset($filter['is_sale']) && $filter['is_sale'] == '1')
			{
				$query .= "sale = 1 ";
				if(!empty($id) || isset($filter['collection_checked']) || isset($filter['categories_checked']) || isset($filter['manufacturer_checked']) || isset($filter['sku_checked']) || isset($filter['name']) || isset($filter['width_from']) || isset($filter['height_from']) || isset($filter['depth_from']) || isset($filter['price_from']))
					$query .= "AND ";
			}
			
			if(isset($filter['collection_checked']))
			{
				$this->db->where_in('collection_parent_id', $filter['collection_checked']);
				$this->db->select('child_id');
				$ids = $this->db->get('product2collection')->result();
				
				$ids_by_collection = array();
				foreach($ids as $item)
				{
					$ids_by_collection[] = $item->child_id;
				}

				$query .= $this->_set_where_in('id', $ids_by_collection);
				
				if(!empty($id) || isset($filter['categories_checked']) || isset($filter['manufacturer_checked']) || isset($filter['sku_checked']) || isset($filter['name']) || isset($filter['width_from']) || isset($filter['height_from']) || isset($filter['depth_from']) || isset($filter['price_from']))
					$query .= "AND ";
			}
			
			if(!empty($id))
			{
				$query .= $this->_set_where_in('id', $id);
				
				if(isset($filter['categories_checked']) || isset($filter['manufacturer_checked']) || isset($filter['sku_checked']) || isset($filter['name']) || isset($filter['width_from']) || isset($filter['height_from']) || isset($filter['depth_from']) || isset($filter['price_from']))
					$query .= "AND ";
			}
			
			if(isset($filter['categories_checked']) && $filter['categories_checked'])
			{
				$query .= $this->_set_where_in('parent_id', $filter['categories_checked']);
				
				if(isset($filter['manufacturer_checked']) || isset($filter['sku_checked']) || isset($filter['name']) || isset($filter['width_from']) || isset($filter['height_from']) || isset($filter['depth_from']) || isset($filter['price_from']))
					$query .= "AND ";
			}
			
			if(isset($filter['manufacturer_checked']))
			{
				$query .= $this->_set_where_in('manufacturer_id', $filter['manufacturer_checked']);
				
				if(isset($filter['sku_checked']) || isset($filter['name']) || isset($filter['width_from']) || isset($filter['height_from']) || isset($filter['depth_from']) || isset($filter['price_from']))
					$query .= "AND ";
			}
			
			if(isset($filter['sku_checked']))
			{
				$query .= $this->_set_where_in('sku', $filter['sku_checked']);

				if(isset($filter['name']) || isset($filter['width_from']) || isset($filter['height_from']) || isset($filter['depth_from']) || isset($filter['price_from']))
					$query .= "AND ";
			}
			
			if(isset($filter['name']))
			{
				$query .= "name LIKE '%{$filter['name']}%' ";
				
				if(isset($filter['width_from']) || isset($filter['height_from']) || isset($filter['depth_from']) || isset($filter['price_from']))
					$query .= "AND ";
			}
			
			if(isset($filter['width_from']))
			{
				$query .= $this->_set_range('width', $filter['width_from'], $filter['width_to']);
				
				if(isset($filter['height_from']) || isset($filter['depth_from']) || isset($filter['price_from']))
					$query .= "AND ";
			}
			
			if(isset($filter['height_from']))
			{
				$query .= $this->_set_range('height', $filter['height_from'], $filter['height_to']);

				if(isset($filter['depth_from']) || isset($filter['price_from']))
					$query .= "AND ";
			}
			
			if(isset($filter['depth_from']))
			{
				$query .= $this->_set_range('depth', $filter['depth_from'], $filter['depth_to']);
				if(isset($filter['price_from']))
					$query .= "AND ";
			}
			
			if(isset($filter['price_from']))
				$query .= $this->_set_range('price', $filter['price_from'], $filter['price_to']);

			if($order == "price")
			{
				$query .= "ORDER BY CASE WHEN price = '0' THEN '99999999999' END, price {$direction} ";			
			}
			else
			{
				$query .= "ORDER BY name {$direction} ";
			}
			
			if($limit <> FALSE) $query .= "LIMIT {$from}, {$limit}";
			
			// следующая строчка фиксит баг который возникал при апдэйте кэша когда есть пустая ГТ1 
			if (!strstr($query, 'WHERE ORDER'))
				$result = $this->db->query($query)->result();
			
			if(!empty($result)) return $result;
		}
	
		return array();
	}
	
	/**
	* Фильтр по условию и обновление списка id продуктов соответствующих фильтрации
	*
	* @param array $values
	* @return array
	*/
	protected function _update_values($values)
	{
		$this->db->select('object_id');
		$results = $this->db->get('characteristics')->result();
		foreach($results as $result)
		{
			$values[] = $result->object_id;
		}
		return $values;
	}
	
	protected function _set_where_in($field, $values)
	{
		$value_string = "(";
		$i = 1;
		foreach($values as $v)
		{
			$value_string = $value_string."'".$v."'";
			if($i <> count($values)) $value_string .= ", ";
			$i++;
		}
		$value_string .= ")";

		$query_string = "{$field} IN {$value_string} ";
		
		return $query_string;
	}
	
	protected function _set_range($type, $from, $to)
	{
		$from = preg_replace('/[^0-9]/', '', $from);
		$to = preg_replace('/[^0-9]/', '', $to);
				
		$querry_string = "{$type} BETWEEN {$from} AND {$to} ";
		return $querry_string;
	}
	
	public function get_product_characteristics($item)
	{
		$item->color = $this->get_list(array("type" => "color", "object_id" => $item->id));
		$item->material = $this->get_list(array("type" => "material", "object_id" => $item->id));
		$item->shortname = $this->get_item_by(array("type" => "shortname", "object_id" => $item->id));
		$item->shortdesc = $this->get_list(array("type" => "shortdesc", "object_id" => $item->id));
		$item->finishing = $this->get_list(array("type" => "finishing", "object_id" => $item->id));
		$item->turn = $this->get_list(array("type" => "turn", "object_id" => $item->id));
		
		return $item;
	}
}