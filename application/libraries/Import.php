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
		
		$this->CI->load->library('string_edit');
	}
	
	public function import_from_1c($xmlstr)
	{
		$this->CI->db->truncate('characteristics');
		$this->CI->db->truncate('characteristic2product');
		
		$xml = new SimpleXMLElement($xmlstr);
		
		// Тут уже наверно все строго индивидуально для каждого отедльного случая.
		// Ну или какие то общие элементыу будут вырисовываться по мере появления проектов
		foreach($xml->Каталог->Товары->Товар as $el)
		{
			
		}
	}
	
	/**
	* Импортирование категорий
	*
	*/
	public function import_categories($categories)
	{
		$categoriesToInsert = array();
		
		$i = 0;
		foreach($categories->category as $category)
		{
			$categoriesToInsert[$i] = array(
				'id' => $category->attributes()->id->__toString(),
				'parent_id' => 0,
				'name' => (string)$category,
				'url' => $this->CI->string_edit->slug((string)$category)
			);
			
			echo $categoriesToInsert[$i]['name']."<br />";

			if($category->attributes()->parentId) $categoriesToInsert[$i]['parent_id'] = $category->attributes()->parentId->__toString();		
			$i++;
		}
		
		$this->CI->db->insert_batch('categories', $categoriesToInsert);
	}
	
	/**
	* Импортирование продуктов
	*
	*/
	public function import_offers($offers)
	{
		$this->CI->config->load('upload');
		$upload_path = $this->CI->config->item('upload_path');
	
		$i = 0;
		foreach($offers->offer as $o)
		{
			$offerToInsert = array(
				'ISBN' => $o->attributes()->id->__toString(),
				'name' => $o->name->__toString(),
				'url' => $this->CI->string_edit->slug($o->name->__toString()),
				'price' => $o->price->__toString(),
				'parent_id' => $o->categoryId->__toString(),
				'description' => $o->description->__toString(),
				'autor' => 'Автор Авторович',
				'weight' => '100'
			);
			
			echo $offerToInsert['name']."<br />";
			
			$this->CI->db->insert('products', $offerToInsert);
			
			$productId = $this->CI->db->insert_id();
			
			$img_info = $this->CI->images->get_unique_info($offerToInsert['url'].'.jpg');
	
			$url = $o->picture->__toString();
			$path = trim(make_upload_path($img_info->name, $upload_path).$img_info->name);
			
			file_put_contents($path, file_get_contents($url));
			
			$this->CI->images->generate_thumbs($path);
			
			$imageToInsert = array(
				'object_type' => 'products',
				'object_id' => $productId,
				'name' => $img_info->name,
				'url' => $img_info->url,
				'is_cover' => 1
			);	
			
			$this->CI->db->insert('images', $imageToInsert);
			
			$i++;
		}
	}
	
	public function importCategoriesFromHtml($str) 
	{
		$this->CI->db->truncate('categories');
		$rows = explode("\n", $str);
		$tree = array(0);
		$lastrow_id = 0;
		$id = 0;
		$categoriesToInsert = array();
		foreach ($rows as $row) {
			if (strstr($row, '<ul')) {
				$tree[] = $lastrow_id;
			} else if (strstr($row, '</ul>')) {
				for ($i = 0; $i < substr_count($row, '</ul>'); $i++) {
					array_pop($tree);
				}
			} else if (strstr($row, '<li')) {
				$name = strip_tags($row);
				$id++;
				$lastrow_id = $id;
				if ($id >= 16)
					$categoriesToInsert[] = array(
						'id' => $id,
						'name' => trim($name),
						'sort' => $id,
						'url' => trim($this->CI->string_edit->slug($name)),
						'parent_id' => $tree[count($tree)-1] == 2 ? 0 : $tree[count($tree)-1] 
					);
			}
		}
		print_r($categoriesToInsert);
		
		$this->CI->db->insert_batch('categories', $categoriesToInsert);
	}

}