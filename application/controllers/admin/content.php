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
	public function items($type, $id = FALSE, $from = 0)
	{		
		$name = editors_get_name_field('name', $this->$type->editors);
		
		$left_column = isset($this->$type->admin_left_column) ? $this->$type->admin_left_column : "off";

		$data = array(
			'title' => "Страницы",
			'left_column' => $left_column,
			'type' => $type,
			'name' => $name,
			'url' => $this->uri->uri_string()
		);	
		$data = array_merge($this->standart_data, $data);
				
		$order = $this->db->field_exists('sort', $type) ?  "sort" : "name";
		$direction = "acs";
				
		if($this->db->field_exists('parent_id', $type))
		{
			$data['tree'] = $type == "products" ?  $this->categories->get_tree(0, "parent_id") : $this->$type->get_tree(0, "parent_id");
		}
		
		$from = $this->input->get('from');
		
		if($id == "all")
		{
			$data['content'] = $this->$type->get_list(FALSE, $from, 15, $order, $direction);
			$total_rows = $this->products->get_count();
			$data['sortable'] = !($this->db->field_exists('parent_id', $type)) ? TRUE : FALSE;
		}
		else
		{
			$type == "emails" ? $parent = "type" : $parent = "parent_id";
			$data["parent_id"] = $id;
			$data['content'] = $this->$type->get_list(array($parent => $id), $from, 15, $order, $direction);
			$total_rows = $this->products->get_count(array($parent => $id));
			$data['sortable'] = TRUE;
		}
		
		//Pagenation
		if($type == "products")
		{
			$this->load->library('pagination');
		
			$config = array(
				'base_url' => base_url().$this->uri->uri_string().'?',
				'total_rows' => $total_rows,
				'query_string_segment' => 'from',
				'page_query_string' => TRUE,
				'per_page' => 15,
				'first_link' => 'Первая',
				'last_link' => 'Последняя',
				'next_link' => FALSE,
				'prev_link' => FALSE,
			);

			$this->pagination->initialize($config);
			$data['pagination'] = $this->pagination->create_links();
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
		$left_column =  isset($this->$type->admin_left_column) ? $this->$type->admin_left_column : "off";
		$name = editors_get_name_field('name', $this->$type->editors);
		$parent_id = $this->input->get('parent_id');
		
		$data = array(
			'title' => "Редактировать",
			'left_column' => $left_column,
			'editors' => $this->$type->editors,
			'type' => $type,
			'parent_id' => $parent_id,
			'url' => "/".$this->uri->uri_string()
		);
		$data = array_merge($this->standart_data, $data);
		
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
		
		if($type == "sliders") 
		{
			$this->config->load('types');
			$data['selects']['type'] = $this->config->item('sliders');
		}
		
		if($type == "emails") $data['selects']['users_type'] = $this->users_groups->get_list(FALSE);
		
		$is_characteristics = editors_get_name_field('ch', $data['editors']);
		if(!empty($is_characteristics)) $data['ch_select'] = $this->characteristics_type->get_list(FALSE);
		
		if($action == "edit")
		{
			if($id == FALSE)
			{	
				$data['content'] = set_empty_fields($data['editors']);
				
				if($this->db->field_exists('parent_id', $type))	$data['content']->parent_id = $parent_id;
				if(!empty($is_characteristics)) $data['content']->characteristics = array();
				if($type == "emails") $data['content']->type = 2;				
			}	
			else
			{			
				$data['content'] = $this->$type->get_item($id);
				
				// Галлерея
				$is_image = editors_get_name_field('img', $data['editors']);
				if($is_image) $data['content']->images = $this->images->prepare_list($this->images->get_list(array("object_type" => $type,"object_id" => $data['content']->id)));
				
				// Двойная галлерея
				$is_double_image = editors_get_name_field('double_img', $data['editors']);
				if($is_double_image)
				{
					$field = get_editors_field($data['editors'], $is_double_image);
					if($field) foreach($field[4] as $image_type)
					{
						$data['content']->images[$image_type] = $this->images->prepare_list($this->images->get_list(array("object_type" => $type, "object_id" => $data['content']->id, "image_type" => $image_type)));
					}
				}
				
				// Характеристики
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
				
				// Рекомендованные
				$is_recommend = editors_get_name_field('recommend', $data['editors']);
				if($is_recommend) $data['content']->recommended = $this->products->get_recommended($id);
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
			
			$field_name = editors_get_name_field('img', $data['editors']);
			//Получаем id эдитора который предназначен для загрузки изображения

			/*****************************************
			/ Требует более серьезного рефакторинга
			/****************************************/
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
						if($_FILES[$field_name]['error'] == UPLOAD_ERR_OK) $this->images->upload_image($_FILES[$field_name], $object_info);
					}
				}
			}
				
			$field_name = editors_get_name_field('double_img', $data['editors']);
			
			if(!empty($field_name))
			{
				$object_info = array(
					"object_type" => $type,
					"object_id" => $data['content']->id
				);
				
				if (isset($_FILES[$field_name]))
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
						
							$object_info['image_type'] = $key;
							$this->images->upload_image($file, $object_info);
						}
					}
				}	
			}
			/*****************************************************
			/ Конец куска требующего рефакторинга
			/****************************************************/
				
			$p_id = isset($data['content']->parent_id) ?  $data['content']->parent_id : "all";
			if($type == "emails") $p_id = $data['content']->type;
				
			$exit == false ? redirect(base_url().'admin/content/item/edit/'.$type."/".$data['content']->id) : redirect(base_url().'admin/content/items/'.$type."/".$p_id);	

		}
		if($action == "copy")
		{
			$data['content'] = $this->$type->get_item($id);
			
			if(!empty($is_characteristics)) $characteristics = $this->characteristics->get_list(array("object_id" => $data['content']->id));
			
			$data['content']->id = NULL;
			$data['content']->url = "";
			
			$this->$type->insert($data['content']);
			$new_id = $this->db->insert_id();
			
			if(isset($characteristics) && is_array($characteristics)) foreach($characteristics as $ch)
			{
				$ch->id = NULL;
				$ch->object_id = $new_id;
				$this->characteristics->insert($ch);
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
		$is_images = editors_get_name_field('img', $this->$type->editors);
		$is_dbl_img = editors_get_name_field('double_img', $this->$type->editors);
		if($is_images || $is_dbl_img)
		{
			$item_images = $this->images->get_list(array("object_type" => $type, "object_id" => $id));
			if($item_images) foreach($item_images as $image)
			{
				$this->images->delete_img(array("object_type" => $type, "id" => $image->id));
			}
		}
		
		// Удаляем характеристики связанные с товаром.
		$is_characteristics = editors_get_name_field('ch', $this->$type->editors);
		if($is_characteristics)
		{
			$item_characteristics = $this->characteristics->get_list(array("object_type" => $type, "object_id" => $id));
			if($item_characteristics) foreach($item_characteristics as $ch)
			{
				$this->characteristics->delete($ch->id);
			}
		}
		
		// Удаляем рекомендованные элементы
		$is_recommended = editors_get_name_field('recommend', $this->$type->editors);
		if($is_recommended)	$this->products->delete_recommended($id);
	
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
	
	/**
	* Удаление характеристики товара
	*/
	public function delete_characteristic($id, $tab)
	{
		$ch = $this->characteristics->get_item_by(array("id" => $id));
		if($this->characteristics->delete($id)) redirect(base_url().'admin/content/item/edit/'.$ch->object_type."/".$ch->object_id."#tab_".$tab);
	}
	
	/**
	* Редактирование на странице списка товаров - спецпредложения и новинка
	*/
	public function advanced()
	{
		$info = json_decode(file_get_contents('php://input', true));
		
		
		if($info->type == "new")
		{
			$this->products->update($info->id, array("is_new" => $info->value));
		}
		elseif($info->type == "special")
		{
			$this->products->update($info->id, array("is_special" => $info->value));
		}
	}
	
	public function search()
	{
		$param = $this->input->get('param');
		
		$product = $this->products->get_item_by(array("name" => $param));
	
		if(!empty($product)) $product = $this->products->get_item_by(array("isbn" => $param));
		if(!empty($product))
		{
			redirect('/content/item/edit/products/'.$product->id);
		}
		else
		{
			$from = $this->input->get('from');
			
			$this->db->like('name', $param);
			$this->db->or_like('isbn', $param);
			$this->db->limit(15, $from);
			$products = $this->db->get('products')->result();
			
			$this->db->like('name', $param);
			$this->db->or_like('isbn', $param);
			$total_rows = count($this->db->get('products')->result());
					
			$data = array(
				'title' => "Поиске",
				'left_column' =>  array('items_tree' => 'products_tree', 'item_tree' => 'products_tree'),
				'tree' => $this->categories->get_tree(0, "parent_id"),
				'type' => 'products',
				'name' => 'name',
				'url' => $this->uri->uri_string(),
				'content' => $products,
				'images' => TRUE,
				'sortable' =>FALSE
			);

			foreach($data['content'] as $key => $item)
			{
				$data['content'][$key]->image = $this->images->get_cover(array("object_type" => 'products', "object_id" => $item->id));
			}
			
			$this->load->library('pagination');
		
			$config = array(
				'base_url' => base_url().$this->uri->uri_string()."?param={$param}",
				'total_rows' => $total_rows,
				'query_string_segment' => 'from',
				'page_query_string' => TRUE,
				'per_page' => 15,
				'first_link' => 'Первая',
				'last_link' => 'Последняя',
				'next_link' => FALSE,
				'prev_link' => FALSE,
			);

			$this->pagination->initialize($config);
			$data['pagination'] = $this->pagination->create_links();
			
			$data = array_merge($this->standart_data, $data);
			
			$this->load->view('admin/items.php', $data);
		}
	}
}