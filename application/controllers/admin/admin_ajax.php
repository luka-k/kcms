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
	
	function anchor_autocomplete()
	{
		$type = json_decode(file_get_contents('php://input', true));
		$products = $this->products->get_list(FALSE);
		foreach($products as $p)
		{
			$available_tags[] = $p->name;
		}
		$answer['available_tags'] = $available_tags;
		$answer['type'] = $type;
		
		echo json_encode($answer);
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
	
	/**
	* Создание привязок товара к аналогичным, комплектующим и запчастям
	*/
	public function add_anchor()
	{
		$info = json_decode(file_get_contents('php://input', true));
		$base = $info->type."_products";
		$product_2 = $this->products->get_item_by(array("name" => $info->name));
		
		if($product_2)
		{
			$this->$base->insert(array("product1_id" => $info->product1_id, "product2_id" => $product_2->id));
			
			$answer = array(
				'base_url' => base_url(),
				'type' => $info->type,
				'product_2' => $product_2
			);
		}
		else
		{
			$answer = "error";
		}
			
		echo json_encode($answer);
	}
	
	public function categories_by_manufacturer()
	{
		$manufacturer_id = json_decode(file_get_contents('php://input', true));
		
		$data['category_by_manufacturer'] = array();
		$categories_checked = $this->table2table->get_parent_ids("manufacturer2category", "category_id", "manufacturer_id", $manufacturer_id);
					
		if(!empty($categories_checked))
		{
			$this->db->where_in('parent_id', $categories_checked);
			$products = $this->db->get('products')->result();
			if(!empty($products))
				$data['category_by_manufacturer'] = $this->categories->get_tree($products);
		}
		
		$content = $this->load->view('admin/include/ajax_tree.php', $data, TRUE);
		
		echo json_encode($content);
	}
}