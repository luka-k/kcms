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
		
		if(!isset($info->type)) add_log("characteristics_autocomplete", "Не задан типфильра для автозаполнения");
		
		$items = $this->characteristics->get_list(array("type" => $info->type));
		$available_tags = array();
		foreach($items as $i)
		{
			$available_tags[] = $i->value;
		}
		$answer['available_tags'] = array_unique($available_tags);
		
		echo json_encode($answer);
	}	
	
	/**
	* Добавление рекомендованого товара
	*/
	public function add_recommend()
	{
		$info = json_decode(file_get_contents('php://input', true));
		
		if(!isset($info->name)) add_log("characteristics", "Не задан тип фильтра для автозаполнения");
		
		$product_2 = $this->products->get_item_by(array("name" => $info->name));
		
		if($product_2)
		{
			$this->recommended_products->insert(array("product1_id" => $info->product1_id, "product2_id" => $product_2->id));
			
			$answer = array(
				'base_url' => base_url(),
				'product_2' => $product_2
			);
		}
		else
		{
			$answer = "error";
		}
			
		echo json_encode($answer);
	}
}