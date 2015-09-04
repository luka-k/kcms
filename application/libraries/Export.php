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
		$school_children = $this->CI->child_users->get_list(array('school_id' => $school->id));
		$school_menu = $this->CI->menu->get_item_by(array('school_id' => $school->id));
		
		$file_path = FCPATH."export/export_{$school_name}.sqlite";
		if(is_file($file_path)) unlink($file_path);
		
		$config = array(
			'hostname' => '',
			'database' => 'sqlite:'.$file_path,
			'dbdriver' => 'pdo',
			'dbprefix' => '',
			'pconnect' => TRUE,
			'db_debug' => TRUE,
			'cache_on' => FALSE,
			'cachedir' => '',
			'char_set' => 'utf8',
			'dbcollat' => 'utf8_general_ci',
			'swap_pre' => '',
			'autoinit' => TRUE,
			'stricton' => FALSE
		);
		
		$sqlite = $this->CI->load->database($config, TRUE);
	
		foreach($tables as $table)
		{
			echo 'Экспорт базы '.$table.' для школы '.$school->name.'<br />';

			$sql = "CREATE TABLE ".$table."(";
			
			$fields_data = $this->CI->db->field_data($table);
			

			if($fields_data) foreach($fields_data as $key => $field)
			{
				
				$sql .= "{$field->name} {$field->type} ";

				$sql .= $field->default ? "DEFAULT {$field->default} " : "NOT NULL ";
				if($field->primary_key == 1) $sql .= "PRIMARY KEY ";
				if($key <> count($fields_data)-1) 
				{
					$sql .= ",".PHP_EOL;
				}
			}
			$sql .= ");";
			
			$sqlite->query($sql);
			
			if($table <> 'orders' || $table <> 'orders2products')
			{				
				/*$info = array();
				switch ($table)
				{
					case 'child_users':
						$info = $school_children;
						break;
					case 'cards':
						$card_numbers = array();
						if($school_children) foreach($school_children as $s_ch)
						{
							$card_numbers[] = $s_ch->card_number;
						}
						
						if(!empty($card_numbers)) 
						{	
							$this->CI->db->where_in('card_number', $card_numbers);
							$info = $this->CI->db->get('cards')->result(); 
						}
						break;
					case 'child2products':
						$ch_ids = $this->CI->catalog->ids_in_array($school_children);
						if(!empty($ch_ids))
						{
							$this->CI->db->where_in('child_id', $ch_ids);
							$info = $this->CI->db->get('child2products')->result();
						}
						break;
					case 'categories':

						if($school_menu) $info = $this->CI->categories->get_list(array('menu_id' => $school_menu->id));
						break;
					case 'products':
						if($school_menu) $categories = $this->CI->categories->get_list(array('menu_id' => $school_menu->id));
						if(isset($categories))
						{
							$categories_ids = $this->CI->catalog->ids_in_array($categories);
							if($categories_ids)
							{
								$this->CI->db->where_in('id', $categories_ids);
								$info = $this->CI->db->get('products')->result();
							}
						}
						break;
				}
				
				if(!empty($info)) 
				{
					foreach($info as $line)
					{
						$sqlite->insert($table, $line);
					}
				}*/
				
				
			}
			
		}
		//$sqlite->insert('cards', array("id" => 1, "card_number" => "1", "card_day_limit" => "500", "card_credit_limit" => "0", "card_balance" => "5000"));
		//$sqlite->query("INSERT INTO cards (id, card_number, card_day_limit, card_credit_limit, card_balance) VALUES ('1', '1', '500', '0', '5000')");
		//my_dump($sqlite->get('cards')->result());
		$dbb = new sqlite3($file_path);
		
		$dbb->query("BEGIN;
			CREATE TABLE foo(id INTEGER PRIMARY KEY, name CHAR(255));
			INSERT INTO foo (name) VALUES('Ilia');
			INSERT INTO foo (name) VALUES('Ilia2');
			INSERT INTO foo (name) VALUES('Ilia3');
			COMMIT;"); 
		$result = $dbb->query("SELECT * FROM foo");
		while ($row = $result->fetchArray())
		{
			echo $row['name'] . "<br />";
		}
		
	}
}