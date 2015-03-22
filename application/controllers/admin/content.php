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
		$name = editors_get_name_field('name', $this->$type->editors);
		
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
				
		$order = $this->db->field_exists('sort', $type) ?  "sort" : "name";
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
		
		if(editors_get_name_field('img', $this->$type->editors))
		{
			foreach($data['content'] as $key => $item)
			{
				$data['content'][$key]->image = $this->images->get_cover(array("object_type" => $type, "object_id" => $item->id));
			}
			$data['images'] = TRUE;
		}
		
		$this->load->view('admin/items.php', $data);
	}
	
	public function item($action, $type, $id = FALSE, $exit = FALSE)
	{
		$left_column =  isset($this->$type->admin_left_column) ? $this->$type->admin_left_column : "off";
		$name = editors_get_name_field('name', $this->$type->editors);
		
		$parent_id = $this->input->get('parent_id');
		
		$data = array(
			'title' => "Редактировать",
			'error' => "",
			'user' => $this->user,
			'menu' => $this->menu,
			'left_column' => $left_column,
			'editors' => $this->$type->editors,
			'type' => $type,
			'parent_id' => $parent_id,
			'url' => "/".$this->uri->uri_string()
		);
		
		if($this->db->field_exists('parent_id', $type))
		{
			$tree =  $type == "products" ? $this->categories->get_tree(0, "parent_id") : set_disabled_option($this->$type->get_tree(0, "parent_id"), $id);
			$data['tree'] = $tree;
			$data['selects']['parent_id'] = $tree;
		}
		
		if($type == "characteristics_type") 
		{
			$this->config->load('characteristics');
			
			$data['selects']['view_type'] = $this->config->item('view_type');
		}
		
		if($type == "emails") $data['selects']['users_type'] = $this->users_groups->get_list(FALSE);
		
		$is_characteristics = editors_get_name_field('ch', $data['editors']);
		
		if(!empty($is_characteristics))
		{
			$characteristics_type = $this->characteristics_type->get_list(FALSE);
			$data['ch_select'] = $characteristics_type;
		}
		
		if($action == "edit")
		{
			if($id == FALSE)
			{	
				$data['content'] = set_empty_fields($data['editors']);
				
				if($this->db->field_exists('parent_id', $type))	$data['content']->parent_id = $parent_id;
				
				$data['content']->is_active = "1";
				$data['content']->img = NULL;
				
				if($type == "emails") $data['content']->type = 2;
				
				if(!empty($is_characteristics)) $data['content']->characteristics = array();
			}	
			else
			{			
				$data['content'] = $this->$type->get_item($id);
				$object_info = array(
					"object_type" => $type,
					"object_id" => $data['content']->id
				);
				
				$data['content']->images = $this->images->prepare_list($this->images->get_list($object_info));

				if(!empty($is_characteristics))
				{
					$data['content']->characteristics = $this->characteristics->get_list(array("object_id" => $id, "object_type" => $type));
					foreach($data['content']->characteristics as $characteristic)
					{
						foreach($data['ch_select'] as $ch)
						{
							if($characteristic->type == $ch->url) $characteristic->name = $ch->name;
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
				if($data['content']->id == FALSE)
				{
					$data['content']->img = NULL;

					if(!empty($is_characteristics)) $data['content']->characteristics = array();
					if($type == "products") $data['content']->reccomended = array();
					if($type == "emails") $data['content']->type = 2;
				}
				else
				{
					$object_info = array(
						"object_type" => $type,
						"object_id" => $data['content']->id
					);
					$data['content']->images = $this->images->get_list($object_info);
					
					if(!empty($is_characteristics))
					{
						$data['content']->characteristics = $this->characteristics->get_list(array("object_id" => $data['content']->id, "object_type" => $type));
						foreach($data['content']->characteristics as $characteristic)
						{
							foreach($data['ch_select'] as $ch)
							{
								if($characteristic->type == $ch->ch_type) $characteristic->name = $ch->name;
							}
						}
					}
				}
			
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
			
				$field_name = editors_get_name_field('img', $data['editors']);
				//Получаем id эдитора который предназначен для загрузки изображения
				//Если например нужно две галлереи для товара то делаем в функции editors_get_name_field $field_name массивом и пробегаем ниже по нему
				if(!empty($field_name))
				{
					$object_info = array(
						"object_type" => $type,
						"object_id" => $data['content']->id
					);
					
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
							if($_FILES[$field_name]['error'] <> 4) $this->images->upload_image($_FILES[$field_name], $object_info);
						}
					}
				}
				
				$p_id = isset($data['content']->parent_id) ?  $data['content']->parent_id : "all";
				if($type == "emails") $p_id = $data['content']->type;
				
				$exit == false ? redirect(base_url().'admin/content/item/edit/'.$type."/".$data['content']->id) : redirect(base_url().'admin/content/items/'.$type."/".$p_id);	
			}
		}
		if($action == "copy")
		{
			$data['content'] = $this->$type->get_item($id);
			
			$field_name = editors_get_name_field('ch', $data['editors']);
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
		$item_images = $this->images->get_list($object_info);
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
		
		$this->$type->delete($id);
		redirect(base_url().'admin/content/items/'.$type);
	}
	
	/***********************************************************************************************
	*
	* Обработка картинок
	*
	***********************************************************************************************/
	public function delete_image($type, $id, $tab)
	{
		$item_id = $this->images->delete_img(array("object_type" => $type, "id" => $id));
		
		redirect(base_url().'admin/content/item/edit/'.$type."/".$item_id."#tab_".$tab);
	}
	
	public function rename_image()
	{
		$info = json_decode(file_get_contents('php://input', true));
		
		$this->images->update($info->id, array("name" => $info->name));
	}
	
	public function set_cover($object_type, $object_id, $id, $tab)
	{
		$this->images->set_cover(array("object_type" => $object_type, "object_id" => $object_id), $id);
		
		redirect(base_url().'admin/content/item/edit/'.$object_type."/".$object_id."#tab_".$tab);
	}
	
	/***********************************************************************************************
	*
	* Обработка характеристик
	*
	***********************************************************************************************/
	
	public function edit_characteristic()
	{
		$info = json_decode(file_get_contents('php://input', true));
		if(!isset($info->id))
		{
			$this->characteristics->insert($info);
			$info->id = $this->db->insert_id();
			
			$ch_select = $this->characteristics_type->get_list(FALSE);
			
			foreach($ch_select as $item)
			{
				if($info->type == $item->url) $info->name = $item->name;
			}
			
			$answer = array(
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
	
	public function delete_characteristic($id, $tab)
	{
		$ch = $this->characteristics->get_item_by(array("id" => $id));
		if($this->characteristics->delete($id)) redirect(base_url().'admin/content/item/edit/'.$ch->object_type."/".$ch->object_id."#tab_".$tab);
	}
	
	/***********************************************************************************************
	*
	* Редактирование на лету - новинка и спецпредложение
	*
	***********************************************************************************************/
	
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