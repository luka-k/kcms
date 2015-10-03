<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Content class
*
* @package		kcms
* @subpackage	Controllers
* @category	    content
*/
class Content extends Admin_Controller 
{

	public function __construct()
	{
		parent::__construct();
	}
	
	/**
	* Вывод списка элементов
	*
	* @param string $type - имя базы
	* @param integer $id - id категории
	*/
	public function items($type, $id = FALSE)
	{		
		$name = editors_get_name_field('name', $this->$type->editors);

		$data = array(
			'title' => "Страницы",
			'url' => $this->uri->uri_string(),
			'left_column' => isset($this->$type->admin_left_column) ? $this->$type->admin_left_column : "off",
			'type' => $type,
			'name' => $name,
		);	
		$data = array_merge($this->standart_data, $data);
				
		$order = $this->db->field_exists('sort', $type) ?  "sort" : $name;
		$direction = "acs";
		
		$settings = $this->settings->get_item(1);
		
		$id_branchy = $this->db->field_exists('parent_id', $type);
		
		if($id_branchy)
		{
			$data['tree'] = $type == "products" ?  $this->categories->get_tree(0, "parent_id", "admin") : $this->$type->get_tree(0, "parent_id", "admin");
		
			if($id == "all" || $id == '')
			{
				$data['content'] = $this->$type->get_list(FALSE, $this->input->get('from'), $settings->per_page, $order, $direction);
				$total_rows = count($this->$type->get_list(FALSE, FALSE, FALSE, $order, $direction));
				$data['sortable'] = !($this->db->field_exists('parent_id', $type)) ? TRUE : FALSE;
			}
			else
			{
				$parent = $type == "emails" ? "type" : "parent_id";
			
				$data['content'] = $this->$type->get_list(array($parent => $id), $this->input->get('from'), $settings->per_page, $order, $direction);
				$total_rows = count($this->$type->get_list(array($parent => $id), FALSE, FALSE, $order, $direction));
				$data["parent_id"] = $id;
				$data['sortable'] = TRUE;
			}
		}
		else
		{
			$data['content'] = $this->$type->get_list(FALSE, FALSE, FALSE, $order, $direction);
			$data['sortable'] = TRUE;
		}
		
		if(editors_get_name_field('img', $this->$type->editors))
		{
			foreach($data['content'] as $key => $item)
			{
				$data['content'][$key]->image = $this->images->get_cover(array("object_type" => $type, "object_id" => $item->id));
			}
		}
		
		$config['base_url'] = base_url().uri_string().'?'.get_filter_string($_SERVER['QUERY_STRING']);
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $settings->per_page;

		$this->pagination->initialize($config);

		$data['pagination'] = $this->pagination->create_links();
		
		$this->load->view('admin/items.php', $data);
	}
	
