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
		$filters = array();
		foreach($this->filters as $type => $item)
		{
			if($item[1] == "multy" || $item[1] == "single" || $item[1] == "select")
			{
				$this->db->distinct();
				$this->db->select("value");
				$this->db->where("type", $type);
				$query = $this->db->get($this->_table);
				
				$values = array();
				foreach($query->result_array() as $result)
				{
					$values[] = $result['value'];
				}
				if($values)
				{
					$filters[$type] = (object)array(
						"name" => $item[0],
						"editor" => $item[1],
						"values" => $values
					);
				}
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

		$counter = 0;

		if(isset($get->filter_value))
		{
			$this->db->where("type", $get->filter);
			$this->db->where_in("value", $get->filter_value);
		}

		$values = $this->_update_values($values);

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