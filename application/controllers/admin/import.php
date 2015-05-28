<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Import class
*
* @package		kcms
* @subpackage	Controllers
* @category	    import
*/
class Import extends Admin_Controller 
{

	public function __construct()
	{
		parent::__construct();
	}
	
	public function load1COffers()
	{
		$xmlstr = file_get_contents('1c/offers.xml');
		$xml = new SimpleXMLElement($xmlstr);
		
		echo '<head><meta charset="UTF-8"></head><body><pre>';
		 
		foreach($xml->ПакетПредложений->Предложения->Предложение as $el)
		{
			$id = (string) $el->Ид;
			$product = $this->products->get_item_by(array('1c_id' => $id));
			if (!$product)
			{
				echo $name."\n";
				continue;
			}
			$price = (string) $el->Цены->Цена->ЦенаЗаЕдиницу;
			$this->products->update($product->id, array('price' => $price));
		}
	}
	
	public function load1CCategories()
	{
		// удаляем все привязки
		$this->db->delete('category2category');
		
		
		$xmlstr = file_get_contents('1c/import.xml');
		$xml = new SimpleXMLElement($xmlstr);
		
		echo '<head><meta charset="UTF-8"></head><body><pre>';
		
		$total = 0;

		foreach($xml->Каталог->Товары->Товар as $el)
		{
			$total++;
			$id = (string) $el->Ид;
			$sku = (string) $el->Артикул;
			$cat1 = array(); // Группы товаров 1
			
			$data = array(
				'1c_id' => $id,
				'sku' => $sku
			);
			
			foreach ($el->ЗначенияРеквизитов->ЗначениеРеквизита as $param)
			{
				switch ((string) $param->Наименование)
				{
					case 'Группы товаров 1 уровня':
						$cat1 = explode(';', (string) $param->Значение);
						break;
					case 'Группа товаров 2 уровня':
						$cat2 = (string) $param->Значение;
						break;
				}
			}
			
			echo "start updating...\n";
			
			
			if ($cat2)
			{
				$category = $this->categories->get_item_by(array('name' => $cat2));
				if (!$category)
				{
					$this->categories->insert(array('name' => $cat2, 'url' => $this->string_edit->slug($cat2)));
					$category = $this->categories->get_item($this->db->insert_id());
				}
				
				foreach ($cat1 as $c1)
				{
					$c1 = trim($c1);
					if (!$c1) continue;
					$parentcategory = $this->categories->get_item_by(array('name' => $c1));
					if (!$parentcategory)
					{
						$this->categories->insert(array('name' => $c1, 'url' => $this->string_edit->slug($c1)));
						$pid = $this->db->insert_id();
						$parentcategory = $this->categories->get_item($pid);
					
						$category2category = array(
							'category_parent_id' => 0,
							'child_id' => $pid
						); 
						
						if (!$this->db->get_where('category2category', $category2category)->result())				
							$this->db->insert('category2category', $category2category);
						
					}
					
					$category2category = array(
						'category_parent_id' => $parentcategory->id,
						'child_id' => $category->id
					);
					
					if (!$this->db->get_where('category2category', $category2category)->result())				
						$this->db->insert('category2category', $category2category);
				}
			}
		}
	}
	
	public function load1CRecommended()
	{	
		$xmlstr = file_get_contents('1c/import.xml');
		$xml = new SimpleXMLElement($xmlstr);
		
		echo '<head><meta charset="UTF-8"></head><body><pre>';
		
		$total = 0;

		foreach($xml->Каталог->Товары->Товар as $el)
		{
			$total++;
			$id = (string) $el->Ид;
			$sku = (string) $el->Артикул;
			$recommended_1 = array(); // Продаваемые совместно
			$recommended_2 = array(); // Аналоги
			$recommended_3 = array(); // Запчасти
			
			$data = array(
				'1c_id' => $id,
				'sku' => $sku
			);
			
			foreach ($el->ЗначенияРеквизитов->ЗначениеРеквизита as $param)
			{
				switch ((string) $param->Наименование)
				{
					case 'Продаваемые совместно':
						$recommended_1 = explode(',', (string) $param->Значение);
						break;
					case 'Аналоги':
						$recommended_2 = explode(',', (string) $param->Значение);
						break;
					case 'Запчасти':
						$recommended_3 = explode(',', (string) $param->Значение);
						break;
				}
			}
			
			$product = $this->products->get_item_by(array('1c_id' => $data['1c_id']));
			if (!$product) 
				continue;
			
			echo "start updating...\n";
			
			// TODO: заполнить базу!!!
			
		}
	}
				
