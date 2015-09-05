<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Export class
* 
* @package		kcms
* @subpackage	Libraries
* @category	    Export
*/
class Export{

	var $CI;

	function __construct()
	{
		$this->CI =& get_instance();
	}
	
	public function export_school_new($school, $tables)
	{
		$school_name = $this->CI->string_edit->slug($school->name);
		
		$file_path = FCPATH."export/export_{$school_name}.sqlite";
		if(is_file($file_path)) unlink($file_path);
				
		$insert_info = $this->get_insert_info_by_school($school);
		
		foreach($tables as $table)
		{
			echo 'Экспорт базы '.$table.' для школы '.$school->name.'<br />';
		
			$this->export_table($file_path, $table, $insert_info);

			//Проверка

			$sqlite = new sqlite3($file_path);
			$result = $sqlite->query("SELECT * FROM {$table}");
		
			while ($row = $result->fetchArray())
			{
				my_dump($row);
			}
		}	
	}
	
	protected function get_insert_info_by_school($school)
	{
		$child_users = $this->CI->child_users->get_list(array('school_id' => $school->id));
		$menu = $this->CI->menu->get_item_by(array('school_id' => $school->id));
		
		$cards = array();
		$child2products = array();
		if($child_users) 
		{
			foreach($child_users as $ch_u)
			{
				$card_numbers[] = $ch_u->card_number;
			}			
			$this->CI->db->where_in('card_number', $card_numbers);
			$cards = $this->CI->db->get('cards')->result(); 
		
			$ch_ids = $this->CI->catalog->ids_in_array($child_users);
			$this->CI->db->where_in('child_id', $ch_ids);
			$child2products = $this->CI->db->get('child2products')->result();
		}
		
		$categories = array();
		$products = array();
		if($menu)
		{
			$categories = $this->CI->categories->get_list(array('menu_id' => $menu->id));
			
			if(!empty($categories))
			{
				$categories_ids = $this->CI->catalog->ids_in_array($categories);
				$this->CI->db->where_in('id', $categories_ids);
				$products = $this->CI->db->get('products')->result();
			}
		}
		
		$insert_info = array(
			'child_users' => $child_users,
			'menu' => $menu,
			'cards' => $cards,
			'child2products' => $child2products,
			'categories' => $categories,
			'products' => $products
		);
		
		return $insert_info;
	}
	
	protected function export_table($file_path, $table, $insert_info)
	{
		$sqlite = new sqlite3($file_path);
		
		$fields_data = $this->CI->db->field_data($table);
		
		$sql = "";	
		$fields = '';
		$primary_key = "";
		
		if($fields_data) foreach($fields_data as $key => $field)
		{
			$fields .= "[{$field->name}] {$field->type}";

			//$fields .= $field->default ? "DEFAULT {$field->default} " : "NOT NULL ";
			if($field->default) $fields .= " DEFAULT {$field->default}";

			if($field->primary_key == 1) $primary_key = $field->name;
			if($key <> count($fields_data) - 1) $fields .= ",".PHP_EOL;
		}
			
		//if(!empty($primary_key)) $fields .= "," . PHP_EOL . "CONSTRAINT [] PRIMARY KEY ([{$primary_key}])";
		//if(!empty($primary_key)) $fields .= "," . PHP_EOL . "CREATE UNIQUE INDEX {$table}{$primary_key} ON {$table} ({$primary_key});";

		$sql = "CREATE TABLE [{$table}] ({$fields});";

		$sqlite->query($sql);
		
		if(isset($insert_info[$table]) && !empty($insert_info[$table]))
		{
			$sql = "";
		
			if($table == "child_users") $images = array();
			
			foreach($insert_info[$table] as $line)
			{
				$fields = '';
				$values = '';
				$counter = 1;
				
				if($table == "child_users") $images[$line->id] = $line->image_blob;
				
				foreach($line as $key => $value)
				{
					
					$fields .= "{$key}"; 
					
					if($key <> "image_blob")
					{
						$values .= "'{$value}'";
					}
					else
					{
						$values .= "''";
					}
								
					if($counter <> count((array)$line)) 
					{
						$fields .= ', ';
						$values .= ', ';
					}
					
					$counter++;
				}
					
				$sql .= "INSERT INTO {$table} ({$fields}) VALUES ({$values});";
			}
				
			$sqlite->query($sql);
			
			if($table == "child_users")
			{
				foreach($images as $id => $image_blob)
				{
					$query = $sqlite->prepare("UPDATE '{$table}' SET image_blob=? WHERE id=?");

					$query->bindValue(1, $image_blob, SQLITE3_BLOB);
					$query->bindValue(2, $id, SQLITE3_TEXT);
					$run = $query->execute();
				}
			}
		}
		
	}
}