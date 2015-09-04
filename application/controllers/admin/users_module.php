<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users_module extends Admin_Controller 
{

	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$name = editors_field_exists('name', $this->users->editors);
		$this->db->field_exists('sort', "users") ? $order = "sort" : $order = "name";
		$direction = "acs"; 

		$filters = $this->input->post();
		

		$data = array(
			'title' => "Пользователи",
			'error' => "",
			'user' => $this->user,
			'menu' => $this->menu,
			'name' => $name,
			'groups' => $this->users_groups->get_list(FALSE),
			'content' => new stdClass(),
			'url' => "/".$this->uri->uri_string()
		);
		
		if($filters)
		{
			if($filters['groups'] <> "false")
			{
				$users_id = array();
				foreach($filters['groups'] as $group)
				{
					$id_by_group = $this->users2users_groups->get_list(array("users_group_id" => $group['id']));
					foreach($id_by_group as $item)
					{
						$users_id[] = $item->user_id;
					}
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
		
			if(editors_field_exists('img', $this->users->editors))
			{
				$data['content'] = $this->images->get_img_list($data['content'], "users");
				$data['images'] = TRUE;
			}	
		}
		
		if($filters['groups'] == "false" || !isset($filters['groups'])) $filters['groups'] = array();
		$data['filters'] = $filters;

		$this->load->view('admin/users.php', $data);
	}	
	
	public function edit($id = FALSE, $action = "edit", $exit = FALSE)
	{	
		$name = editors_field_exists('name', $this->users->editors);
				
		$data = array(
			'title' => "Пользователи",
			'error' => "",
			'user' => $this->user,
			'menu' => $this->menu,
			'name' => $name,
			'type' => "users",
			'selects' => array(
				'users_group_id' => $this->users_groups->get_list(FALSE)
			),
			'url' => "/".$this->uri->uri_string()
		);	
		
		if(($id == FALSE)&&(isset($this->users->new_editors)))
		{
			$data['editors'] = $this->users->new_editors;
		}
		else
		{
			$data['editors'] = $this->users->editors;
		}
		
		$field_name = editors_field_exists('users2users_groups', $data['editors']);
		
		if($action == "edit")
		{
			if($id == FALSE)
			{
				$content = set_empty_fields($data['editors']);
				if($field_name) $content->parents = array();

				$data['content'] = $content;
				
				$data['content']->img = NULL;
			}
			else
			{
				$content = $this->users->get_item($id);
				if($field_name) $content->parents = $this->users2users_groups->get_list(array("user_id" => $id));
				
				$object_info = array(
					"object_type" => "users",
					"object_id" => $content->id
				);
				$data['content'] = $content;
				$data['content']->img = $this->images->get_images($object_info);
			}
			
			$this->load->view('admin/user.php', $data);
		}
		elseif($action == "save")
		{
			$data['content'] = $this->users->editors_post()->data;

			if($this->users->editors_post()->error == TRUE)
			{
				//Если валидация не прошла выводим сообщение об ошибке
				$this->load->view('admin/user.php', $data);			
			}
			else
			{			
				//Если валидация прошла успешно проверяем переменную id
				if($id == FALSE)
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
			
				$field_name = editors_field_exists('img', $data['editors']);
				//Получаем id эдитора который предназначен для загрузки изображения
				//Если например нужно две галлереи для товара то делаем в функции editors_field_exists $field_name массивом и пробегаем ниже по нему
				if(!empty($field_name))
				{
					$object_info = array(
						"object_type" => "users",
						"object_id" => $data['content']->id
					);
		
					$cover_id = $this->input->post("cover_id");
					if ($cover_id <> NULL) $this->images->set_cover($object_info, $cover_id);
				
					if (isset($_FILES[$field_name])&&($_FILES[$field_name]['error'] <> 4)) $this->images->upload_image($_FILES[$field_name], $object_info);
				}
				
				$field_name = editors_field_exists('users2users_groups', $data['editors']);
				if($field_name && is_array($this->input->post($field_name)))
				{
					$data["users2users_groups"]->$field_name = $this->input->post($field_name);
					$u2u_g = TRUE;
				}
			
				if((isset($u2u_g))&&($u2u_g == TRUE))
				{
					$this->db->where('user_id', $data['content']->id);
					$this->db->delete('users2users_groups');
					foreach($data["users2users_groups"]->$field_name  as $item)
					{
						if(!empty($item))
						{
							$users2users_groups->$field_name = $item;
							$users2users_groups->user_id = $data['content']->id;
							$this->db->insert('users2users_groups', $users2users_groups);
						}
					}
				}
				
				$exit == false ? redirect(base_url().'admin/users_module/edit/'.$data['content']->id) : redirect(base_url().'admin/users_module/');
			}
		}
	}
	
	public function delete_user($id)
	{
		if($this->users->delete($id)) 
		{
			$this->db->where('user_id', $id);
			$this->db->delete('users2users_groups');
			redirect(base_url().'admin/users_module/');
		}
	}

		/*--------------Удаление изображения-------------*/
	
	public function delete_img($id)
	{
		$object_info = array(
			"object_type" => "users",
			"id" => $id
		);
		$item_id = $this->images->delete_img($object_info);
		redirect(base_url().'admin/users_module/edit/'.$item_id.'/edit/');
	}
	
	public function export()
	{
		$group_id = $this->input->post("group");
		
		$fields = $this->db->list_fields('users');
		unset($fields[0]);
		unset($fields[count($fields)]);//Как то я здраво решил что поле secret то же не особо в импорте нужно
		
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
	
	public function import()
	{
		$group_id = $this->input->post("group");
		
		$file_path = FCPATH."download/import.csv";
		
		move_uploaded_file($_FILES['import_file']['tmp_name'], $file_path);
		
		$file = fopen($file_path, "r");
		
		$fields = array();
		while(!feof($file))
		{
			$fields[] =  fgetcsv ($file, 0, ";");
		}
		echo '<html><head><meta charset="utf-8"></head><body>';
		foreach ($fields[0] as $startCol => $groupName)
		{
			if (!trim($groupName))
				continue;
			$groupName = iconv('windows-1251', 'utf-8', $groupName);
			echo '<br>import: '.$groupName.' in column '.$startCol.'<br />';
			$name_key = -1;
			for ($i = 0; $i < 4; $i++)
			{
				if (iconv('windows-1251', 'utf-8', trim($fields[1][$startCol + $i])) == 'Фамилия')
				{
					$name_key = $startCol + $i;
					break;
				}
			}
			if ($name_key == -1)
			{
				echo 'ERROR: first_name NOT FOUND<br>';
				continue;
			}
			echo 'name column: '.$name_key.'<br />';
			$name2_key = -1;
			for ($i = 0; $i < 4; $i++)
			{
				if (iconv('windows-1251', 'utf-8', trim($fields[1][$startCol + $i])) == 'Имя Отчество')
				{
					$name2_key = $startCol + $i;
					break;
				}
			}
			if ($name2_key == -1)
			{
				echo 'ERROR: last_name NOT FOUND<br>';
				continue;
			}
			echo 'last_name column: '.$name2_key.'<br />';
			$email_key = -1;
			for ($i = 0; $i < 4; $i++)
			{
				if (iconv('windows-1251', 'utf-8', trim($fields[1][$startCol + $i])) == 'Почта')
				{
					$email_key = $startCol + $i;
					break;
				}
			}
			if ($email_key == -1)
			{
				echo 'ERROR: email NOT FOUND<br>';
				continue;
			}
			
			echo 'email column: '.$email_key.'<br />';
			
			$user_group = $this->users_groups->get_item_by(array('name' => $groupName));
			if ($user_group)
				echo 'found group: '.$user_group->name.'<br>';
			else {
				$this->users_groups->insert(array('name' => $groupName));
				echo 'create group: '.$user_group->name.'<br>';
				$user_group = $this->users_groups->get_item_by(array('name' => $groupName));
			}
			
			$users = $this->users->get_list(false);
			
			foreach ($users as $user)
			{
				if($this->users->in_group($user->id, $user_group->id))
				{
					$this->users->delete($user->id);
				}
			}
			
			foreach($fields as $key => $item)
			{
				if($key > 1 && trim($item[$email_key]))
				{
					$this->db->insert('users', array('name' => iconv('windows-1251', 'utf-8', trim($item[$name_key])), 'last_name' => iconv('windows-1251', 'utf-8', trim($item[$name2_key])), 'email' => trim($item[$email_key])));
					
					$users2users_groups->users_group_id = $user_group->id;
					$users2users_groups->user_id = $this->db->insert_id();
					$this->db->insert('users2users_groups', $users2users_groups);
				}
			}
		}
		
		echo '<br><br><a href="http://brightberry.ru/admin/users_module/">continue</a>';
	}
}