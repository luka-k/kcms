<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Users_module class
*
* @package		kcms
* @subpackage	Controllers
* @category	    users
*/
class Users_module extends Admin_Controller 
{

	public function __construct()
	{
		parent::__construct();
	}
	
	/**
	* Вывод списка пользователей
	*/
	public function index()
	{
		$name = editors_get_name_field('name', $this->users->editors);
		$order = $this->db->field_exists('sort', "users") ? "sort" : "name";
		$direction = "acs"; 

		$filters = $this->input->post();
		
		$data = array(
			'title' => "Пользователи",
			'name' => $name,
			'groups' => $this->users_groups->get_list(FALSE),
			'content' => new stdClass(),
		);
		$data = array_merge($this->standart_data, $data);

		if($filters)
		{
			if(isset($filters['groups']))
			{
				
				$users_id = array();
				foreach($filters['groups'] as $group)
				{
					$users_id = array_merge($users_id, $this->table2table->get_fixing('users2users_groups', 'user_id', 'users_group_id', $group));
				}

				!empty($users_id) ? $this->db->where_in('id', $users_id) : $this->load->view('admin/users.php', $data);
			}
			
			if($filters['name'])
			{
				$user = $this->users->get_item_by(array("name" => $filters['name']));
				$user ? redirect(base_url()."admin/users_module/edit/".$user->id."/edit") : $this->db->like('name', $filters['name']);
			}
			
			if($filters['email'])
			{
				$user = $this->users->get_item_by(array("email" => $filters['email']));
				$user ? redirect(base_url()."admin/users_module/edit/".$user->id."/edit") : $this->db->like('email', $filters['email']);
			}
			
			$query = $this->db->get("users");
			$data['content'] = $query->result();
		}
		else
		{
			$data['content'] = $this->users->get_list(FALSE, FALSE, FALSE, $order, $direction);
		
			if(editors_get_name_field('img', $this->users->editors))
			{
				foreach($data['content'] as $key => $item)
				{
					$data['content'][$key]->image = $this->images->get_cover(array("object_type" => "users", "object_id" => $item->id));
				}
				$data['images'] = TRUE;
			}	
		}
		
		if($filters['groups'] == "false" || !isset($filters['groups'])) $filters['groups'] = array();
		$data['filters'] = $filters;

		$this->load->view('admin/users.php', $data);
	}	
	
	/**
	* Редактирование, сохранение пользователя
	*
	* @param integer $id
	* @paaram string $action
	* @param bool $exit
	*/
	public function edit($action = 'edit', $id = FALSE, $exit = FALSE)
	{	
		$name = editors_get_name_field('name', $this->users->editors);
				
		$data = array(
			'title' => 'Пользователи',
			'name' => $name,
			'type' => "users",
			'editors' => $this->users->editors,
			'selects' => array(
				'users2users_groups' => $this->users_groups->get_list(FALSE)
			),
			'url' => '/'.$this->uri->uri_string()
		);	
		
		$data = array_merge($this->standart_data, $data);
		
		$field_name = editors_get_name_field('users2users_groups', $data['editors']);
		
		if($action == "edit")
		{
			if($id == FALSE)
			{
				$data['content'] = set_empty_fields($data['editors']);
				if($field_name) $data['content']->parents = array();
			}
			else
			{
				$data['content'] = $this->users->get_item($id);
				$data['content']->images = $this->images->prepare_list($this->images->get_list(array("object_type" => "users", "object_id" => $data['content']->id)));
				if($field_name) $data['content']->parents = $this->users2users_groups->get_list(array("user_id" => $id));	
			}
			
			$this->load->view('admin/user.php', $data);
		}
		elseif($action == "save")
		{
			$data['content'] = $this->users->editors_post();
			if($data['content']->id == FALSE)
			{
				//Если id пустая создаем новую страницу в базе
				$this->users->insert($data['content']);
				$data['content']->id = $this->db->insert_id();	
								
			}
			else
			{
				//Если id не пустая вносим изменения.
				$this->users->update($data['content']->id, $data['content']);
			}
			
			$field_name = editors_get_name_field('img', $data['editors']);
			//Получаем id эдитора который предназначен для загрузки изображения
			//Если например нужно две галлереи для товара то делаем в функции editors_get_name_field $field_name массивом и пробегаем ниже по нему
			if(!empty($field_name))
			{
				$object_info = array(
					"object_type" => "users",
					"object_id" => $data['content']->id
				);
				
				if (isset($_FILES[$field_name])&&($_FILES[$field_name]['error'] <> 4)) $this->images->upload_image($_FILES[$field_name], $object_info);
			}

			$this->table2table->delete_fixing('users2users_groups', 'user_id', $data['content']->id);
			$this->table2table->set_tables_fixing('users2users_groups', 'users_group_id', 'user_id', $data['content']->id);
			
			$redirect_path = $exit == false ? 'admin/users_module/edit/edit/'.$data['content']->id : 'admin/users_module/';
	
			redirect(base_url().$redirect_path);
		}
	}
	
