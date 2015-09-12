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
		
		$id_branchy = $this->db->field_exists('parent_id', $type);
		
		if($id_branchy)
		{
			if($type == "products") $data['tree'] = $this->categories->get_list(FALSE, FALSE, FALSE, $order, $direction);
		
			if($id == "all" || $id == '')
			{
				$data['content'] = $this->$type->get_list(FALSE, FALSE, FALSE, $order, $direction);
				$data['sortable'] = !($this->db->field_exists('parent_id', $type)) ? TRUE : FALSE;
			}
			else
			{
				$parent = $type == "emails" ? "type" : "parent_id";
			
				$data['content'] = $this->$type->get_list(array($parent => $id), FALSE, FALSE, $order, $direction);
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
		$name = editors_get_name_field('name', $this->$type->editors);
		
		$data = array(
			'title' => "Редактировать",
			'left_column' => isset($this->$type->admin_left_column) ? $this->$type->admin_left_column : "off",
			'editors' => $this->$type->editors,
			'type' => $type,
			'parent_id' => $parent_id,
			'url' => "/".$this->uri->uri_string(),
			'name' => $name
		);
		$data = array_merge($this->standart_data, $data);
		
		if($this->db->field_exists('parent_id', $type))
		{
			if($type == "products")
			{
				$tree =  $this->categories->get_list(FALSE, FALSE, FALSE, 'sort', 'asc');
				$data['tree'] = $tree;
				$data['selects']['category_id'] = $tree;
			}
		}
		
		if($type == "emails") $data['selects']['users_type'] = $this->users_groups->get_list(FALSE);
		
		if($type == 'menu')
		{
			$data['selects']['manufacturer_id'] = $this->manufacturers->get_list(FALSE, FALSE, FALSE, 'name', 'asc');
			$data['selects']['school_id'] = $this->schools->get_list(FALSE, FALSE, FALSE, 'name', 'asc');
		}
		
		if($type == 'categories') $data['selects']['menu_id'] = $this->menu->get_list(FALSE, FALSE, FALSE, 'name', 'asc');
		
		if($type == 'child_users')
		{
			$data['selects']['school_id'] = $this->schools->get_list(FALSE, FALSE, FALSE, 'name', 'asc');
			$data['selects']['menu_id'] = $this->menu->get_list(FALSE, FALSE, FALSE, 'name', 'asc');
			
			$parents_ids = $this->table2table->get_child_ids('users2users_groups', 'users_group_id', 'user_id', 2);
			
			$parents = array();
			if($parents_ids)
			{
				$this->db->where_in('id', $parents_ids);
				$parents = $this->db->get('users')->result();
			}
			$data['selects']['parent_id'] = $parents;
		}
		
		$image_field = editors_get_name_field('img', $data['editors']);
		$double_image_field = editors_get_name_field('double_img', $data['editors']);
				
		if($action == "edit")
		{
			if($id == FALSE)
			{	
				$data['content'] = set_empty_fields($data['editors']);
				
				if($this->db->field_exists('parent_id', $type))	$data['content']->parent_id = $parent_id;
				if($type == "emails") $data['content']->type = 2;	
				if($type == 'child_users') $data['no_tabs'] = array('Продукты');
			}	
			else
			{		
				$data['content'] = $this->$type->get_item($id);

				if($type == 'child_users')
				{
					$data['content']->menu = $this->menu->get_menu_by_school($data['content']->school_id);
										
					$data['content']->disabled_products = $this->child_users->get_disabled_products($id);
				}
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
			
			if($type == 'child_users')
			{
				$child2product = array();
				
				$this->db->where('child_id', $data['content']->id);
				$this->db->delete('child2product');
				
				$menu = $this->menu->get_item_by(array('school_id' => $data['content']->school_id));
				
				$child_products = $this->menu->get_products_by_menu($menu->id);

				$enabled_products = $this->input->post('child2products');
				
				foreach($child_products as $key => $c_p)
				{
					$child2product[$key] = array(
						'child_id' => $data['content']->id,
						'product_id' => $c_p->id,
					);
					if($enabled_products)
					{
						$child2product[$key]['disabled'] = in_array($c_p->id, $enabled_products) ? 0 : 1;
					}
					else
					{
						$child2product[$key]['disabled'] = 0;
					}
				}
				
				$this->db->insert_batch('child2product', $child2product);
			}
			
				
			$p_id = isset($data['content']->parent_id) ?  $data['content']->parent_id : "all";
			if($type == "emails") $p_id = $data['content']->type;
				
			$exit == false ? redirect(base_url().'admin/content/item/edit/'.$type."/".$data['content']->id) : redirect(base_url().'admin/content/items/'.$type."/".$p_id);	

		}
		if($action == "copy")
		{
			$data['content'] = $this->$type->get_item($id);			
			$data['content']->id = NULL;
			$data['content']->url = "";
			
			$this->$type->insert($data['content']);
			$new_id = $this->db->insert_id();
		
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
		if($type == "child_users")
		{
			$this->db->where('child_id', $id);
			$this->db->delete('child2product');
		}
	
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
			$info->id = $this->characteristics->insert($info);
			
			if(!isset($info->id)) add_log("characteristics", "Добавление характеристики не удалось");
			
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
}