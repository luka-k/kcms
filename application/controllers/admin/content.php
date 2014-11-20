<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Content extends Admin_Controller 
{

	public function __construct()
	{
		parent::__construct();
	}
	
	public function items($type, $id = FALSE)
	{
		$this->menu = $this->menus->set_active($this->menu, $type);
		
		//При помощи функции editors_field_exists находим поле у которого в третьем параметре указано name
		//Это поле используем как поле для колонки Имя
		//Тем самым избавляемся от привязки к названию name(title) и тд.
		//Например делая сайт каталисту я столкнулся если есть четкая привязка к name то к туровым датам надо указывать имя какоенибудь
		//что не всегда удобно.
		$name = editors_field_exists('name', $this->$type->editors);

		$data = array(
			'title' => "Страницы",
			'error' => "",
			'user_name' => $this->user_name,
			'user_id' => $this->user_id,
			'menu' => $this->menu,
			'type' => $type,
			'name' => $name
		);	
				
		if ($this->db->field_exists('sort', $type))
		{
			$order = "sort";
			$direction = "asc";
		}
		else
		{
			$order = FALSE;
			$direction = FALSE;
		}
		
		if($this->db->field_exists('parent_id', $type))
		{
			$type == "products" ? $data['tree'] = $this->categories->get_tree(0, "parent_id") : $data['tree'] = $this->$type->get_tree(0, "parent_id");
		}
		
		if($id == FALSE)
		{
			$data['content'] = $this->$type->get_list(FALSE, $from = FALSE, $limit = FALSE, $order, $direction);
		}
		else
		{
			$data['content'] = $this->$type->get_list(array("parent_id" => $id), $from = FALSE, $limit = FALSE, $order, $direction);
			$data['sortable'] = TRUE;
		}
		
		if(editors_field_exists('img', $this->$type->editors))
		{
			$data['content'] = $this->images->get_img_list($data['content'], $type, "catalog_small");
			$data['images'] = TRUE;
		}
		
		$this->load->view('admin/items.php', $data);
	}
	
	public function item($type, $id = FALSE)
	{
		
		$this->menu = $this->menus->set_active($this->menu, $type);
		
		$data = array(
			'title' => "Редактировать",
			'error' => "",
			'user_name' => $this->user_name,
			'user_id' => $this->user_id,
			'menu' => $this->menu,
			'type' => $type
		);
		
		if($this->db->field_exists('parent_id', $type))
		{
			if($type == "products")
			{
				$data['tree'] = $this->categories->get_tree(0, "parent_id");
				$data['selects'] = array(
					'parent_id' =>$this->categories->get_tree(0, "parent_id")
				);
			}
			else
			{
				$data['tree'] = $this->$type->get_tree(0, "parent_id");
				$data['selects'] = array(
					'parent_id' =>$this->$type->get_tree(0, "parent_id")
				);
			}
		}
		
		if(($id == FALSE)&&(isset($this->$type->new_editors)))
		{
			$data['editors'] = $this->$type->new_editors;
		}
		else
		{
			$data['editors'] = $this->$type->editors;
		}
		
		if($id == FALSE)
		{	
			$content = set_empty_fields($data['editors']);
			$content->is_active = "1";
			$data['content'] = $content;
			$data['content']->img = NULL;
		}	
		else
		{			
			$data['content'] = $this->$type->get_item_by(array('id' => $id));
			$object_info = array(
				"object_type" => $type,
				"object_id" => $data['content']->id
			);
			$data['content']->img = $this->images->get_images($object_info, "catalog_small");		
		}
		$this->load->view('admin/edit_item.php', $data);	
	}
	
	public function edit_item($type, $exit = false)
	{
		$this->menu = $this->menus->set_active($this->menu, $type);
		
		$data = array(
			'title' => "Редактировать",
			'error' => "",
			'user_name' => $this->user_name,
			'user_id' => $this->user_id,
			'editors' => $this->$type->editors,
			'menu' => $this->menu,
			'type' => $type
		);
		
		$data['content'] = $this->$type->editors_post()->data;
		
		if($this->db->field_exists('parent_id', $type))
		{
			if($type == "products")
			{
				$data['tree'] = $this->categories->get_tree(0, "parent_id");
				$data['selects'] = array(
					'parent_id' =>$this->categories->get_tree(0, "parent_id")
				);
			}
			else
			{
				$data['tree'] = $this->$type->get_tree(0, "parent_id");
				$data['selects'] = array(
					'parent_id' =>$this->$type->get_tree(0, "parent_id")
				);
			}
		}
		
		if(($data['content']->id == FALSE)&&(isset($this->$type->new_editors)))
		{
			$data['editors'] = $this->$type->new_editors;
		}
		else
		{
			$data['editors'] = $this->$type->editors;
		}
		
		if($this->$type->editors_post()->error == TRUE)
		{
			//Если валидация не прошла выводим сообщение об ошибке
			$this->load->view('admin/edit_item.php', $data);			
		}
		else
		{			
			//Если валидация прошла успешно проверяем переменную id
			if($data['content']->id == FALSE)
			{
				//Если id пустая создаем новую страницу в базе
				$this->$type->insert($data['content']);
				$data['content']->id = $this->db->insert_id();				
			}
			else
			{
				//Если id не пустая вносим изменения.
				$this->$type->update($data['content']->id, $data['content']);
			}
			
			$field_name = editors_field_exists('img', $data['editors']);
			//Получаем id эдитора который предназначен для загрузки изображения
			//Если например нужно две галлереи для товара то делаем в функции editors_field_exists $field_name массивом и пробегаем ниже по нему
			if(!empty($field_name))
			{
				$object_info = array(
					"object_type" => $type,
					"object_id" => $data['content']->id
				);
		
				$cover_id = $this->input->post("cover_id");
				if ($cover_id <> NULL) $this->images->set_cover($object_info, $cover_id);
				
				if (isset($_FILES[$field_name])&&($_FILES[$field_name]['error'] <> 4)) $this->images->upload_image($_FILES[$field_name], $object_info);
			}

			$exit == false ? redirect(base_url().'admin/content/item/'.$type."/".$data['content']->id) : redirect(base_url().'admin/content/items/'.$type);		
		}	
	}
	
	//Удаление элемента
	public function delete_item($type, $id)
	{
		if($this->$type->delete($id)) redirect(base_url().'admin/content/items/'.$type);
	}
	
	/*--------------Удаление изображения-------------*/
	
	public function delete_img($object_type, $id)
	{
		$object_info = array(
			"object_type" => $object_type,
			"id" => $id
		);
		$item_id = $this->images->delete_img($object_info);
		redirect(base_url().'admin/content/item/'.$object_type."/".$item_id);
	}
}