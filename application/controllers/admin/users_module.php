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
			'content' => new stdClass()
		);
		
		if($filters)
		{
			
			if($filters['groups'] <> "false")
			{
				$users_id = array();
				foreach($filters['groups'] as $group)
				{
					$id_by_group = $this->users2users_groups->get_list(array("group_parent_id" => $group['id']));
					foreach($id_by_group as $item)
					{
						$users_id[] = $item->child_id;
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
				'group_parent_id' => $this->users_groups->get_list(FALSE)
			),
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
				$content = $this->users->get_item_by(array('id' => $id));
				if($field_name) $content->parents = $this->users2users_groups->get_list(array("child_id" => $id));
				
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
					$this->db->where('child_id', $data['content']->id);
					$this->db->delete('users2users_groups');
					foreach($data["users2users_groups"]->$field_name  as $item)
					{
						if(!empty($item))
						{
							$users2users_groups->$field_name = $item;
							$users2users_groups->child_id = $data['content']->id;
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
			$this->db->where('child_id', $id);
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
}