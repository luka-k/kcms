<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Import class
* 
* @package		kcms
* @subpackage	Libraries
* @category	    Import
*/
class Import{

	var $CI;

	function __construct()
	{
		$this->CI =& get_instance();
	}
	
	/**
	* Импортирование категорий
	*
	* @param array $categories
	* @param bool $need_update
	* @param bool $need_create
	* @param bool $need_img_upload
	*/
	public function import_categories($categories = array(), $need_update = FALSE, $need_create = FALSE, $need_img_upload = FALSE)
	{
		foreach($categories as $c)
		{
			$category = $this->CI->categories->get_item_by(array("name" => $c['category_name']));
			$parent_category = $this->CI->categories->get_item_by(array("name" => $c['parent_category_name']));
			
			$data = array(
				"name" => $c['category_name'],
				"parent_id" => $parent_category->id,
			);
			
			if($category)
			{
				if($need_update) 
				{
					$this->CI->categories->update($category->id, $data);
					$object_id = $category->id;
				}
			}
			else
			{
				if($need_create)
				{
					$this->CI->categories->insert($data);
					$object_id = $this->CI->db->insert_id();
				}
			}

			if($need_img_upload)
			{
				$object_info = array(
					"object_type" => "categories",
					"object_id" => $object_id
				);
				
				$file_name = array_reverse(explode("/", $c['image']));
				
				$img = array(
					"tmp_name" => trim(FCPATH."import/images".$c['image']),
					"name" => $file_name[0]
				);
				
				$answer = $this->CI->images->upload_image($img, $object_info);
			}
		}
	}
	
	/**
	* Импортирование продуктов
	*
	* @param array $products
	* @param bool $need_update
	* @param bool $need_create
	* @param bool $need_img_upload
	*/
	public function import_products($products = array(), $need_update = FALSE, $need_create = FALSE, $need_img_upload = FALSE)
	{
		$editors = $this->CI->products->editors;

		foreach($products as $p)
		{
			$data = array();
			foreach($p as $field => $value)
			{
				if(editors_key_exists($field, $editors))
				{
					$data[$field] = $value;
				}
			}
			
			$product = $this->CI->products->get_item_by(array("name" => $p['name']));
			$parent_category = $this->CI->categories->get_item_by(array("name" => $p['parent_category']));
			$data['parent_id'] = $parent_category->id;
			
			if($product)
			{
				if($need_update) 
				{
					$this->CI->products->update($product->id, $data);
					$object_id = $category->id;
				}

			}
			else
			{
				if($need_create)
				{
					$this->CI->products->insert($data);
					$object_id = $this->CI->db->insert_id();
				}
			}
			
			if($need_img_upload)
			{
				$object_info = array(
					"object_type" => "products",
					"object_id" => $object_id
				);
				
				foreach($p['images'] as $image)
				{
					$file_name = array_reverse(explode("/", $image));
					$img = array(
						"tmp_name" => trim(FCPATH."import/images/".$image),
						"name" => $file_name[0]
					);
				
					$answer = $this->CI->images->upload_image($img, $object_info);
				}
			}
		}
	}
	
	/**
	* импортирование изображений
	*/
	public function import_images()
	{
		$filename = FCPATH."import/import.csv";
		$images_dir_name = FCPATH."import/images/";
		
		$file = fopen($filename, "r");
		
		if ($file) 
		{
			$info = array();
			while(!feof($file))
			{
				$buffer = fgets($file, 4096);
				$info[] = explode("; ", $buffer);
			}
			fclose($file);
			
			foreach($info as $i)
			{
				$data = array();
				foreach($i as $key => $value)
				{
					$data[$info[0][$key]] = $value;
				}

				$data["object_type"] = "products";
				
				$file_name = array_reverse(explode("/", $data['name']));
				
				$img = array(
					"tmp_name" => $images_dir_name.trim($data['name']),
					"name" => $file_name[0]
				);
				
				$answer = $this->images->upload_image($img, $data);
			}
		}
	}
	
}