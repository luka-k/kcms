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
			'error' => "",
			'user_name' => $this->user_name,
			'user_id' => $this->user_id,
			'menu' => $this->menus->set_active($this->menu, "menus"),
			'name' => editors_field_exists('name', $this->dynamic_menus->editors),
			'content' => $this->dynamic_menus->get_list(FALSE)
		);	
		
		if(editors_field_exists('img', $this->dynamic_menus->editors))
		{
			$data['content'] = $this->images->get_img_list($data['content'], "menu", "catalog_mid");
			$data['images'] = TRUE;
		}
		$this->load->view("admin/menus", $data);
	}
	
	public function menu($id = FALSE)
	{
		$editors = $this->dynamic_menus->editors;
		$items_editors = $this->menus_items->editors;
		
		if($id == FALSE)
		{	
			$content = set_empty_fields($editors);
			$content->img = NULL;
		}	
		else
		{			
			$content = $this->dynamic_menus->get_item_by(array("id" => $id));

			$object_info = array(
				"object_type" => "dynamic_menus",
				"object_id" => $content->id
			);
			$content->img = $this->images->get_images($object_info, "catalog_small");		
		}
		
		$item_content = set_empty_fields($item_editors);
		$item_content->menu_id = $id;	
		$item_content->parent_id = 0;
		$item_content->img = NULL;
		
		//Задаем типы ссылок на которые может ссылаться пункт меню
		$types = array(
			"Статьи" => "articles"
		);
		
		$data = array(
			'title' => "Редактировать меню",
			'error' => "",
			'user_name' => $this->user_name,
			'user_id' => $this->user_id,
			'menu' => $this->menus->set_active($this->menu, "menus"),
			'type' => "dynamic_menus",
			'editors' => $editors,
			'content' => $content,
			'menu_items' => $this->menus_items->menu_tree($id),
			'items_editors' => $this->menus_items->editors,
			'selects' => array(
				'parent_id' =>$this->menus_items->menu_tree($id),
				'url' => $this->articles->get_site_tree(0, "parent_id")
			),
			'types' => $types,
			'item_content' => $item_content
		);	
		$this->load->view("admin/menu", $data);
	}
	
	public function edit_menu($exit = FALSE)
	{
		$editors = $this->dynamic_menus->editors;
		$items_editors = $this->menus_items->editors;
		
		$content = $this->dynamic_menus->editors_post()->data;
		
		$data = array(
			'title' => "Редактировать меню",
			'error' => "",
			'user_name' => $this->user_name,
			'user_id' => $this->user_id,
			'menu' => $this->menus->set_active($this->menu, "menus"),
			'type' => "dynamic_menus",
			'editors' => $editors,
			'content' => $content
		);

		if($this->dynamic_menus->editors_post()->error == TRUE)
		{
			//Если валидация не прошла выводим сообщение об ошибке
			$this->load->view('admin/menu', $data);			
		}
		else
		{
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
			
			$field_name = editors_field_exists('img', $editors);
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
		}
		$exit == false ? redirect(base_url()."admin/menu_module/menu/".$content->id) : redirect(base_url().'admin/menu_module/menus');
	}
	
	public function delete_menu($id)
	{
		if($this->dynamic_menus->delete($id)) redirect(base_url().'admin/menu_module/menus');
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
		$menu = $this->menus_items->get_item_by(array("id" => $id));
		if($this->menus_items->delete($id)) redirect(base_url().'admin/menu_module/menu/'.$menu->menu_id);
	}
}

/* End of file menu_module.php */
/* Location: ./application/controllers/admin/menu_module.php */