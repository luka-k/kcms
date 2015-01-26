<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Characteristics extends MY_Model
{
	public $filters = array(
		'use' => array("По применению", "select")
	);
	
	function __construct()
	{
        parent::__construct();
	}
	
	public function get_filters()
	{
		foreach($this->filters as $type => $item)
		{
			if($item[1] == "multy" || $item[1] == "single" || $item[1] == "select")
			{
				$this->db->distinct();
				$this->db->select("value");
				$this->db->where("type", $type);
				$query = $this->db->get($this->_table);
				foreach($query->result_array() as $result)
				{
					$values[] = $result['value'];
				}
				$filters[$type] = (object)array(
					"name" => $item[0],
					"editor" => $item[1],
					"values" => $values
				);
			}
			else
			{
				$filters[$type] = (object)array(
					"name" => $item[0],
					"editor" => $item[1]
				);
			}
		}
		return $filters;
	}
	
	function get_filtered_products($get, $order, $direction, $limit = FALSE, $from = FALSE)
	{
		$values = array();
		$filters = $this->filters;
		$counter = 0;
		foreach($get as $key => $item)
		{
			if(!empty($item)) 
			{
				if(isset($filters[$key]))
				{
					switch ($filters[$key][1])
					{
						case "text":
							$this->db->where(array("type" => $key, "value" => $item));
							$counter++;
							break;
						case "select":
							$this->db->where("type", $key);
							$this->db->where_in("value", $item);
							$counter++;
							break;
						case "single":
							$this->db->where(array("type" => $key, "value" => $item));
							$counter++;
							break;
						case "interval":
							if(!empty($item[0])&&!empty($item[1]))
							{
								$this->db->where("type", $key);
								$where = "{$name} BETWEEN {$item[0]} AND {$item[1]}";
								$this->db->where($where);
								$counter++;
							}
							elseif(!empty($item[0])||!empty($item[1]))
							{
								$this->db->where("type", $key);
								if(!empty($item[0])) $this->db->where("value >", $item[0]);
								if(!empty($item[1])) $this->db->where("value <", $item[1]);
								$counter++;
							}	
							break;
					}
					$values = $this->_update_values($values);
				}
			}
		}

		
		if($counter > 1)
		{
			$values = array_count_values($values);
			foreach($values as $key => $counter)
			{
				if($counter > 1) $id[] = $key;
			}
		}
		else
		{
			$id = $values;
		}		

		if(!empty($id)) $this->db->where_in("id", $id);
		$this->db->order_by($order, $direction); 
			
		//Если указан пункт в наличии 
		if(isset($get->is_active)) $this->db->where("is_active", 1);

		if(isset($get->price_from) && isset($get->price_to))
		{
			$where = "price BETWEEN {$get->price_from} AND {$get->price_to}";
			$this->db->where($where);
		}
			
		$query = $this->db->get("products"/*, $limit, $from*/);
		$result = $query->result();
		empty($result) ? $content = array() : $content = $result;
		return $content;
	}
	
	
	private function _update_values($values)
	{
		$query = $this->db->get('characteristics');
		foreach($query->result_array() as $result)
		{
			$values[] = $result['object_id'];
		}
		return $values;
	}
}