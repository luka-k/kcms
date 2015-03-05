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
		$name = editors_field_exists('name', $this->$type->editors);
		
		isset($this->$type->admin_left_column) ? $left_column = $this->$type->admin_left_column: $left_column = "off";

		$data = array(
			'title' => "Страницы",
			'error' => "",
			'user' => $this->user,
			'menu' => $this->menu,
			'left_column' => $left_column,
			'type' => $type,
			'name' => $name,
			'url' => "/".$this->uri->uri_string()
		);	
				
		$this->db->field_exists('sort', $type) ? $order = "sort" : $order = "name";
		$direction = "acs";
		
		if($this->db->field_exists('parent_id', $type))
		{
			$data['tree'] = $type == "products" ?  $this->categories->get_tree(0, "parent_id") : $this->$type->get_tree(0, "parent_id");
		}
		
		if($id == "all")
		{
			$data['content'] = $this->$type->get_list(FALSE, $from = FALSE, $limit = FALSE, $order, $direction);
			$data['sortable'] = !($this->db->field_exists('parent_id', $type)) ? TRUE : FALSE;
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
			$data['content'] = $this->images->get_img_list($data['content'], $type, "catalog_small");
			$data['images'] = TRUE;
		}
		
		$this->load->view('admin/items.php', $data);
	}
	
	public function item($action, $type, $id = FALSE, $exit = FALSE)
	{
		isset($this->$type->admin_left_column) ? $left_column = $this->$type->admin_left_column: $left_column = "off";
		$name = editors_field_exists('name', $this->$type->editors);
		
		$data = array(
			'title' => "Редактировать",
			'error' => "",
			'user' => $this->user,
			'menu' => $this->menu,
			'left_column' => $left_column,
			'editors' => $this->$type->editors,
			'type' => $type,
			'url' => "/".$this->uri->uri_string()
		);
		
		if($this->db->field_exists('parent_id', $type))
		{
			$tree =  $type == "products" ? $this->categories->get_tree(0, "parent_id") : $this->$type->get_tree(0, "parent_id");
			$data['tree'] = $tree;
			$data['selects']['parent_id'] = $tree;
		}
		
		if($type == "emails") $data['selects']['users_type'] = $this->users_groups->get_list(FALSE);
		
		if($action == "edit")
		{
			if($id == FALSE)
			{	
				$data['content'] = set_empty_fields($data['editors']);
				
				if($this->db->field_exists('parent_id', $type))	$data['content']->parent_id = $this->input->get('parent_id');
				
				$data['content']->is_active = "1";
				$data['content']->img = NULL;
				
				if($type == "emails") $data['content']->type = 2;
				
				$field_name = editors_field_exists('ch', $data['editors']);
				if(!empty($field_name))
				{
					$this->config->load('characteristics_config');
					$data['content']->ch_select = $this->config->item('characteristics_type');
					$data['content']->characteristics = array();
				}
			}	
			else
			{			
				$data['content'] = $this->$type->get_item($id);
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
			$this->load->view('admin/item.php', $data);
		}
		elseif($action == "save")
		{
			$data['content'] = $this->$type->editors_post()->data;
			
			//Если в базе присутствует колонка lastmod заполняем дату последней модификации
			if($this->db->field_exists('lastmod', $type)) $data['content']->lastmod = date("Y-m-d");
			
			if($this->$type->editors_post()->error == TRUE)
			{
				//Если валидация не прошла выводим сообщение об ошибке
				$this->load->view('admin/item.php', $data);			
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
					
					if (isset($_FILES[$field_name]))
					{
						if(is_array($_FILES[$field_name]['name']))
						{
							foreach($_FILES[$field_name]['error'] as $key => $error)
							{
								if($error == UPLOAD_ERR_OK)
								{
									$file = array(
										"name" => $_FILES[$field_name]['name'][$key],
										"type" => $_FILES[$field_name]['type'][$key],
										"tmp_name" => $_FILES[$field_name]['tmp_name'][$key]
									);

									$this->images->upload_image($file, $object_info);
								}
							}
						}
						else
						{
							if($_FILES[$field_name]['error'] <> 4)$this->images->upload_image($_FILES[$field_name], $object_info);
						}
					}
				}
				
				$p_id = isset($data['content']->parent_id) ?  $data['content']->parent_id : "";
				if($type == "emails") $p_id = $data['content']->type;
				
				$exit == false ? redirect(base_url().'admin/content/item/edit/'.$type."/".$data['content']->id) : redirect(base_url().'admin/content/items/'.$type."/".$p_id);	
			}
		}
		if($action == "copy")
		{
			$data['content'] = $this->$type->get_item($id);
			
			$field_name = editors_field_exists('ch', $data['editors']);
			if(!empty($field_name)) $characteristics = $this->characteristics->get_list(array("object_id" => $data['content']->id));
			
			$data['content']->id = NULL;
			$data['content']->url = "";
			
			foreach($data['content'] as $key => $value)
			{
				if(!$this->db->field_exists($key, $type)) unset($data['content']->$key);
			}
			
			$this->$type->insert($data['content']);
			$new_id = $this->db->insert_id();
			
			if(is_array($characteristics)) foreach($characteristics as $ch)
			{
				$ch->id = NULL;
				$ch->object_id = $new_id;
				$this->characteristics->insert($ch);
			}
			
			redirect(base_url().'admin/content/item/edit/'.$type."/".$new_id);
		}
	}
		
	//Удаление элемента
	public function delete_item($type, $id)
	{
		$object_info = array(
			"object_type" => $type,
			"object_id" => $id
		);
		$item_images = $this->images->get_images($object_info);
		if($item_images) foreach($item_images as $image)
		{
			$this->images->delete_img(array("object_type" => $type, "id" => $image->id));
		}
		
		if($type == "products")
		{
			$item_characteristics = $this->characteristics->get_list(array("object_id" => $id,"object_type" => $type));
			if($item_characteristics) foreach($item_characteristics as $ch)
			{
				$this->characteristics->delete($ch->id);
			}
		}
		/**********************************************************************
		*Как то упушен был у нас этот момент.
		*При удалении элемента оставались фотографии характеристики.
		*Соответствено теперь это все чистится
		**********************************************************************/
		$this->$type->delete($id);
		redirect(base_url().'admin/content/items/'.$type);
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
		$ch = $this->characteristics->get_item($id);
		if($this->characteristics->delete($id)) redirect(base_url().'admin/content/item/edit/'.$ch->object_type."/".$ch->object_id."#tab_4");
	}
	
	/***************************************************************************************
	* аякс функции
	***************************************************************************************/
	
	public function edit_characteristic()
	{
		$info = json_decode(file_get_contents('php://input', true));
		if(!isset($info->id))
		{
			$this->db->select_max('id');
			$query = $this->db->get('characteristics');
			$after = $query->row()->id;
			
			$this->characteristics->insert($info);
			$info->id = $this->db->insert_id();
			
			$this->config->load('characteristics_config');
			$ch_select = $this->config->item('characteristics_type');
			
			foreach($ch_select as $key => $type)
			{
				if($info->type == $key) $info->name = $type;
			}
			
			$answer = array(
				'after' => $after,
				'base_url' => base_url(),
				'info' => $info
			);
		}
		else
		{
			$this->characteristics->update($info->id, $info);
			$answer['message'] = 'ok';
		}
		
		echo json_encode($answer);
	}
	
	public function advanced()
	{
		$info = json_decode(file_get_contents('php://input', true));
		
		if($info->type == "new")
		{
			$this->products->update($info->id, array("is_new" => $info->value));
		}
		elseif($info->type == "special")
		{
			$this->products->update($info->id, array("is_good_buy" => $info->value));
		}
	}
}