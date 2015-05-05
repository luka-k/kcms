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
	function get_products_by_filter($filter, $order, $direction, $limit = FALSE, $from = FALSE)
	{
		$values = array();
		$id = array();
		$counter = 0;
		$filters_type = $this->characteristics_type->get_list(FALSE);
		
		foreach($filters_type as $item)
		{
			if(isset($filter[$item->url])&&!empty($filter[$item->url]))
			{
				$do_update = TRUE;
				switch ($item->view_type)
				{
					case "text":
						$this->db->where(array("type" => $item->url, "value" => $filter[$item->url]));
						$counter++;
						break;
					case "multy":
						$this->db->distinct();
						$this->db->where("type", $item->url);
						$this->db->where_in("value", $filter[$item->url]);
						$counter++;
						break;
					case "single":
						$this->db->where(array("type" => $item->url, "value" => $filter[$item->url]));
						$counter++;
						break;
					case "interval":
						$filter[$item->url][0] = (integer)$filter[$item->url][0];
						$filter[$item->url][1] = (integer)$filter[$item->url][1];
						if(!empty($filter[$item->url][0])&&!empty($filter[$item->url][1]))
						{
							$this->db->where("type", $item->url);
							$where = "value BETWEEN {$filter[$item->url][0]} AND {$filter[$item->url][1]}";
							$this->db->where($where);
							$counter++;
						}
						elseif(!empty($filter[$item->url][0])||!empty($filter[$item->url][1]))
						{
							
							$this->db->where("type", $item->url);
							
							if(!empty($filter[$item->url][0])) $this->db->where("value >=", $filter[$item->url][0]); 
							if(!empty($filter[$item->url][1])) $this->db->where("value <=", $filter[$item->url][1]);
							$counter++;
						}	
						else
						{
							$do_update = FALSE;
							$counter--;
						}
						break;
				}
				if($do_update) $values = $this->_update_values($values);
			}
		}
		if($counter > 1)
		{
			$values = array_count_values($values);
			foreach($values as $key => $counter_value)
			{
				if($counter_value > 1) $id[] = $key;
			}
		}
		else
		{
			$id = $values;
		}

		if(!empty($id) || (empty($id) && $counter == 0))
		{
			if(isset($filter['collection_checked']))
			{
				$this->db->where_in("collection_parent_id", $filter['collection_checked']);
				$this->db->select("child_id");
				$ids = $this->db->get("product2collection")->result();
				$product_ids = array();
				foreach($ids as $item)
				{
					$product_ids[] = $item->child_id;
				}
				$this->db->where_in("id", $product_ids);
			}
			
			//Если указан пункт в наличии 
			if(isset($filter['is_active'])) $this->db->where("is_active", 1);
			
			//фильтрация по категории
			if(isset($filter['categories_checked'])) $this->db->where_in("parent_id", $filter['categories_checked']);

			//фильтрация по производителю
			if(isset($filter['manufacturer_checked'])) $this->db->where_in("manufacturer_id", $filter['manufacturer_checked']);
			
			//фильтрация по артикулу
			if(isset($filter['sku_checked'])) $this->db->where_in("sku", $filter['sku_checked']);
			
			if(isset($filter['width_from']) && isset($filter['width_to'])) $this->set_range_param("width", $filter['width_from'], $filter['width_to']);
			if(isset($filter['height_from']) && isset($filter['height_to']))  $this->set_range_param("height", $filter['height_from'], $filter['height_to']);
			if(isset($filter['depth_from']) && isset($filter['depth_to']))  $this->set_range_param("depth", $filter['depth_from'], $filter['depth_to']);
			if(isset($filter['price_from']) && isset($filter['price_to']))  $this->set_range_param("price", $filter['price_from'], $filter['price_to']);
			
			if(!empty($id)) $this->db->where_in("id", $id);
			
			$this->db->order_by($order, $direction); 
			$query = $this->db->get("products"/*, $limit, $from*/);
			$result = $query->result();
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
	private function _update_values($values)
	{
		$this->db->select('object_id');
		$query = $this->db->get('characteristics');
		foreach($query->result_array() as $result)
		{
			$values[] = $result['object_id'];
		}
		return $values;
	}
	
	private function set_range_param($type, $from, $to)
	{
		if(isset($from) && isset($to))
		{
			$from = preg_replace("/[^0-9]/", "", $from);
			$to = preg_replace("/[^0-9]/", "", $to);

			$where = "{$type} BETWEEN {$from} AND {$to}";
			$this->db->where($where);
		}
	}
}