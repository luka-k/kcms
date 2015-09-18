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
	function get_products_by_filter($filter, $order, $direction, $from = FALSE, $limit = FALSE)
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
			//Если указан пункт в наличии 
			if(isset($filter['is_active'])) $this->db->where("is_active", 1);

			if(isset($filter['price_from']) && isset($filter['price_to']))
			{
				$where = "price BETWEEN {$filter['price_from']} AND {$filter['price_to']}";
				$this->db->where($where);
			}
			if(!empty($id)) $this->db->where_in("id", $id);
			
			if(!$order)
			{
				$order = 'name';
				$direction = 'asc';
			}
			
			$this->db->order_by($order, $direction); 
			if($limit) $this->db->limit($limit, $from);
			
			$query = $this->db->get("products");
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
		$value = array();
		$ch = $this->db->get('characteristics')->result();
		$ch_ids = $this->catalog->select_ids($ch);
		if(!empty($ch_ids))
		{
			$this->db->where_in('characteristic_id', $ch_ids);
			$result = $this->db->get('characteristic2product')->result();
			if(!empty($result)) foreach($result as $r)
			{
				$values[] = $r->product_id;
			}
		}
		return $values;
	}
}