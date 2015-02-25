<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//main page controller

class Popup_gallery extends Client_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	
	public function view()
	{		
		$action = $this->input->get("action");

		if($action == "main")
		{
			$first_img = $this->input->get("first_img");
		
			$gallery = $this->images->get_list(array("object_type" => "products", "is_main" => 1));
			
			$gallery_title = "Галерея (the best)";
		}
		elseif($action == "category")
		{
			$category_id = $this->input->get("category_id");
			$category = $this->categories->get_item_by(array("id" => $category_id));
			
			$this->db->select('child_id');
			$img_ids = $this->images2categories->get_list(array("category_parent_id" => $category_id));
					
			$sub_category = $this->categories->get_list(array("parent_id" => $category_id));
			if($sub_category) foreach($sub_category as $s_c)
			{
				$this->db->select('child_id');
				$img_ids = array_merge($img_ids, $this->images2categories->get_list(array("category_parent_id" => $s_c->id)));
			}
					
			$gallery = array();
				
			foreach($img_ids as $i)
			{
				$gallery[] = $this->images->get_item_by(array("id" => $i->child_id));
			}
			
			$gallery_title = $category->name;
		}
		elseif("product")
		{
			$product_id = $this->input->get("product_id");
			
			$product = $this->products->get_item_by(array("id" => $product_id));
			
			$gallery = $this->images->get_list(array("object_type" => "products", "object_id" => $product_id));
						
			$gallery_title = $product->name;
		}

		foreach($gallery as $key => $img)
		{
			if(!empty($img))
			{
				$gallery[$key] = $this->images->_get_urls($img);
			
				$type = $img->object_type;
				$id = $img->object_id;
			
				$gallery[$key]->info = $this->$type->get_item_by(array("id" => $id));
			}
			else
			{
				unset($gallery[$key]);
			}
		}
		
		$data = array(
			'tree' => $this->categories->get_site_tree($this->config->item('works_id'), "parent_id"),
			"gallery" => $gallery,
			"gallery_title" => $gallery_title
		);
		
		$this->load->view('client/popup_gallery', $data);
	}	
}