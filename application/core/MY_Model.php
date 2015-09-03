<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Model extends CI_Model
{
	protected $_table;
    protected $_primary_key = 'id';
    protected $_active_key = 'is_active';
	
	function __construct()
    {
        parent::__construct();
        $this->_table = strtolower(get_class($this));
    }
	
	/**
	* Возвращает количество записей в таблице
	*
	* @param array $factors
	* @return integer
	*/
	function get_count($factors = FALSE)
	{
		if ($factors)
        {
            $this->db->where($factors);
        }
        return  $this->db->count_all_results($this->_table);
	}
	
	/**
	* Возвращает запись в таблице по $id
	*
	* @param integer $id
	* @return object
	*/
	function get_item($id)
	{
		$id = intval($id);
		if ( ! $id)
		{
			return FALSE;
		}
		return $this->db->where('id', $id)->get($this->_table)->row();
	}
	
	/**
	*Возвращает запись из таблицы по параметру
	*
	* @param array $factors
	* @return object
	*/
	function get_item_by($factors)
	{
		if ( ! $factors)
		{
			return FALSE;
		}
		return $this->db->where($factors)->get($this->_table)->row();
	}
	
	/**
	* Возращает список страниц по параметррам
	* $this->get_list(FALSE) - все страницы
	* $this->get_list() - активные страницы
	* $this->get_list(TRUE, $from, $limit) - 
	* $this->get_list('deleted') - неактивные страницы
	*
	* @param array $factors
	* @param integer $from
	* @param integer $limit
	* @param string $order
	* @param string $direction
	* @return array
	*/
	   
	function get_list($factors = array('is_active' => 1), $from = FALSE, $limit = FALSE, $order = FALSE, $direction = 'asc')
	{
		if (!is_array($factors))
		{
			if (TRUE === $factors)
			{
				$this->db->where($this->_active_key, 1);
			}
			elseif ('deleted' == $factors)
			{
				$this->db->where($this->_active_key, 0);
			}
			elseif ('active' == $factors)
			{
				$this->db->where($this->_active_key, 1);
			}
		}
		elseif ($factors)
		{
			$this->db->where($factors);
		}
		if ($order)
		{
			$this->db->order_by($order,$direction);
		}
		if ($limit == FALSE)
		{
			return $this->db->get($this->_table)->result();
		}
		else
		{
			return $this->db->get($this->_table, $limit, $from)->result();
		}
	}
	
	/**
	* Возращает активные страницы
	*
	* @param integer $from
	* @param integer $limit
	* @param string $order
	* @param string $direction
	* @return array
	*/
	function get_active($from = FALSE, $limit = FALSE, $order = FALSE, $direction = 'asc')
	{
		return $this->get_list(TRUE, $from, $limit, $order, $direction);
	}
	
	/**
    * Возращает неактивные страницы
	*
	* @param integer $from
	* @param integer $limit
	* @param string $order
	* @param string $direction
	* @return array
	*/
	function get_deleted($from = FALSE, $limit = FALSE, $order = FALSE, $direction = 'asc')
	{
		return $this->get_list('deleted', $from, $limit, $order, $direction);
	}
	
	/*
	* Возвращает минимальное значение в столбце $field
	*
	* @param string $field
	* @return string
	*/
	public function get_min($field)
	{
		$this->db->select_min($field);
		$query = $this->db->get($this->_table);
		return $query->row()->price;
	}

	/*
	* Возвращает максимальное значение в столбце $field
	*
	* @param string $field
	* @return string
	*/	
	public function get_max($field)
	{
		$this->db->select_max($field);
		$query = $this->db->get($this->_table);
		return $query->row()->price;
	}
	
	/**
	* Добавляет элемент в таблицу
	* 
	* @param array $fields
	* @param array $data
	* @return bool
	*/
	function add($fields, $data = FALSE)
	{
		foreach ($fields as $field)
		{	
			$this->db->set($field, $this->input->post($field));
		}
		$this->accordion('add');
		return $this->db->insert($this->_table, $data);
	}
	
	/**
	* Проверяет оригинальность данного имени в категории
	* 
	* @param array $fields
	* @return bool
	*/
	function is_unique($fields)
	{
		$query = $this->db->where($fields)->get($this->_table);
		
		return $query->num_rows() > 0 ? FALSE : TRUE;
	}
	
	/**
	* Добавляет данные в таблицу
	*
	* @param array $data
	* @return integer
	*/
	function insert($data = FALSE)
	{
		if($data) $this->db->set($data);

		$this->db->insert($this->_table);
		return $this->db->insert_id();
    }

	/**
	* Удаляет данные  из таблицы
	*
	* @param integr $id
	* @return bool
	*/
	function delete($id)
	{
		return $this->db->delete($this->_table, array('id' => $id)); 
	}
	
	/**
	* @param integer $id
	* @param array $fields
	* @param array $data
	*/
	function edit($id, $fields, $data = FALSE)
	{
		foreach ($fields as $field)
		{
			$this->db->set($field['field'], $this->input->post($field['field']));
		}
		$this->accordion('edit');
		$this->update($id, $data);
    }
	
	/**
	* Обновляет поле страницы
	*
	* @param integer $id
	* @param array $data
	*/
	function update($id, $data = FALSE)
	{
		$id = intval($id);
		if (!$id) return FALSE;
		
		if ($data)
		{
			$this->db->where($this->_primary_key, $id)->update($this->_table, $data);
		}
		else
		{
			$this->db->where($this->_primary_key, $id)->update($this->_table);
		}
	}
	
	/**
	* set records parameter
	*
	* @param integer $id
	* @param string $key
	* @param string $value
	*/
	function set_property($id, $key, $value)
	{
		$this->db->where($this->_primary_key, $id)->set($key, $value)->update($this->_table);
	}
	
	/**
	* Сделать активным
	*
	* @param object $item
	*/
	function enable($item)
	{
		$active_key = $this->_active_key;
		if ($item->$active_key)	return;
		
		$primary_key = $this->_primary_key;
		$this->set_property($item->$primary_key, $active_key, 1);
	}
	
	/**
	* Сделать не активным
	*
	* @param object $item
	*/
	function disable($item)
	{
		$active_key = $this->_active_key;
		if (!$item->$active_key) return;
		
		$primary_key = $this->_primary_key;
		$this->set_property($item->$primary_key, $active_key, NULL);
    }
	
	var $list = array();
	
	/**
	* @param array $data
	* @param string $key
	*/
    function set_related($data, $key = 'id')
	{
		if (!$data)
		{
			return;
		}
		if (is_array($data))
		{
			if (isset($data[$key]))
			{
				$this->list[$data[$key]] = FALSE;
				return;
			}
			foreach ($data as $row)
			{
				if (is_object($row))	
				{
					if (isset($row->$key))
					{
						$this->list[$row->$key] = FALSE;
					}
				}
				elseif (is_array($row))
				{
					if (isset($row[$key]))
					{
						$this->list[$row[$key]] = FALSE;
					}
				}
				elseif (is_numeric($row))
				{
					$this->list[$row] = FALSE;
				}
			}
		}
		elseif (is_object($data))
		{
			if (isset($data->$key))
			{
				$this->list[$data->$key] = FALSE;
			}
		}
		elseif (is_numeric($data))
		{
			$this->list[(int)$data] = FALSE;
		}
	}
	
	/**
	* load list data
	*
	* @param array $list
	* @param string $key
	*/
	function load_related($list = FALSE, $key = 'id')
    {
		if($list) $this->set_related($list, $key);
		
		if(empty($this->list)) return;
		
		$keys = array_keys($this->list);
		$listing = $this->db->where_in($this->_primary_key,$keys)->get($this->_table)->result();
		
		if (!$listing) return;
		
		foreach ($listing as $record)
		{
			$this->list[$record->id] = $record;
		}
	}
    
	/**
	* returns related items
	* 
	* @param array $list
	* @param string $key
	* @return array
	*/
	function related($list = FALSE, $key = 'id')
	{
		$this->load_related($list, $key);
		return $this->list;
	}
    
	/**
	* set or update standart fields 
	* 
	* @param string $action
	*/
	function accordion($action = 'add')
	{
		if ( ! in_array($action, array('add', 'edit')))
		{
			// dont knew what to do
			return;
		}
		// get table
		// found acquaintance fields
		// make some actions
		$this->config->load('tables/'.$this->_table, TRUE);
		$fields = config_item('tables/'.$this->_table);
		if ($action == 'add')
		{
			if (array_key_exists('created', $fields))
			{
				$this->db->set('created',time());
			}
			if (array_key_exists($this->_active_key,$fields))
			{
				$this->db->set($this->_active_key,1);
			}
			if (array_key_exists('uid',$fields))
			{
				if ($this->user)
				{
		
		$this->db->set('uid',$this->user->profile['id']);
				}
			}
		}
		elseif ($action == 'edit')
		{
			if (array_key_exists('created',$fields))
			{
				if (array_key_exists('updated',$fields))
				{
					$this->db->set('updated',time());
				}
			}
			if (array_key_exists('changed',$fields))
			{
				$this->db->set('changed',time());
			}
		}
	}
    
	/**
	* counter increment
	*
	* @param integer $id
	* @param string $field
	*/
	function increment($id, $field)
	{
		$this->db->set($field, $field.' + 1', FALSE)->where($this->_primary_key, $id)->update($this->_table);
	}
    
	/**
	* counter decrement
	*
	* @param integer $id
	* @param string $field
	*/
	function decrement($id, $field)
	{
		$this->db->set($field, $field.' - 1 ', FALSE)->where($this->_primary_key, $id)->update($this->_table);
	}
	
	/**
    * move item up
	* 
	* @param object $item 
	* @param string $sortorder
	*/
	function move_up($item, $sortorder = 'sortorder')
	{
		$active_key = $this->_active_key;
		$prev = $this->db->where('`'.$sortorder.'` < '.$item->$sortorder)->where($active_key, $item->$active_key)->order_by($sortorder, 'DESC')->get($this->_table)->row();
		if ($prev)
		{
			$primary_key = $this->_primary_key;
			$this->db->set($sortorder, $prev->$sortorder)->where($primary_key, $item->$primary_key)->update($this->_table);
			$this->db->set($sortorder, $item->$sortorder)->where($primary_key, $prev->$primary_key)->update($this->_table);
		}
	}
	
	/**
    * move item down
	*
	* @param object $item
	* @param string $sortorder
	*/
	function move_down($item, $sortorder = 'sortorder')
	{
		$active_key = $this->_active_key;
		$prev = $this->db->where('`'.$sortorder.'` > '.$item->sortorder)->where($active_key, $item->is_active)->order_by($sortorder)->get($this->_table)->row();
		if ($prev)
		{
			$primary_key = $this->_primary_key;
			$this->db->set($sortorder, $prev->$sortorder)->where($primary_key, $item->$primary_key)->update($this->_table);
			$this->db->set($sortorder, $item->$sortorder)->where($primary_key, $prev->$primary_key)->update($this->_table);
		}
	}
	
	/**
	* Возвращает древо элементов
	*
	* @param integer $parent_id
	* @param string $parent_field
	* @return array
	*/
	
	public function get_tree($parent_id, $parent_field, $action = "site")
	{
		$branches = $this->get_list(array($parent_field => $parent_id), FALSE, FALSE, "name", "asc");
		if($action == "site") $branches = $this->prepare_list($branches);
		if ($branches) foreach ($branches as $i => $b)
		{
			$branches[$i]->childs = $this->get_tree($b->id, $parent_field);
			$branches[$i]->count_sub_products =count($this->catalog->get_products($b->id, "name", "asc"));
			$branches[$i]->class = $this->is_active($branches[$i]->id) ? "active" : "noactive";
		}			

		return $branches;
	}
	
	/*
	* Проверяте пренадлежит ли ветка к активной в админ панелит
	*
	* @param integer $branch_id
	* @return bool
	*/
	private function is_active($branch_id)
	{
		$table = $this->_table;
		$root_id = $this->uri->segment($this->uri->total_segments());
		
		$item = $this->$table->get_item($root_id);
		if(!empty($item))
		{
			if($item->id == $branch_id) return TRUE;
			
			$parent_id = $item->parent_id;
			while($parent_id <> 0)
			{
				$item = $this->$table->get_item_by(array("id" => $parent_id));
				if($item->id == $branch_id) return TRUE;
				$parent_id = $item->parent_id;
			}	
		}
		return FALSE;
	}
	
	/**
	*
	* @param object $info
	* @return object
	*/
	public function prepare_list($info)
	{
		foreach($info as $key => $item)
		{
			$info[$key] = $this->prepare($item);
		}
		return $info;
	}
	
	/**
	* Обрабатывает данные перед внесением в базу
	*
	* @return object
	*/
	public function editors_post()
	{
		$return = new stdCLass();

		$editors = $this->editors;

		foreach ($editors as $type => $edit)
		{
			foreach ($edit as $key => $value)
			{
				if (isset($value[2])&&!empty($value[2])) 
				{	
					$validation_config[] = array(
						'field' => $key,
						'label' => $value[0],
						'rules' => $value[2]
					);
				}
				if ($this->db->field_exists($key, $this->_table))
				{	
					if($key == "password" && empty($_POST[$key])) 
					{	
						unset($editors[$type][$key]);
					}
					elseif($key == "image_blob")
					{				
						if(isset($_FILES['image_blob']) && $_FILES['image_blob']['error'] == UPLOAD_ERR_OK)
						{						
							$return->$key = file_get_contents($_FILES['image_blob']["tmp_name"]);
						}
					}
					else
					{ 
						$return->$key = $_POST[$key];
					}
				}
			}
		}
		
		$this->form_validation->set_rules($validation_config);
		$this->form_validation->run();
	
		foreach($return as $key => $value)
		{
			if($key <> 'image_blob')
			{
				$edit_value = set_value($key);
				if(!empty($edit_value)) $return->$key = $edit_value;
			}
		}

		return $return;
	}	
} 
