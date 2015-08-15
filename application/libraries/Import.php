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
	* Импортирование издательства hueber
	*
	* 
	*/
	public function hueber($xmlstr)
	{
		$xml = new SimpleXMLElement($xmlstr);

		echo '<span style="color:red">red text</span> - import failed.</br>';
		echo '<span style="color:orange">orange text</span> - import with error.</br>';
		echo '<span style="color:green">green text</span> - import ok.</br>';
		echo '<span style="color:blue">blue text</span> - update ok.</br></br>';
		echo 'Start...</br></br>';
		foreach($xml as $item)
		{
			if(!empty($item->productidentifier))
			{
				//product
				$product = array(
					'ISBN' => '',
					'name' => '',
					'autor' => '',
					'amount' => '',
					'description' => '',
					'year' => '',
					'height' => '',
					'width' => '',
					'depth' => '',
					'weight' => '',
					'lastmod' => date('Y-m-d')
				);
				
				if(isset($item->productidentifier->b244)) 
				{
					$product['ISBN'] = (string) $item->productidentifier->b244;
				}
				else
				{
					echo "<span style='color:red'>отсутствует ISBN книги</span></br></br>";
					continue;
				}
				
				if(isset($item->title))
				{
					if(isset($item->title->b203)) $product['name'] = (string) $item->title->b203;
					if(isset($item->title->b029)) $product['name'] .= ' '.(string) $item->title->b029;
				}
				else
				{
					echo "ISBN ".$product['ISBN']." - <span style='color:orange'>отсутствует заголовок книги.</span></br></br>";
				}
				
				if(isset($item->contributor))
				{
					$i = 1;
					foreach($item->contributor as $autor)
					{
						$product['autor'] .= (string) $autor->b036;
					
						if($i < count($item->contributor)) $product['autor'] .= ', ';
						$i++;
					}
				}
				
				if(isset($item->b061)) $product['amount'] = (string) $item->b061;
				
				if(isset($item->othertext->d104)) $product['description'] = (string) $item->othertext->d104;
				
				if(isset($item->b003)) $product['year'] = date('d-m-Y', (string) $item->b003);
				
				if(isset($item->measure))
				{
					foreach($item->measure as $measure)
					{
						$param = (string)$item->measure->c093;
						switch ($param) {
							case 01:
								$product['height'] = (string) $item->measure->c094.' '.(string) $item->measure->c095;
								break;
							case 02:
								$product['width'] = (string) $item->measure->c094.' '.(string) $item->measure->c095;
								break;
							case 03:
								$product['depth'] = (string) $item->measure->c094.' '.(string) $item->measure->c095;
								break;
							case 08:
								$product['weight'] = (string) $item->measure->c094.' '.(string) $item->measure->c095;
								break;
						}
					}
				}
							
				/*if(isset($item->publisher->b081))
				{
					$publicher = (string) $item->publisher->b081;
				}*/
				
				//characteristics
				$characteristics =array();
				
				if(isset($item->language->b252))
				{
					$characteristics[] = array(
						'type' => 'language',
						'value' => (string) $item->language->b252, //я как понимаю по какому то списку надо по коду название языка подставить
						'object_type' => 'products'
					);
				}
				
				//cover
				$img_path = '';
				if(isset($item->mediafile) && (integer)$item->mediafile->f114 < 8 && (integer)$item->mediafile->f114 > 3)
				{
					$img_path = (string) $item->mediafile->f117;
				}
				else
				{	
					echo "ISBN ".$product['ISBN']." - <span style='color:orange'>отсутствует обложка</span></br></br>";
				}
				
				$_product = $this->CI->products->get_item_by(array('ISBN' => $product['ISBN']));
				
				if (!$_product)
				{
					$this->CI->products->insert($product);
					$product_id = $this->CI->db->insert_id();
					
					echo "{$product['ISBN']} - {$product['name']} <span style='color:green'>imported.</span></br></br>";
				} 
				else 
				{
					$this->CI->products->update($_product->id, $product);
					$product_id = $_product->id;
					
					echo "{$product['ISBN']} - {$product['name']} <span style='color:blue'>update.</span></br></br>";
				}
				
				$this->CI->db->delete('characteristics', array('object_type' => "products", 'object_id' => $product_id));
				
				if(!empty($characteristics))
				{
					foreach($characteristics as $ch)
					{
						$ch['object_id'] = $product_id;
						$this->CI->characteristics->insert($ch);
					}
				}
				
				/*if(!empty($img_path))
				{
					$path = explode('/', $img_path);
					$img_name = $path[count($path) - 1];
					
					$upload_path = $this->CI->config->item('upload_path');
		
					$img_info = $this->CI->images->get_unique_info($img_name);
		
					$full_upload_path = trim(make_upload_path($img_info->name, $upload_path).$img_info->name);
					
					file_put_contents($full_upload_path, file_get_contents($img_path));
					$this->CI->images->generate_thumbs($full_upload_path);
					
					$name = explode(".", $img_info->name);
					
					$object_info = array(
						'url' => $img_info->url,
						'name' => $name[0],
						'object_type' => 'products',
						'object_id' => $product_id
					);

					$this->CI->images->insert($object_info);
				}*/
			}  
		}
	}
	
	public function macmillan()
	{
		
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
	public function import_csv($filename)
	{
		$file = fopen($filename, "r");
		
		if ($file) 
		{
			$info = array();
			while(!feof($file))
			{
				$info[] = fgetcsv($file, 0, ";");
			}
			
			fclose($file);
			
			$imported = array();
			
			foreach($info as $key => $i)
			{
				if($key <> 0)
				{
					$field = array();
					foreach($item as $key_2 => $value)
					{
						$field[$info[0][$key_2]] = $value;
					}
					
					$imported[] = $field;
				}
			}
			
			//Ђ тут вызов нужной функции импорта. ЌЂпример:
			//$this->import_categories($imported, TRUE, FALSE, FALSE);
		}
	}
	
}