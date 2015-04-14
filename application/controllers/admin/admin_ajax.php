<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Admin_ajax class
*
* @package		kcms
* @subpackage	Controllers
* @category	    admin_ajax
*/
class Admin_ajax extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();
	}

	/**
	* Сортировка элементов
	*/
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

	/**
	* Автокомплит
	*/
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