	/**
	* Вовод, редактирование, создание элемента.
	*
	* @param string $action - действие(редактировани, сохранение, копирование)
	* @param string $type - имя базы
	* @param integer $id - id элемента
	* @param boolen $exit - выход из редактирования
	*/
	public function item($action, $type, $id = FALSE, $exit = FALSE)
	{
		$parent_id = $this->input->get('parent_id');
		
		$data = array(
			'title' => "Редактировать",
			'left_column' => isset($this->$type->admin_left_column) ? $this->$type->admin_left_column : "off",
			'editors' => $this->$type->editors,
			'type' => $type,
			'parent_id' => $parent_id,
			'url' => "/".$this->uri->uri_string()
		);
		$data = array_merge($this->standart_data, $data);
		
		if($this->db->field_exists('parent_id', $type))
		{
			$tree =  $type == "products" ? $this->categories->get_tree(0, "parent_id", "admin") : set_disabled_option($this->$type->get_tree(0, "parent_id", "admin"), $id);
			$data['tree'] = $tree;
			$data['selects']['parent_id'] = $tree;
		}
		
		if($type == "articles") 
		{
			$this->config->load('templates');
			$data['selects']['template'] = $this->config->item('templates');
		}
		
		if($type == "emails") $data['selects']['users_type'] = $this->users_groups->get_list(FALSE);
		
		$image_field = editors_get_name_field('img', $data['editors']);
		$double_image_field = editors_get_name_field('double_img', $data['editors']);
		
		$characteristics_field = editors_get_name_field('ch', $data['editors']);
		if($characteristics_field) $data['ch_select'] = $this->characteristics_type->get_list(FALSE);
		
		$recommend_field = editors_get_name_field('recommend', $data['editors']);
	
		if($action == "edit")
		{
			if($id == FALSE)
			{	
				$data['content'] = set_empty_fields($data['editors']);
				if($this->db->field_exists('parent_id', $type))	$data['content']->parent_id = $parent_id;
				if($characteristics_field) $data['content']->characteristics = array();
				if($recommend_field) $data['content']->recommended = array();
				if($type == "emails") $data['content']->type = 2;				
			}	
			else
			{			
				$data['content'] = $this->$type->get_item($id);
				
				// Галлерея
				if($image_field) $data['content']->images = $this->images->prepare_list($this->images->get_list(array("object_type" => $type,"object_id" => $data['content']->id), FALSE, FALSE, "sort", "asc"));
				
				// Двойная галлерея
				if($double_image_field)
				{
					$field = get_editors_field($data['editors'], $double_image_field);
					if($field) foreach($field[4] as $image_type)
					{
						$data['content']->images[$image_type] = $this->images->prepare_list($this->images->get_list(array("object_type" => $type, "object_id" => $data['content']->id, "image_type" => $image_type), FALSE, FALSE, "sort", "asc"));
					}
				}
				
				// Характеристики
				if($characteristics_field)
				{
					$data['content']->characteristics = array();
					
					$ch_ids = $this->table2table->get_fixing('characteristic2product', 'characteristic_id', 'product_id', $id);
					if(!empty($ch_ids))
					{
						$this->db->where_in('id', $ch_ids);
						$data['content']->characteristics = $this->db->get('characteristics')->result();

						$ch_types = $this->characteristics_type->get_list(FALSE);
						
						if(!empty($data['content']->characteristics)) foreach($data['content']->characteristics as $j => $ch)
						{
							foreach($ch_types as $ch_t)
							{
								if($ch_t->url == $ch->type) $data['content']->characteristics[$j]->name = $ch_t->name;
							}
						}
					}
				}
				
				// Рекомендованные
				if($recommend_field) $data['content']->recommended = $this->products->get_recommended($id);
			}
			$this->load->view('admin/item.php', $data);
		}
		elseif($action == "save")
		{
			$data['content'] = $this->$type->editors_post();
			
			//Если в базе присутствует колонка lastmod заполняем дату последней модификации
			if($this->db->field_exists('lastmod', $type)) $data['content']->lastmod = date("Y-m-d");
					
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

			//Изображения
			$object_info = array(
				"object_type" => $type,
				"object_id" => $data['content']->id
			);
			
			if(!empty($image_field))
			{
				if (isset($_FILES[$image_field]))
				{
					if(is_array($_FILES[$image_field]['name']))
					{
						foreach($_FILES[$image_field]['error'] as $key => $error)
						{
							if($error == UPLOAD_ERR_OK)
							{
								$file = array(
									"name" => $_FILES[$image_field]['name'][$key],
									"type" => $_FILES[$image_field]['type'][$key],
									"tmp_name" => $_FILES[$image_field]['tmp_name'][$key]
								);
 
								$this->images->upload_image($file, $object_info);
							}
						}
					}
					else
					{
						if($_FILES[$image_field]['error'] == UPLOAD_ERR_OK) $this->images->upload_image($_FILES[$image_field], $object_info);
					}
				}
			}
				
			if(!empty($double_image_field))
			{
				if (isset($_FILES[$double_image_field]))
				{
					foreach($_FILES[$double_image_field]['error'] as $key => $error)
					{
						if($error == UPLOAD_ERR_OK)
						{
							$file = array(
								"name" => $_FILES[$double_image_field]['name'][$key],
								"type" => $_FILES[$double_image_field]['type'][$key],
								"tmp_name" => $_FILES[$double_image_field]['tmp_name'][$key]
							);
						
							$object_info['image_type'] = $key;
							$this->images->upload_image($file, $object_info);
						}
					}
				}	
			}
				
			$p_id = isset($data['content']->parent_id) ?  $data['content']->parent_id : "all";
			if($type == "emails") $p_id = $data['content']->type;
				
			$exit == false ? redirect(base_url().'admin/content/item/edit/'.$type."/".$data['content']->id) : redirect(base_url().'admin/content/items/'.$type."/".$p_id);	

		}
		if($action == "copy")
		{
			$data['content'] = $this->$type->get_item($id);
			
			if(!empty($characteristics_field))
			{
				$characteristics = array();
				
				$ch_ids = $this->table2table->get_fixing('characteristic2product', 'characteristic_id', 'product_id', $id);
				if(!empty($ch_ids))
				{
					$this->db->where_in('id', $ch_ids);
					$characteristics = $this->db->get('characteristics')->result();

					$ch_types = $this->characteristics_type->get_list(FALSE);
					
					if(!empty($data['content']->characteristics)) foreach($characteristics as $j => $ch)
					{
						foreach($ch_types as $ch_t)
						{
							if($ch_t->url == $ch->type) $characteristics[$j]->name = $ch_t->name;
						}
					}
				}
			}
			
			$data['content']->id = NULL;
			$data['content']->url = "";
			
			$this->$type->insert($data['content']);
			$new_id = $this->db->insert_id();
			
			if(isset($characteristics) && is_array($characteristics)) foreach($characteristics as $ch)
			{
				$data = array(
					'characteristic_id' => $ch_id,
					'product_id' => $new_id
				);
				$this->characteristic2product->insert($data);
			}			
			redirect(base_url().'admin/content/item/edit/'.$type."/".$new_id);
		}
	}
		
