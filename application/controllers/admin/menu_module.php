<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//Menu_module class

class Menu_module extends Admin_Controller 
{	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function menus()
	{		
		$data = array(
			'title' => "Меню",
			'name' => editors_get_name_field('name', $this->dynamic_menus->editors),
			'content' => $this->dynamic_menus->get_list(FALSE),
			'url' => "/".$this->uri->uri_string()
		);	
		$data = array_merge($this->standart_data, $data);
		
		if(editors_get_name_field('img', $this->dynamic_menus->editors))
		{
			$data['content'] = $this->images->get_img_list($data['content'], "menu", "catalog_mid");
			$data['images'] = TRUE;
		}
		$this->load->view("admin/menus", $data);
	}
	
	public function menu($action, $id = FALSE)
	{
		$editors = $this->dynamic_menus->editors;
		$items_editors = $this->menus_items->editors;
		
		$content = $id == FALSE ? set_empty_fields($editors) : $this->dynamic_menus->get_item($id);
		
		$item_content = set_empty_fields($items_editors);
		$item_content->menu_id = $id;	
		$item_content->parent_id = 0;
		$item_content->img = NULL;
		
		//Задаем типы ссылок на которые может ссылаться пункт меню
		$types = array(
			"Статьи" => "articles",
			"Ссылка" => "link"
		);
		
		$data = array(
			'title' => "Редактировать меню",
			'items_error' => "",
			'type' => "dynamic_menus",
			'editors' => $editors,
			'content' => $content,
			'menu_items' => $this->menus_items->menu_tree($id),
			'items_editors' => $this->menus_items->editors,
			'selects' => array(
				'parent_id' =>$this->menus_items->menu_tree($id),
				'url' => $this->articles->get_tree(0, "parent_id")
			),
			'types' => $types,
			'item_content' => $item_content,
			'url' => "/".$this->uri->uri_string()
		);	
		$data = array_merge($this->standart_data, $data);
		
		if($action == "edit")
		{
			$this->load->view("admin/menu", $data);
		}
		elseif($action == "save")
		{
			$content = $this->dynamic_menus->editors_post();
			if($content->id == FALSE)
			{
				//Если id пустая создаем новую страницу в базе
				$this->dynamic_menus->insert($content);
				$content->id = $this->db->insert_id();				
			}
			else
			{
				//Если id не пустая вносим изменения.
				$this->dynamic_menus->update($content->id, $content);
			}	
			
			$field_name = editors_get_name_field('img', $editors);
			if(!empty($field_name))
			{
				$object_info = array(
					"object_type" => "dynamic_menus",
					"object_id" => $content->id
				);
		
				$cover_id = $this->input->post("cover_id");
				if ($cover_id <> NULL) $this->images->set_cover($object_info, $cover_id);
				
				if (isset($_FILES[$field_name])&&($_FILES[$field_name]['error'] <> 4)) $this->images->upload_image($_FILES[$field_name], $object_info);
			}
			redirect(base_url().'admin/menu_module/menu/edit/'.$content->id);
		}
		elseif($action == "save_item")
		{
			$info = $this->menus_items->editors_post();

			if($info->id == FALSE)
			{
				//Если id пустая создаем новый пункт в базе
				$this->db->where("parent_id", $info->parent_id);
				$this->db->select_max('sort');
				$query = $this->db->get('menus_items');
				$max_sort = $query->row()->sort;
				
				$info->sort = $max_sort+1;
				$this->menus_items->insert($info);
				$info->id = $this->db->insert_id();
			}
			else
			{
				//Если id не пустая вносим изменения.
				$this->menus_items->update($info->id, $info);
					
			}
			redirect(base_url().'admin/menu_module/menu/edit/'.$info->menu_id); 
		}
	}
	
	public function delete_menu($id) 
	{
		if($this->dynamic_menus->delete($id))
		{
			$menu_items = $this->dynamic_menus->get_menu($id)->items;
			if(!empty($menu_items)) foreach($menu_items as $item)
			{
				$this->menus_items->delete($item->id);
			}
		}
		
		redirect(base_url().'admin/menu_module/menus');
	}
	
	public function delete_img($id)
	{
		$object_info = array(
			"object_type" => "dynamic_menus",
			"id" => $id
		);
		$item_id = $this->images->delete_img($object_info);
		redirect(base_url().'admin/menu_module/menu/'.$item_id);
	}
	
	public function delete_item($id)
	{
		$menu = $this->menus_items->get_item($id);
		$this->menus_items->delete($id);
		redirect(base_url().'admin/menu_module/menu/edit/'.$menu->menu_id);
	}
	
	/*********************************************************************
	* аякс функции
	*********************************************************************/
	
	public function menu_item(){
		$info = json_decode(file_get_contents('php://input', true));
		
		if(!isset($info->type)) add_log("menu_module", "не задан id пункта");
		
		$item = $this->menus_items->get_item($info->id);
		
		$data['item'] = $item;
		echo json_encode($data);
	}
}

/* End of file menu_module.php */
/* Location: ./application/controllers/admin/menu_module.php */