	/**
	* Удаление пользователя
	*/
	public function delete_user($id)
	{
		if($this->users->delete($id)) 
		{
			$this->db->where('user_id', $id);
			$this->db->delete('users2users_groups');
			redirect(base_url().'admin/users_module/');
		}
	}

	/**
	* Удаление авватара
	*/
	public function delete_img($id)
	{
		$object_info = array(
			"object_type" => "users",
			"id" => $id
		);
		$item_id = $this->images->delete_img($object_info);
		redirect(base_url().'admin/users_module/edit/'.$item_id.'/edit/');
	}
	
	/**
	* Экспорт пользоватей
	*/
	public function export()
	{
		$group_id = $this->input->post("group");
		
		$fields = $this->db->list_fields('users');
		unset($fields[0]);
		unset($fields[count($fields)]);
		
		$users = $this->users->group_list($group_id);

		$file_path = FCPATH."download/export.csv";
		$file = fopen($file_path, "w");
		ftruncate($file, 0);
		
		fputcsv($file, $fields, ";");
		
		if(!empty($users)) foreach($users as $user)
		{
			unset($user->id);
			
			unset($user->secret);
			$fields = (array)$user;
			fputcsv($file, $fields, ";");
		}
		
		fclose($file);
		
		redirect(base_url()."download/export.csv", 307);
	}
	
	/**
	* Импорт пользователей
	*/
	public function import()
	{
		$group_id = $this->input->post("group");
		
		$file_path = FCPATH."download/import.csv";
		
		move_uploaded_file($_FILES['import_file']['tmp_name'], $file_path);
		
		$file = fopen($file_path, "r");
		
		$fields = array();
		while(!feof($file))
		{
			$fields[] = fgetcsv($file, 0, ";");
		}
		
		$email_key = array_search("email", $fields[0]);
		
		foreach($fields as $key => $item)
		{
			if($key <> 0)
			{
				$field = array();
				foreach($item as $key_2 => $value)
				{
					$field[$fields[0][$key_2]] = $value;
				}

				if($this->users->is_unique(array("email" => $item[$email_key])))
				{
					$this->db->insert('users', $field);
					
					
					$users2users_groups->users_group_id = $group_id;
					$users2users_groups->user_id = $this->db->insert_id();
					$this->db->insert('users2users_groups', $users2users_groups);
				}
				else
				{
					$user = $this->users->get_item_by(array("email" => $item[$email_key]));
					
					if(!$this->users->in_group($user->id, $group_id))
					{
						$users2users_groups->users_group_id = $group_id;
						$users2users_groups->user_id = $user->id;
						$this->db->insert('users2users_groups', $users2users_groups);
					}
				}
			}
		}
		
		redirect(base_url().'admin/users_module/');
	}
}