	public function load1C()
	{
		$xmlstr = file_get_contents('1c/import.xml');
		$xml = new SimpleXMLElement($xmlstr);
		
		echo '<head><meta charset="UTF-8"></head><body><pre>';
		
		$total = 0;

		foreach($xml->Каталог->Товары->Товар as $el)
		{
			$total++;
			//if ($total > 20) die('done');
			$manufacturer = (string) $el->Изготовитель->Наименование;
			$id = (string) $el->Ид;
			$name = (string) $el->Наименование;
			echo $total.': '.$name."\n";
			$sku = (string) $el->Артикул;
			$cat1 = array(); // Группы товаров 1
			$collections = array(); // Коллекции
			
			$filters = array(); //Характеристики
			
			$images = array();
			
			$data = array(
				'1c_id' => $id,
				'sku' => $sku,
				'sort' => $manufacturer
			);
			
			foreach ($el->ЗначенияРеквизитов->ЗначениеРеквизита as $param)
			{
				switch ((string) $param->Наименование)
				{
					case 'Группа товаров 1':
						$cat1 = explode(';', (string) $param->Значение);
						break;
					case 'Группа товаров 2 уровня':
						$cat2 = (string) $param->Значение;
						break;
					case 'Полное наименование':
						$data['name'] = (string) $param->Значение;
						break;
					case 'Коллекция (серия) 1':
						$collections = explode('(', (string) $param->Значение);
						foreach ($collections as $i => $collection)
						{
							$collections[$i] = str_replace(')', '', $collection);
						}
						$data['sort'] .= $collections[0];
						break;
					case 'Ширина':
						$value = (string) $param->Значение;
						if(!empty($value)) $data['width'] = $value;
						break;
					case 'Высота':
						$value = (string) $param->Значение;
						if(!empty($value)) $data['height'] = (string) $param->Значение;
						break;
					case 'Глубина':
						$value = (string) $param->Значение;
						if(!empty($value)) $data['depth'] = (string) $param->Значение;
						break;
					case 'Цвет':
						$filter = explode('/', (string) $param->Значение);
						foreach ($filter as $i => $f)
						{
							if(!empty($f)) $filters['color'][$i] = $f;
						}
						break;
					case 'Название товара':
						$value = (string) $param->Значение;
						if(!empty($value)) $filters['shortname'] = $value;
						/*$filter = explode('/', (string) $param->Значение);
						foreach ($filter as $i => $f)
						{
							if(!empty($f)) $filters['shortname'][$i] = $f;
						}*/
						break;
					case 'Описание товара':
						$value = (string) $param->Значение;
						if(!empty($value)) $filters['shortdesc'] = $value; 
						/*$filter = explode('/', (string) $param->Значение);
						foreach ($filter as $i => $f)
						{
							if(!empty($f)) $filters['shortdesc'][$i] = $f;
						}*/
						break;
					case 'Материал':
						$filter = explode('/', (string) $param->Значение);
						foreach ($filter as $i => $f)
						{
							if(!empty($f)) $filters['material'][$i] = $f;
						}
						break;
					case 'Отделка':
						$filter = explode('/', (string) $param->Значение);
						foreach ($filter as $i => $f)
						{
							if   (!empty($f)) $filters['finishing'][$i] = $f;
						}
						break;
					case 'Разворот':
						$filter = explode('/', (string) $param->Значение);
						foreach ($filter as $i => $f)
						{
							if(!empty($f)) $filters['turn'][$i] = $f;
						}
						break;
					case 'ОписаниеФайла':
						$images[] = '1c/'. ( (string) $param->Значение);
						break;
				}
			}
			$data['sort'] .= $sku;

			if ($this->products->get_item_by(array('1c_id' => $data['1c_id']))) 
				continue;
			 
			echo "start inserting...\n";
			
			$_manufacturer = $this->manufacturer->get_item_by(array('name' => $manufacturer));
			if (!$_manufacturer)
			{
				$this->manufacturer->insert(array('name' => $manufacturer, 'url' => $this->string_edit->slug($manufacturer)));
				$_manufacturer = $this->manufacturer->get_item($this->db->insert_id());
			}
			echo "manufacturer_id=".$_manufacturer->id."\n";
				
			$my_collections = array();
			if ($collections)
			{
				foreach ($collections as $collection)
				{
					$_collection = $this->collections->get_item_by(array('name' => trim($collection)));
					if (!$_collection)
					{
						$this->collections->insert(array('name' => trim($collection), 'url' => $this->string_edit->slug($collection)));
						$_collection = $this->collections->get_item($this->db->insert_id());
					}
					$my_collections[] = $_collection->id;
				}
			}
			
			if ($cat2)
			{
				$category = $this->categories->get_item_by(array('name' => $cat2));
				if (!$category)
				{
					$this->categories->insert(array('name' => $cat2, 'url' => $this->string_edit->slug($cat2)));
					$category = $this->categories->get_item($this->db->insert_id());
				}
				
				foreach ($cat1 as $c1)
				{
					$c1 = trim($c1);
					if (!$c1) continue;
					$parentcategory = $this->categories->get_item_by(array('name' => $c1));
					if (!$parentcategory)
					{
						$this->categories->insert(array('name' => $c1, 'url' => $this->string_edit->slug($c1)));
						$pid = $this->db->insert_id();
						$parentcategory = $this->categories->get_item($pid);
					
						$category2category = array(
							'category_parent_id' => 0,
							'child_id' => $pid
						); 
						
						if (!$this->db->get_where('category2category', $category2category)->result())				
							$this->db->insert('category2category', $category2category);
						
					}
					
					$category2category = array(
						'category_parent_id' => $parentcategory->id,
						'child_id' => $category->id
					);
					
					if (!$this->db->get_where('category2category', $category2category)->result())				
						$this->db->insert('category2category', $category2category);
				}
			
				$data['parent_id'] = $category->id;
				$data['is_active'] = 1;
				$data['price'] = 0;
				$data['manufacturer_id'] = $_manufacturer->id;
				$data['url'] = $this->string_edit->slug($data['name']);
				$this->products->insert($data);
				$product_id = $this->db->insert_id();
				
			
				foreach ($my_collections as $collection_id)
				{
					$product2collection = array(
						'collection_parent_id' => $collection_id,
						'child_id' => $product_id
					); 
					
					if (!$this->db->get_where('product2collection', $product2collection)->result())				
						$this->db->insert('product2collection', $product2collection);
				}
				
				if($filters)
				{
					foreach($filters as $type => $filter)
					{
						$characteristics = array(
							"type" => $type,
							'object_type' => "products",
							'object_id' => $product_id
						);
						if(is_array($filter))
						{
							foreach($filter as $value)
							{
								$characteristics['value'] = $value;
								if (!$this->db->get_where('characteristics', $characteristics)->result()) $this->db->insert('characteristics', $characteristics);
							}
						}
						else
						{
							$characteristics['value'] = $filter;
							if (!$this->db->get_where('characteristics', $characteristics)->result()) $this->db->insert('characteristics', $characteristics);
						}
						
					}	
				}
				
				// убрать для загрузки фото
				if (false)
					foreach ($images as $i => $im)
					{
						$newim = str_replace('.file', '.tiff', $im);
						if (file_exists(FCPATH.$im))
							rename (FCPATH.$im, FCPATH.$newim);
						$jpg = str_replace('.tiff', '.jpg', FCPATH.$newim);
						if (!file_exists($jpg))
						{
							$tiff = new Imagick(FCPATH.$newim);
							
							//$tiff->thumbnailImage(100, 100);
							$tiff->setImageFormat('jpg');
							$tiff->setCompressionQuality(97);
							$tiff->writeImage($jpg);
						}
						
						$this->images->upload_image($jpg, array('object_type' => 'products', 'object_id' => $product_id, 'is_cover' => ($i == 0 ? 1 : 0)));
					}
				
				//die('ok');
					
			}
		}
	}
	
