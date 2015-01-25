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
		
		isset($this->$type->admin_left_column) ? $left_column = $this->$type->admin_left_column: $left_column = "off";

		$data = array(
			'title' => "Страницы",
			'error' => "",
			'user_name' => $this->user_name,
			'user_id' => $this->user_id,
			'menu' => $this->menu,
			'left_column' => $left_column,
			'type' => $type,
			'name' => $name
		);	

		
		$this->db->field_exists('sort', $type) ? $order = "sort" : $order = $name;
		$direction = "acs";
		
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
			$type == "emails" ? $parent = "type" : $parent = "parent_id";
			$data["parent_id"] = $id;
			$data['content'] = $this->$type->get_list(array($parent => $id), $from = FALSE, $limit = FALSE, $order, $direction);
			$data['sortable'] = TRUE;
		}
		
		if(editors_field_exists('img', $this->$type->editors))
		{
			$data['content'] = $this->images->get_img_list($data['content'], $type);
			$data['images'] = TRUE;
		}

		$this->load->view('admin/items.php', $data);
	}
	
	public function item($acting, $type, $id = FALSE, $exit = FALSE)
	{
		$this->menu = $this->menus->set_active($this->menu, $type);
		
		isset($this->$type->admin_left_column) ? $left_column = $this->$type->admin_left_column: $left_column = "off";
		
		$data = array(
			'title' => "Редактировать",
			'error' => "",
			'user_name' => $this->user_name,
			'user_id' => $this->user_id,
			'menu' => $this->menu,
			'left_column' => $left_column,
			'type' => $type
		);
		
		if($this->db->field_exists('parent_id', $type))
		{
			$type == "products" ? $tree = $this->categories->get_tree(0, "parent_id") : $tree = $this->$type->get_tree(0, "parent_id");
			$data['tree'] = $tree;
			$data['selects']['parent_id'] = $tree;
		}
		
				
		if(($id == FALSE)&&(isset($this->$type->new_editors)))
		{
			$data['editors'] = $this->$type->new_editors;
		}
		else
		{
			$data['editors'] = $this->$type->editors;
		}
		
		if($type == "emails")
		{
			$data['selects']['users_type'] = $this->users_groups->get_list(FALSE);
		}
		
		if($type == "dealers")
		{
			$this->config->load('dealers_config');
			$region = $this->config->item('region');
			asort($region);
			$data['selects']['region'] = $region;
		}
		
		if($acting == "edit")
		{
			if($id == FALSE)
			{	
				$content = set_empty_fields($data['editors']);
				
				if($this->db->field_exists('parent_id', $type))
				{
					$parent_id = $this->input->get('parent_id');
					$content->parent_id = $parent_id;
				}
				$content->is_active = "1";
				
				if($type == "emails") $content->type = 2;

				$data['content'] = $content;
				$data['content']->img = NULL;
				$field_name = editors_field_exists('ch', $data['editors']);
				if(!empty($field_name))
				{
					$this->config->load('characteristics_config');
					$data['content']->ch_select = $this->config->item('characteristics_type');
					$data['content']->characteristics = NULL;
				}
			}	
			else
			{			
				$data['content'] = $this->$type->get_item_by(array('id' => $id));
				$object_info = array(
					"object_type" => $type,
					"object_id" => $data['content']->id
				);
				$data['content']->img = $this->images->get_images($object_info);
				$field_name = editors_field_exists('ch', $data['editors']);
				if(!empty($field_name))
				{
					$this->config->load('characteristics_config');
					$data['ch_select'] = $this->config->item('characteristics_type');
					$data['content']->characteristics = $this->characteristics->get_list(array("object_id" => $id,"object_type" => $type));
					foreach($data['content']->characteristics as $characteristic)
					{
						foreach($data['ch_select'] as $key => $type)
						{
							if($characteristic->type == $key) $characteristic->name = $type;
						}
					}
				}
			}
			$this->load->view('admin/edit_item.php', $data);
		}
		elseif($acting == "save")
		{
			$data['content'] = $this->$type->editors_post()->data;
			
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
				
				isset($data['content']->parent_id) ? $p_id = $data['content']->parent_id : $p_id = "";
				if($type == "emails") $p_id = $data['content']->type;

				$exit == false ? redirect(base_url().'admin/content/item/edit/'.$type."/".$data['content']->id) : redirect(base_url().'admin/content/items/'.$type."/".$p_id);

				//$exit == false ? redirect(base_url().'admin/content/item/edit/'.$type."/".$data['content']->id) : redirect(base_url().'admin/content/items/'.$type);		
			}
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
		redirect(base_url().'admin/content/item/edit/'.$object_type."/".$item_id);
	}
	
	public function delete_characteristic($id)
	{
		$ch = $this->characteristics->get_item_by(array("id" => $id));
		if($this->characteristics->delete($id)) redirect(base_url().'admin/content/item/edit/'.$ch->object_type."/".$ch->object_id."#tab_4");
	}
}