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
	
	public function export_school($school, $tables)
	{
		$school_name = $this->CI->string_edit->slug($school->name);
		$file_path = FCPATH."export/export_{$school_name}.sqlite";
		
		if(is_file($file_path)) unlink($file_path);
		
		$sqlite = new sqlite3($file_path);
		
		$sql = file_get_contents(FCPATH."export/sql/export.sql");
		$sqlite->query($sql);
		
		$insert_info = $this->get_school_info($school->id, $sqlite);
		
		foreach($tables as $table)
		{
			if(isset($insert_info[$table]) && !empty($insert_info[$table]))
			{
				echo '<strong>Экспорт базы '.$table.' для школы '.$school->name.'</strong><br />';
			
				//$this->CI->benchmark->mark('code_start');
				
				$this->export_table($sqlite, $file_path, $table, $insert_info[$table]);
			
				//$this->CI->benchmark->mark('code_end');
				//echo 'Затраченое время - '.$this->CI->benchmark->elapsed_time('code_start', 'code_end').'<br />';
			}
			
			//Проверка

			/*$sqlite = new sqlite3($file_path);
			$result = $sqlite->query("SELECT * FROM {$table}");
		
			while ($row = $result->fetchArray())
			{
				my_dump($row);
			}*/
		}
	}
	
	private function get_school_info($school_id, $sqlite)
	{	
		$this->CI->db->where('school_id', $school_id);
		$this->set_fields('child_users', $sqlite);
		$child_users = $this->CI->db->get('child_users')->result();
		
		$this->CI->db->where('school_id', $school_id);
		$menu = $this->CI->db->get('menu')->row();
		
		$cards = array();
		$child2product = array();
		if($child_users) 
		{
			foreach($child_users as $ch_u)
			{
				$card_numbers[] = $ch_u->card_number;
			}			
			$this->CI->db->where_in('card_number', $card_numbers);
			$this->set_fields('cards', $sqlite);
			$cards = $this->CI->db->get('cards')->result(); 
		
			$ch_ids = $this->CI->catalog->ids_in_array($child_users);
			$this->CI->db->where_in('child_user_id', $ch_ids);
			$this->set_fields('child2product', $sqlite);
			$child2product = $this->CI->db->get('child2product')->result();
		}
		
		$categories = array();
		$products = array();
		if($menu)
		{
			$this->CI->db->where('menu_id', $menu->id);
			$this->set_fields('categories', $sqlite);
			$categories = $this->CI->db->get('categories')->result(); 
			
			if(!empty($categories))
			{
				$categories_ids = $this->CI->catalog->ids_in_array($categories);
				$this->CI->db->where_in('id', $categories_ids);
				$this->set_fields('products', $sqlite);
				$products = $this->CI->db->get('products')->result();
			}
		}
		
		$insert_info = array(
			'child_users' => $child_users,
			'cards' => $cards,
			'child2product' => $child2product,
			'categories' => $categories,
			'products' => $products
		);
		
		return $insert_info;
	}
	
	private function set_fields($table, $sqlite)
	{
		$result = $sqlite->query("SELECT * FROM {$table}");

		$table_fields = array();
		
		for($i = 0; $i < $result->numColumns(); $i++)
		{
			$this->CI->db->select($result->columnName($i));
		}
	}
	
	private function export_table($sqlite, $file_path, $table, $insert_info)
	{
		$sql = "";
		if($table == "child_users") $images = array();
		
		$val = array();
		foreach($insert_info as $line)
		{ 
			$fields = '';
			$values = '';
			$counter = 1;	
				
			if($table == "child_users") $images[$line->id] = $line->image;
				
			foreach($line as $key => $value)
			{
				$fields .= "{$key}"; 
				
				$values .= $key <> 'image' ? "'{$value}'" : "''";
				if($counter <> count((array)$line)) 
				{
					$fields .= ', ';
					$values .= ', ';
				}
				$counter++;
			}				
			
			$val[] = $values;
		}
				
		$sql .= "INSERT INTO {$table} ({$fields}) VALUES";
		foreach($val as $key => $v)
		{
			$sql .= "({$v})";
			if($key <> count($val) - 1)
			{
				$sql .= ', ';
			}
		}
		
		//$this->CI->benchmark->mark('start');
		//echo $sql.'<br />';
		$sqlite->query($sql);
		
		//$this->CI->benchmark->mark('end');
		//echo "Время на запрос - ".$this->CI->benchmark->elapsed_time('start', 'end').'<br />';
		if($table == "child_users")
		{
			foreach($images as $id => $image)
			{
				$query = $sqlite->prepare("UPDATE '{$table}' SET image=? WHERE id=?");
				$query->bindValue(1, $image, SQLITE3_BLOB);
				$query->bindValue(2, $id, SQLITE3_TEXT);
				$run = $query->execute();
			}
		}
	}
}