	public function load1CImages($upload_jpg = false)
	{
		$xmlstr = file_get_contents('1c/import.xml');
		$xml = new SimpleXMLElement($xmlstr);
		
		echo '<head><meta charset="UTF-8"></head><body><pre>';
		
		ini_set('display_errors', 1);
		$total = 0;
		foreach($xml->Каталог->Товары->Товар as $el)
		{
			$total++;
			$id = (string) $el->Ид;
			$name = (string) $el->Наименование;
			//echo $total.': '.$id."\n";
			
			$images = array();
			$jpgs = array();
			
			$mainImage = (string) $el->Картинка;
			if ($mainImage)
				$images[] = '1c/'. $mainImage;
			
			$data = array(
				'1c_id' => $id
			);
			
			foreach ($el->ЗначенияРеквизитов->ЗначениеРеквизита as $param)
			{
				switch ((string) $param->Наименование)
				{
					case 'ОписаниеФайла':
						$image = '1c/'.( (string) $param->Значение);
						if ($image != $mainImage)
							$images[] =  $image;
						break;
				}
			}
			$product = ($this->products->get_item_by(array('1c_id' => $data['1c_id'])));
			if (!$product)
				continue;
			if ($this->images->get_list(array('object_type'=>'products', 'object_id' => $product->id))) 
				continue;
			 
			foreach ($images as $i => $im)
			{
				$im = explode('#', $im);
				$im = $im[0];
				if (strstr($im, '.tif'))
				{
					$newim = str_replace('.tif', '.tiff', $im);
					if (file_exists(FCPATH.$im) && !file_exists(FCPATH.$newim))
						rename (FCPATH.$im, FCPATH.$newim);
					$jpg = str_replace('.tif', '.jpg', FCPATH.$im);
					$jpgs[$jpg] = true;
					if (!file_exists($jpg))
					{
						echo  FCPATH.$im."\n";
						$tiff = new Imagick(FCPATH.$newim);
						
						//$tiff->thumbnailImage(100, 100);
						$tiff->setImageFormat('jpg');
						$tiff->setCompressionQuality(97);
						$tiff->writeImage($jpg);
					}
				
				}
				if (strstr($im, '.pdf'))
				{
					$jpg = str_replace('.pdf', '.jpg', FCPATH.$im);
					$jpgs[$jpg] = true;
					if (!file_exists($jpg))
					{
						$pdf = new Imagick();
						$pdf->setResolution(200,200);
						$pdf->readImage(FCPATH.$im);
						$pdf->setImageFormat('jpg');
						$pdf->setCompressionQuality(97);
						$pdf->writeImage($jpg);
					}
				}
				
				if ($upload_jpg)
				{
					$i = 0;
					foreach ($jpgs as $jpg => $ok)
					{
						echo $jpg.' '.$product->id."\n";
						$filename = explode('/', $jpg);
						$filename = $filename[count($filename)-1];
						$this->images->upload_image(array('name' => $filename, 'tmp_name' => $jpg), array('object_type' => 'products', 'object_id' => $product->id, 'is_cover' => ($i == 0 ? 1 : 0)));
						$i++;
					}
					//if ($i)
						//die('ok');
				}
			}
				
		}
		die('ok');
	}
}
