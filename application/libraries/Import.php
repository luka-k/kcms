<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Библиотека импорта
*/
class Import{

	var $CI;

	function __construct()
	{
		$this->CI =& get_instance();
	}
	
	/**
	*
	*
	* @param
	*
	* @return
	*/
	public function import_categories($categories = array())
	{
		foreach($categories as $c)
		{
			$category = $this->CI->categories->get_item_by(array("name" => $c['category_name']));
			if(!$category)
			{
				$parent_category = $this->CI->categories->get_item_by(array("name" => $c['parent_category_name']));
				
				$data = array(
					"name" => $c['category_name'],
					"parent_id" => $parent_category->id,
				);
				
				$this->CI->categories->insert($data);
				
				if(isset($c['image']))
				{
					$object_info = array(
						"object_type" => "categories",
						"object_id" => $this->CI->db->insert_id()
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
	}
	
	/**
	*
	*
	* @param
	*
	* @return
	*/
	public function import_products($products = array())
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
			
			$parent_category = $this->CI->categories->get_item_by(array("name" => $p['parent_category']));
			$data['parent_id'] = $parent_category->id;

			$this->CI->products->insert($data);
		}
	}
	
	/**
	*
	*
	* @param
	*
	* @return
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
				$this->products->insert(array("name" => $i[0]));
				$object_info = array(
					"object_type" => "products",
					"object_id" => $this->db->insert_id()
				);
				
				$file_name = array_reverse(explode("/", $i[1]));
				
				$img = array(
					"tmp_name" => $images_dir_name.trim($i[1]),
					"name" => $file_name[0]
				);
				
				$answer = $this->images->upload_image($img, $object_info);
			}
		}
	}
	
}