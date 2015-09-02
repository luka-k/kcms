<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Table2table extends MY_Model
{
	function __construct()
	{
        parent::__construct();
	}
	
	/**
	*
	*
	*/
	public function set_tables_fixing($table, $first_field, $second_field, $id)
	{
		$fixing_info = $this->input->post($table);

		if($fixing_info <> FALSE)
		{
			if(is_array($fixing_info))
			{
				$fixing_info = array_unique($fixing_info);
				foreach($fixing_info  as $item)
				{	
					$this->db->insert($table, array($first_field => $item, $second_field => $id));
				}
			}
			elseif($fixing_info == "parent")
			{
				
				$this->db->insert($table, array($first_field => 0, $second_field => $id));
			}
		}
	}
	
	/**
	* Возращает ids родительских категорий
	*
	* @param string $table - таблица из которой брать привязки("category2category", "product2category")
	* @param string $first_field
	* @param string $second_field
	* @param integer $child_id
	*/
	public function get_parent_ids($table, $first_field, $second_field, $child_id)
	{
		$result = $this->db->get_where($table, array($second_field => $child_id))->result();

		$parent_ids = array();
		if($result) foreach($result as $r)
		{
			$parent_ids[] = $r->$first_field;
		}
		
		return $parent_ids;
	}
	
	
	/**
	* Возращает ids детских категорий
	*
	* @param string $table - таблица из которой брать привязки("category2category", "product2category")
	* @param string $first_field
	* @param string $second_field
	* @param integer $child_id
	*/
	public function get_child_ids($table, $first_field, $second_field, $parent_id)
	{
		$result = $this->db->get_where($table, array($first_field => $parent_id))->result();

		$parent_ids = array();
		if($result) foreach($result as $r)
		{
			$parent_ids[] = $r->$second_field;
		}
		
		return $parent_ids;
	}
	
	public function delete_fixing($table, $second_field, $id)
	{
		$this->db->where($second_field, $id);
		$this->db->delete($table);
	}
}