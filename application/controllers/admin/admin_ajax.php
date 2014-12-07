<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Ajax controller for admin

class Admin_ajax extends Admin_Controller 
{
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
			$result['error'] = strip_tags(validation_errors());
		}
		else
		{
			if($info->data->id == FALSE)
			{
				//Если id пустая создаем новый пункт в базе
				$this->db->where("parent_id", $info->data->parent_id);
				$this->db->select_max('sort');
				$query = $this->db->get('menus_items');
				$max_sort = $query->row()->sort;
				
				$info->data->sort = $max_sort+1;
				$this->menus_items->insert($info->data);
				$info->data->id = $this->db->insert_id();
				
				$result = array(
					'error' => FALSE,
					'after' => $this->menus_items->get_item_by(array("parent_id" => $info->data->parent_id, "sort" => $max_sort)),
					'item' => $info->data,
					'base_url' => base_url()
				);
			}
			else
			{
				//Если id не пустая вносим изменения.
				$this->menus_items->update($info->data->id, $info->data);
				$result = array(
					'item' => $info->data,
					'error' => FALSE
				);
			}
		} 
		echo json_encode($result);
	}
	
	public function menu_item(){
		$info = json_decode(file_get_contents('php://input', true));
		$item = $this->menus_items->get_item_by(array("id" => $info->id));
		
		$data['item'] = $item;
		echo json_encode($data);
	}
	
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
	
	function subscribe()
	{
		$info = json_decode(file_get_contents('php://input', true));
		$item = $this->subscribes->get_item_by(array("email" => $info->subscribe->email));
		if(empty($item))
		{
			$this->subscribes->insert($info->subscribe);
			$answer['message'] = "Поздравляем! Вы успешно подписались на наши новости.";
		}
		else
		{
			$answer['message'] = "Подписка на данный email уже оформлена";
		}
		
		echo json_encode($answer);
	}
}