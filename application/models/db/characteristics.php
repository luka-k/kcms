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
}