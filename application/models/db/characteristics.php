<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Characteristics extends MY_Model
{
	public $filters = array(
		'color' => array("Цвет", "text"),
		'manufacturer' => array("Производитель", "multy"),
		'width' => array("Ширина", "interval"),
		'height' => array("Высота", "interval")
	);
	
	function __construct()
	{
        parent::__construct();
	}
	
	public function get_filters()
	{
		foreach($this->filters as $type => $item)
		{
			if($item[1] == "multy" || $item[1] == "single")
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
	
	function get_filtred($get, $order, $direction, $limit = FALSE, $from = FALSE)
	{
		$values = array();
		$filters = $this->characteristics->filters;
		$counter = 0;
		foreach($get as $key => $item)
		{
			if(!empty($item)) 
			{
				if(isset($filters[$key]))
				{
					var_dump($filters[$key]);
					switch ($filters[$key][1])
					{
						case "text":
							$this->db->where(array("type" => $key, "value" => $item));
							$counter++;
							break;
						case "multy":
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

		if(empty($id))
		{
			return $content = array();
		}
		else
		{
			$this->db->where_in("id", $id);
			$this->db->order_by($order, $direction); 
			$query = $this->db->get("products"/*, $limit, $from*/);
			$result = $query->result();
			empty($result) ? $content = array() : $content = $result;
	
			return $content;
		}
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