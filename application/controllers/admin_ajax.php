<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Ajax controller for admin

class Admin_ajax extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->config->load('order_config');
	}
	
	public function change_sort()
	{
		$info = json_decode(file_get_contents('php://input', true));
		$this->$info->type->update($info->item_id, array("sort" => $info->sort));
		$data['message'] = "Ok";
		echo json_encode($data);
	}

	public function sortable(){
		$post = $this->input->post();
		foreach($post as $type => $items)
		{
			foreach ($items as $key => $id)
			{
				$this->$type->update($id, array("sort" => $key));
			}
		}
	}	
	
	public function edit_item()
	{
		$data = json_decode(file_get_contents('php://input', true));
		$info = (array)$data->info;
		$info = $this->menus_items->editors_post($info);
		if($info->error == TRUE)
		{
			//Если валидация не прошла формируем сообщение об ошибке
			$resultat['error'] = validation_errors();;
		}
		else
		{
			$resultat['error'] = FALSE;
			if($info->data->id == FALSE)
			{
				//Если id пустая создаем новый пункт в базе
				$this->db->where("parent_id", $info->data->parent_id);
				$this->db->select_max('sort');
				$query = $this->db->get('menus_items');
				$max_sort = $query->row()->sort;
				
				$info->data->sort = $max_sort+1;
				$this->menus_items->insert($info->data);
				$info->id = $this->db->insert_id();
				
				$resultat['after'] = $this->menus_items->get_item_by(array("parent_id" => $info->data->parent_id, "sort" => $max_sort));
				$resultat['item'] = $info->data;
			}
			else
			{
				//Если id не пустая вносим изменения.
				$this->menus_items->update($info->data->id, $info->data);
			}
		} 
		echo json_encode($resultat);
	}
	
	public function menu_item(){
		$info = json_decode(file_get_contents('php://input', true));
		$item = $this->menus_items->get_item_by(array("id" => $info->id));
		
		$data['item'] = $item;
		echo json_encode($data);
	}
}