	/**
	* Удаление элемента
	*
	* @param string $type
	* @param integer $id
	*/
	public function delete_item($type, $id)
	{
		// Удаляем картинки связанные с элементом
		$image_fields = editors_get_name_field('img', $this->$type->editors);
		$is_dbl_img = editors_get_name_field('double_img', $this->$type->editors);
		if($image_fields || $is_dbl_img)
		{
			$item_images = $this->images->get_list(array("object_type" => $type, "object_id" => $id));
			if($item_images) foreach($item_images as $image)
			{
				$this->images->delete_img(array("object_type" => $type, "id" => $image->id));
			}
		}
		
		// Удаляем характеристики связанные с товаром.
		$characteristics_field = editors_get_name_field('ch', $this->$type->editors);
		if($characteristics_field)
		{
			$item_characteristics = $this->characteristics->get_list(array("object_type" => $type, "object_id" => $id));
			if($item_characteristics) foreach($item_characteristics as $ch)
			{
				$this->characteristics->delete($ch->id);
			}
		}
		
		// Удаляем рекомендованные элементы
		$recommend_fielded = editors_get_name_field('recommend', $this->$type->editors);
		if($recommend_fielded)	$this->products->delete_recommended($id);
	
		$item = $this->$type->get_item($id);
		$this->$type->delete($id);
		redirect(base_url().'admin/content/items/'.$type."/".$item->parent_id);
	}
	
	/**
	* Удаление изображения
	* 
	* @param string $type - тип изображения(категория)
	* @param integer $id - id изображения
	* @param integer $tab - номер вкладки с изображениями.
	*/
	public function delete_image($type, $id, $tab)
	{
		$item_id = $this->images->delete_img(array("object_type" => $type, "id" => $id));
		
		redirect(base_url().'admin/content/item/edit/'.$type."/".$item_id."#tab_".$tab);
	}
	
	/**
	* Переименования изображения
	*/
	public function rename_image()
	{
		$info = json_decode(file_get_contents('php://input', true));
		
		if(!isset($info->name)) add_log("images", "Не задано имя изображения");
		
		$this->images->update($info->id, array("name" => $info->name));
	}
	
	/**
	* Установка обложки альбома
	*/
	public function set_cover($object_type, $object_id, $id, $tab)
	{
		$this->images->set_cover(array("object_type" => $object_type, "object_id" => $object_id), $id);
		
		redirect(base_url().'admin/content/item/edit/'.$object_type."/".$object_id."#tab_".$tab);
	}
	
	/**
	* Добавление характеристики товару
	*/
	public function edit_characteristic()
	{
		$info = json_decode(file_get_contents('php://input', true));

		if(!isset($info->id))
		{
			$product_id = $info->object_id;
			unset($info->object_id);
			$ch = $this->characteristics->get_item_by(array('value' => $info->value));
			
			if(empty($ch))
			{
				$this->characteristics->insert($info);
			
				if(!isset($characteristic_id)) add_log("characteristics", "Добавление характеристики не удалось");
				
				$ch = $this->characteristics->get_item($this->db->insert_id());
			}
			
			$ch_types = $this->characteristics_type->get_list(FALSE);
			foreach($ch_types as $ch_t)
			{
				if($ch_t->url == $ch->type) $ch->name = $ch_t->name;
			}
						
			$answer = $this->load->view('admin/include/editors/characteristic_item.php', array('characteristic' => $ch), TRUE);
			
			$data = array(
				'product_id' => $product_id,
				'characteristic_id' => $ch->id 
			);
			
			$this->characteristic2product->insert($data);
		}
		else
		{
			$this->characteristics->update($info->id, $info);
			$answer = 'ok';
		}
			
		echo json_encode($answer);
	}
	
	/**
	* Удаление характеристики товара
	*/
	public function delete_characteristic()
	{
		$info = json_decode(file_get_contents('php://input', true));
		
		$this->characteristics->delete($info->ch_id);
		
		$this->db->where_in('characteristic_id', $info->ch_id);
		$this->db->delete('characteristic2product');
		
		$answer = array('ch_id' => $info->ch_id);
		echo json_encode($answer);
	}
	
	/**
	* Удаление рекомендованного товара
	*/
	public function delete_recommended($id, $object_id)
	{
		$this->products->delete_recommended($id);
		redirect(base_url().'admin/content/item/edit/products/'.$object_id);
	}
	
	/**
	* Редактирование на странице списка товаров - спецпредложения и новинка
	*/
	public function advanced()
	{
		$info = json_decode(file_get_contents('php://input', true));
		
		if(!isset($info->type)) add_log("advanced", "не задан тип поля для обновления на лету");
		if(!isset($info->value)) add_log("advanced", "не задано значение для обновления поля ".$info->type);
		
		$this->products->update($info->id, array("is_".$info->type => $info->value));
	}
	
	public function unique()
	{
		$data = json_decode(file_get_contents('php://input', true));

		$table = $data->table;
		$field = $data->field;
		
		$data = $this->$table->is_unique(array($field => $data->value))? TRUE : FALSE;
		
		echo json_encode($data);
	}
}