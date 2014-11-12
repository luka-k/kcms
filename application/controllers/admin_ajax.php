<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Ajax controller for admin

class Admin_ajax extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->config->load('order_config');
	}
	
	public function edit_item()
	{
		$data = json_decode(file_get_contents('php://input', true));
		$info = (array)$data->info;
		$info = $this->menus_items->editors_post($info);
		//var_dump($info);
		
		if($info->error == TRUE)
		{
			//Если валидация не прошла формируем сообщение об ошибке
		}
		else
		{
			if($info->data->id == FALSE)
			{
				//Если id пустая создаем новый пункт в базе
				$this->menus_items->insert($info->data);
				$info->id = $this->db->insert_id();				
			}
			else
			{
				//Если id не пустая вносим изменения.
				$this->menus_items->update($info->data->id, $info->data);
			}
		
		}
		
		echo json_encode($data);
	}
	
	public function menu_item(){
		$info = json_decode(file_get_contents('php://input', true));
		$item = $this->menus_items->get_item_by(array("id" => $info->id));
		
		$data['item'] = $item;
		echo json_encode($data);
	}
}