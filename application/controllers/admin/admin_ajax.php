<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Ajax controller for admin

class Admin_ajax extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();
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

	function autocomplete()
	{
		$info = json_decode(file_get_contents('php://input', true));
		$type = $info->type;
		$items = $this->characteristics->get_list(array("type" => $type));
		$available_tags = array();
		foreach($items as $i)
		{
			$available_tags[] = $i->value;
		}
		$answer['available_tags'] = array_unique($available_tags);
		
		echo json_encode($answer);
	}	
}