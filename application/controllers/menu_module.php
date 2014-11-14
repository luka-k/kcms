<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu_module extends CI_Controller 
{	
	public $menu;
	public $user_name;
	public $user_id;
	
	public function __construct()
	{
		parent::__construct();
		
		$user = $this->session->userdata('logged_in');
		$role = $this->session->userdata('role');

		if ((!$user)||($role <> "admin")) die(redirect(base_url().'registration/admin_enter'));	
		
		$this->menu = $this->menus->admin_menu;
		$this->user_name = $this->session->userdata('user_name');
		$this->user_id = $this->session->userdata('user_id');
	}
	
	public function menus()
	{
		$this->menu = $this->menus->set_active($this->menu, "menus");
		
		$data = array(
			'title' => "Меню",
			'error' => "",
			'user_name' => $this->user_name,
			'user_id' => $this->user_id,
			'menu' => $this->menu,
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
		$this->menu = $this->menus->set_active($this->menu, "menus");
		$editors = $this->dynamic_menus->editors;
		$items_editors = $this->menus_items->editors;
		
		if($id == FALSE)
		{	
			$content = new stdClass();
			foreach ($editors as $tabs)
			{
				foreach ($tabs as $item => $value)
				{
					$content->$item = "";
				}
			}
			
			$content->img = NULL;
		}	
		else
		{			
			$content = $this->dynamic_menus->get_item_by(array("id" => $id));
			$menu_items = $this->menus_items->get_items(array("menu_id" => $id));

			$object_info = array(
				"object_type" => "dynamic_menus",
				"object_id" => $content->id
			);
			$content->img = $this->images->get_images($object_info, "catalog_small");		
		}
		
		$item_content = new stdClass();
		foreach ($items_editors as $tabs)
		{
			foreach ($tabs as $item => $value)
			{
				$item_content->$item = "";
			}
		}
		$item_content->menu_id = $id;	
		$item_content->parent_id = $id;
		$item_content->img = NULL;
		
		//var_dump($this->menus_items->editors);
		
		$data = array(
			'title' => "Редактировать меню",
			'error' => "",
			'user_name' => $this->user_name,
			'user_id' => $this->user_id,
			'menu' => $this->menu,
			'type' => "dynamic_menus",
			'editors' => $editors,
			'content' => $content,
			'menu_items' => $this->menus_items->menu_tree($id),
			'items_editors' => $this->menus_items->editors,
			'selects' => array(
				'parent_id' =>$this->menus_items->menu_tree($id)
			),
			'item_content' => $item_content
		);	
			
		$this->load->view("admin/menu", $data);
	}
	
	public function edit_menu($exit = FALSE)
	{
		$this->menu = $this->menus->set_active($this->menu, "menus");
		
		$editors = $this->dynamic_menus->editors;
		$items_editors = $this->menus_items->editors;
		
		$content = $this->dynamic_menus->editors_post()->data;
		
		$data = array(
			'title' => "Редактировать меню",
			'error' => "",
			'user_name' => $this->user_name,
			'user_id' => $this->user_id,
			'menu' => $this->menu,
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
		
		
		$exit == false ? redirect(base_url()."menu_module/menu/".$content->id) : redirect(base_url().'menu_module/menus');
	}
	
	public function delete_menu($id)
	{
		if($this->dynamic_menus->delete($id)) redirect(base_url().'menu_module/menus');
	}
	
	public function delete_img($id)
	{
		$object_info = array(
			"object_type" => "dynamic_menus",
			"id" => $id
		);
		$item_id = $this->images->delete_img($object_info);
		redirect(base_url().'menu_module/menu/'.$item_id);
	}
	
	public function delete_item($id)
	{
		$menu = $this->menus_items->get_item_by(array("id" => $id));
		if($this->menus_items->delete($id)) redirect(base_url().'menu_module/menu/'.$menu->menu_id);
	}
}