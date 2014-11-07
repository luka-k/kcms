<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Model extends CI_Model
{
	protected $_table;
    protected $_primary_key = 'id';
    protected $_active_key = 'is_active';
		
	private $active_branch = array();
	
	function __construct()
    {
        parent::__construct();
        $this->_table = strtolower(get_class($this));
    }
	
	//Возращает количество записей в таблице
	//$factors условие where для фильтра элементов
	//$factors ассоциативный массив	
	function get_count($factors = FALSE)
	{
		if ($factors)
        {
            $this->db->where($factors);
        }
        return  $this->db->count_all_results($this->_table);
	}
	
	//Возвращает запись в таблице по $id
	function get_item($id)
	{
		$id = intval($id);
		if ( ! $id)
		{
			return FALSE;
		}
		return $this->db->where('id', $id)->get($this->_table)->row();
	}
	
	//Возвращает запись из таблицы по параметру
	//$factors ассоциативный массив
	function get_item_by($factors)
	{
		if ( ! $factors)
		{
			return FALSE;
		}
		return $this->db->where($factors)->get($this->_table)->row();
	}
	
	//Возращает список страниц по параметррам
	//$this->get_list(FALSE) - все страницы
	//$this->get_list() - активные страницы
	//$this->get_list(TRUE, $from, $limit) - 
	//$this->get_list('deleted') - неактивные страницы
	//$this->get_list(array(
        //'is_active' => TRUE, 
        //'counter >=' => 10
        //),
        //$from,
        //FALSE,
        //'created',
        //'desc'
       // )
	   
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
	
	//Возращает активные страницы
	function get_active($from = FALSE, $limit = FALSE, $order = FALSE, $direction = 'asc')
	{
		return $this->get_list(TRUE, $from, $limit, $order, $direction);
	}
	
    //Возращает неактивные страницы
	function get_deleted($from = FALSE, $limit = FALSE, $order = FALSE, $direction = 'asc')
	{
		return $this->get_list('deleted', $from, $limit, $order, $direction);
	}
	
	//Добавляет элемент в таблицу
	function add($fields, $data = FALSE)
	{
		foreach ($fields as $field)
		{	
			//var_dump( $field);
			$this->db->set($field, $this->input->post($field));
		}
		$this->accordion('add');
		return $this->db->insert($this->_table, $data);
	}

	//Проверяем оригинальность данного имени в категории.
	function non_requrrent($fields)
	{
		$query = $this->db->where($fields)->get($this->_table);
		if ($query->num_rows() > 0)
		{
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	//Добавляет данные в таблицу
	function insert($data = FALSE)
	{
		if ($data)
		{
			$this->db->set($data);
		}
		$this->db->insert($this->_table);
		return $this->db->insert_id();
    }

	function delete($id)
	{
		return $this->db->delete($this->_table, array('id' => $id)); 
	}
	
	function edit($id, $fields, $data = FALSE)
	{
		foreach ($fields as $field)
		{
			$this->db->set($field['field'], $this->input->post($field['field']));
		}
		$this->accordion('edit');
		$this->update($id, $data);
    }
	
	//Обновляет поле страницы
	function update($id, $data = FALSE)
	{
		$id = intval($id);
		if (!$id)
		{	
			return FALSE;
		}
		
		if ($data)
		{
			$this->db->where($this->_primary_key, $id)->update($this->_table, $data);
		}
		else
		{
			$this->db->where($this->_primary_key, $id)->update($this->_table);
		}
	}
	
	// set records parameter
	function set_property($id, $key, $value)
	{
		$this->db->where($this->_primary_key, $id)->set($key, $value)->update($this->_table);
	}
	
	//Сделать активным
	function enable($item)
	{
		$active_key = $this->_active_key;
		if ($item->$active_key)
		{
			return;
		}
		$primary_key = $this->_primary_key;
		$this->set_property($item->$primary_key, $active_key, 1);
	}
	
	//Сделать не активным
	function disable($item)
	{
		$active_key = $this->_active_key;
		if (!$item->$active_key)
		{
			return;
		}
		$primary_key = $this->_primary_key;
		$this->set_property($item->$primary_key, $active_key, NULL);
    }
	
	var $list = array();
	
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
	
	// load list data
	function load_related($list = FALSE, $key = 'id')
    {
		if ($list)	
		{	
			$this->set_related($list, $key);
		}
		if (empty($this->list))
		{
			return;
		}
		$keys = array_keys($this->list);
		$listing = $this->db->where_in($this->_primary_key,$keys)->get($this->_table)->result();
		if (!$listing)
		{
			return;
		}
		foreach ($listing as $record)
		{
			$this->list[$record->id] = $record;
		}
	}
    
	// returns related items
	function related($list = FALSE, $key = 'id')
	{
		$this->load_related($list, $key);
		return $this->list;
	}
    
	// set or update standart fields 
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
    
	// counter increment
	function increment($id, $field)
	{
		$this->db->set($field, $field.' + 1',FALSE)->where($this->_primary_key,$id)->update($this->_table);
	}
    
	// counter decrement
	function decrement($id,$field)
	{
		$this->db->set($field,$field . ' - 1 ',FALSE)->where($this->_primary_key,$id)->update($this->_table);
	}
	
    // move item up
	function move_up($item,$sortorder = 'sortorder')
	{
		$active_key = $this->_active_key;
		$prev = $this->db->where('`'.$sortorder.'` < '.$item->$sortorder)->where($active_key,$item->$active_key)->order_by($sortorder,'DESC')->get($this->_table)->row();
		if ($prev)
		{
			$primary_key = $this->_primary_key;
			$this->db->set($sortorder,$prev->$sortorder)->where($primary_key, $item->$primary_key)->update($this->_table);
			$this->db->set($sortorder,$item->$sortorder)->where($primary_key, $prev->$primary_key)->update($this->_table);
		}
	}
	
    // move item down
	function move_down($item,$sortorder = 'sortorder')
	{
		$active_key = $this->_active_key;
		$prev = $this->db->where('`'.$sortorder.'` > '.$item->sortorder)->where($active_key,$item->is_active)->order_by($sortorder)->get($this->_table)->row();
		if ($prev)
		{
			$primary_key = $this->_primary_key;
			$this->db->set($sortorder,$prev->$sortorder)->where($primary_key,$item->$primary_key)->update($this->_table);
			$this->db->set($sortorder,$item->$sortorder)->where($primary_key,$prev->$primary_key)->update($this->_table);
		}
	}
	
	public function get_site_tree($parent_id, $parent_id_field)
	{
		return $this->get_sub_tree($parent_id, $parent_id_field, $this->active_branch);
	}
	
	public function get_tree($parent_id, $parent_id_field)
	{
		$this->url_model->admin_url_parse();
		return $this->get_sub_tree($parent_id, $parent_id_field, $this->active_branch);
	}
	
	public function get_sub_tree($parent_id, $parent_id_field, $active_branch)
	{
		$branches = $this->get_list(array($parent_id_field => $parent_id));
		if ($branches) foreach ($branches as $i => $b)
		{
			$branches[$i]->childs = $this->get_sub_tree($b->id, $parent_id_field, $active_branch);
			if(!($this->set_active_class($active_branch, $branches[$i]))) $branches[$i]->class = "noactive";
		}		
		return $branches;
	}
	
	public function add_active($id)
	{
		$this->active_branch[] = $id;
	}
	
	private function set_active_class($active_branch, $branch)
	{
		foreach($active_branch as $element)
		{
			if($branch->id == $element)
			{
				$branch->class = "active";
				return TRUE;
			}
		}	
	}
	
	public function get_prepared_list($info)
	{
		foreach($info as $key => $item)
		{
			$info[$key] = $this->prepare($item, "1");
		}
		return $info;
	}
	
	function editors_post()
	{
		$post = $_POST;
		
		$return = new stdCLass();
		
		if(empty($post['id'])&&(isset($this->new_editors)))
		{
			$editors = $this->new_editors;
		}
		else
		{
			$editors = $this->editors;
		}
		
		foreach ($editors as $edit)
		{
			foreach ($edit as $key => $value)
			{
				if (isset($value[2])) 
				{	
					$validation_config[] = array(
						'field' => $key,
						'label' => $value[0],
						'rules' => $value[2]);
				}
				if ($this->db->field_exists($key, $this->_table))
				{
					$return->data->$key = $post[$key];
				}
			}
		}
		$this->form_validation->set_rules($validation_config);
		
		if($this->form_validation->run())
		{
			unset($return->data);
			foreach ($editors as $edit)
			{
				foreach ($edit as $key => $value)
				{
				
					if ($this->db->field_exists($key, $this->_table))
					{
						$return->data->$key = htmlspecialchars_decode(set_value($key));
					}		
				}
			}
			$return->error = FALSE;
		}
		else
		{
			$return->error = TRUE;
		}
		
		return $return;
	}	
} 