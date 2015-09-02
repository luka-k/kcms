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

		$file_path = FCPATH."export/export_{$school_name}.sql";
		
		$file = fopen($file_path, 'w');
		
		ftruncate($file, 0);
		
		foreach($tables as $table)
		{
			echo 'Экспорт базы '.$table.' для школы '.$school->name.'<br />';
			
			fwrite($file, "--".PHP_EOL);
			fwrite($file, "-- Структура таблицы '".$table."'".PHP_EOL);
			fwrite($file, "--".PHP_EOL);
			fwrite($file, PHP_EOL);
				
			fwrite($file, "CREATE TABLE IF NOT EXISTS `".$table."` (".PHP_EOL);
			
			$fields_data = $this->CI->db->field_data($table);
			
			$primary_key = '';
			
			$insert_str = '';
			if($fields_data) foreach($fields_data as $key => $field)
			{
				$str = '';
				
				$insert_str .= "`{$field->name}`";
				
				$str .= "`{$field->name}` {$field->type}";
				if($field->max_length) $str .= "({$field->max_length})";
				if($field->type == 'text' || $field->type == 'varchar') $str .= " COLLATE utf8_unicode_ci ";
				$str .= $field->default ? " DEFAULT '{$field->default}'" : " NOT NULL";
				if($field->name == 'id') $str .= " AUTO_INCREMENT";
			
				if($field->primary_key == 1) $primary_key = $field->name;
				
				if($key <> count($fields_data)-1) 
				{
					$str .= ",".PHP_EOL;
					$insert_str .= ", ";
				}
				fwrite($file, $str);
			}
			
			if(!empty($primary_key))
			{
				fwrite($file, ",".PHP_EOL);
				fwrite($file, "PRIMARY KEY (`{$primary_key}`)");
			}
			
			fwrite($file, PHP_EOL .") ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;". PHP_EOL);
			fwrite($file, PHP_EOL);
						
			if($table <> 'orders' || $table <> 'orders2products')
			{				
				$info = array();
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
						if($categories)
						{
							$categories_ids = $this->CI->catalog->ids_in_array($categories);
							$this->CI->db->where_in('id', $categories_ids);
							$info = $this->CI->db->get('products')->result();
						}
						break;
				}

				if(!empty($info)) 
				{
					fwrite($file, "--".PHP_EOL);
					fwrite($file, "-- Дамп данных таблицы '".$table."'".PHP_EOL);
					fwrite($file, "--".PHP_EOL);
					fwrite($file, PHP_EOL);
					
					fwrite($file, "INSERT INTO `{$table}` ({$insert_str}) VALUES".PHP_EOL);

					foreach($info as $key => $item)
					{
						$str = "(";
						foreach($fields_data as $sub_key => $field)
						{
							$f_n = $field->name;
							$str .= "'".$item->$f_n."'";
							
							if($sub_key == count($fields_data)-1)
							{	
								$str .= $key == count($info)-1 ? ");" : "),";
							}
							else
							{
								$str .= ", ";
							}

						}
						fwrite($file, $str.PHP_EOL);
					}
				}
			}	
			
			fwrite($file, PHP_EOL);
		}
		
		fclose($file);
		//my_dump($sql);
	}
}