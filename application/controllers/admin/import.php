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
		$xmlstr = file_get_contents('1c_exchange/offers0_1.xml');
		$xml = new SimpleXMLElement($xmlstr);
		
		$settings = $this->settings->get_item_by(array("id" => 1));
		
		echo '<head><meta charset="UTF-8"></head><body><pre>';
		 
		$this->load->library('curs');
		$curs=new curs('download/curs.txt');
		
		foreach($xml->ПакетПредложений->Предложения->Предложение as $el)
		{
			$id = (string) $el->Ид;
			$product = $this->products->get_item_by(array('1c_id' => $id));
			if (!$product)
			{
				echo $name."\n";
				continue;
			}
			
			$price = 0;
			$sale_price = 0;
			$price_ru = 0;
			$price_eur = 0;
			foreach ( $el->Цены->Цена as $item)
			{
				if ((string) $item->ИдТипаЦены == 'd21e8793-6e5c-11e4-a943-e8de2701d5f9' && (string) $item->Валюта == 'RUB')
				{
					$price_ru = (string) $item->ЦенаЗаЕдиницу;
				}
				if ((string) $item->ИдТипаЦены == 'f4aca4ac-6e24-11e4-a943-e8de2701d5f9' && (string) $item->Валюта == 'EUR')
				{
					$price_eur = (string) $item->ЦенаЗаЕдиницу;
				}
			}
			if ($price_eur && !$price_ru)
			{
				$price_ru = $price_eur * $curs->cursNew["EUR"];
				$price_ru = (100 + $settings->percent_euro) / 100 * $price_ru;
			}
			$price = $price_ru;
			
			if ($product->sale)
			{
				$sale_price = (100 - $settings->percent_discount) / 100 * $price;
			} else {
				if (!$sale_price && $price)
				{
					$sale_price = (100 - $settings->percent_roz) / 100 * $price;
				}
			}
			
			$this->products->update($product->id, array('price' => $price, 'sale_price' => $sale_price));
		}
	}
	
	public function load1CCategories()
	{
		// удаляем все привязки
		$this->db->delete('category2category');
		
		
		$xmlstr = file_get_contents('1c_exchange/import0_1.xml');
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
					$this->categories->insert(array('name' => $cat2, 'url' => $this->string_edit->slug($cat2), 'lastmod' => date("Y-m-d", filemtime('1c_exchange/import0_1.xml'))));
					$category = $this->categories->get_item($this->db->insert_id());
				}
				
				foreach ($cat1 as $c1)
				{
					$c1 = trim($c1);
					if (!$c1) continue;
					$parentcategory = $this->categories->get_item_by(array('name' => $c1));
					if (!$parentcategory)
					{
						$this->categories->insert(array('name' => $c1, 'url' => $this->string_edit->slug($c1), 'lastmod' => date("Y-m-d", filemtime('1c_exchange/import0_1.xml'))));
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
		$xmlstr = file_get_contents('1c_exchange/import0_1.xml');
		$xml = new SimpleXMLElement($xmlstr);
		
		echo '<head><meta charset="UTF-8"></head><body><pre>';
		
		$total = 0;
			$this->db->empty_table('components_products');
			$this->db->empty_table('accessories_products');
			$this->db->empty_table('recommended_products');

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
			if(!empty($recommended_2))foreach($recommended_2 as $sku)
			{
				$anchor_product = $this->products->get_item_by(array("sku" => $sku));
				if($anchor_product)
				{
					$data = array(
						"product1_id" => $product->id,
						"product2_id" => $anchor_product->id
					);
					
					$this->recommended_products->insert($data);
					echo $anchor_product->name." аналогичный товар к ".$product->name."\n";
				}
			
			}
			if(!empty($recommended_1))foreach($recommended_1 as $sku)
			{
				$anchor_product = $this->products->get_item_by(array("sku" => $sku));
				if($anchor_product)
				{
					$data = array(
						"product1_id" => $product->id,
						"product2_id" => $anchor_product->id
					);
					
					$this->components_products->insert($data);
					echo $anchor_product->name." комплектующая часть к ".$product->name."\n";
				}
			}
			
			if(!empty($recommended_3))foreach($recommended_3 as $sku)
			{
				$anchor_product = $this->products->get_item_by(array("sku" => $sku));
				if($anchor_product)
				{
					$data = array(
						"product1_id" => $product->id,
						"product2_id" => $anchor_product->id
					);
					
					$this->accessories_products->insert($data);
					echo $anchor_product->name." запчасть к ".$product->name."\n";
				}
			}
		}
	}
				
	public function load1C()
	{
		$this->db->empty_table('filters_cache');
		$this->db->truncate('characteristics');
		$this->db->truncate('characteristic2product');
		
		$xmlstr = file_get_contents('1c_exchange/import0_1.xml');
		$xml = new SimpleXMLElement($xmlstr);
		
		echo '<head><meta charset="UTF-8"></head><body><pre>';
		
		$total = 0;

		$this->db->update('products', array('for_delete' => 1));
		
		foreach($xml->Каталог->Товары->Товар as $el)
		{
			$total++;
			//if ($total > 20) die('done');
			$manufacturer = (string) $el->Изготовитель->Наименование;
			$id = (string) $el->Ид;
			$name = (string) $el->Наименование;
			$description = (string) $el->Описание;
			echo $total.': '.$name."\n";
			$sku = (string) $el->Артикул;
			$cat1 = array(); // Группы товаров 1
			$collections = array(); // Коллекции
			$series = array(); // Серии
			
			$filters = array(); //Характеристики
			
			$images = array();
			
			$data = array(
				'1c_id' => $id,
				'sku' => $sku,
				'for_delete' => 0,
				'description' => $description,
				'sort' => $manufacturer
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
					case 'Полное наименование':
						$data['name'] = (string) $param->Значение;
						break;
					/*case 'Коллекция (серия) 1':
						$collections = explode('(', (string) $param->Значение);
						foreach ($collections as $i => $collection)
						{
							$collections[$i] = str_replace(')', '', $collection);
						}
						$data['sort'] .= $collections[0];
						break;
					case 'Коллекция (серия) 2':
						$collections_2 = explode('(', (string) $param->Значение);
						foreach ($collections_2 as $i => $collection)
						{
							$collections_2[$i] = str_replace(')', '', $collection);
						}
						$data['sort'] .= $collections_2[0];
						break;*/
					case 'Коллекция (серия) 1':
						$exploded = explode('(', (string) $param->Значение);

						foreach ($exploded as $i => $ex)
						{
							if($i == 0) $collections[0] = $ex;
							if($i == 1) $series[0] = str_replace(')', '', $ex);
						}
						if(isset($collections[0])) $data['sort'] .= $collections[0];
						break;
					case 'Коллекция (серия) 2':
						$exploded = explode('(', (string) $param->Значение);
						
						foreach ($exploded as $i => $ex)
						{
							if($i == 0) $collections[1] = $ex;
							if($i == 1) $series[1] = str_replace(')', '', $ex);
						}
						if(isset($collections[1])) $data['sort'] .= $collections[1];
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
					case 'Распродажа':
						$value = (string) $param->Значение;
						if($value == 'true') $data['sale'] = 1;
						break;
					case 'Снято с производства':
						$value = (string) $param->Значение;
						$data['discontinued'] = $value;
						break;
					case 'Цвет':
					    // metadiel: пока не разделяем цвета, т.е. хром/золото - это отдельный цвет
						//$filter = explode('/', (string) $param->Значение);
						$filter = array((string) $param->Значение);
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
						$images[] = '1c_exchange/'. ( (string) $param->Значение);
						break;
				}
			}
			$data['sort'] .= $sku;
			$_product = ($this->products->get_item_by(array('1c_id' => $data['1c_id']))); 
		//	if ($_product->id != 994) continue;
	//			continue;
			 
			echo "start inserting...\n";
			
			$_manufacturer = $this->manufacturers->get_item_by(array('name' => $manufacturer));
			if (!$_manufacturer)
			{
				$this->manufacturers->insert(array('name' => $manufacturer, 'url' => $this->string_edit->slug($manufacturer)));
				$_manufacturer = $this->manufacturers->get_item($this->db->insert_id());
			}
			echo "manufacturer_id=".$_manufacturer->id."\n";
				
			$my_collections = array();
			if ($collections)
			{
				$colection_parent_id = '';
				foreach ($collections as $i => $collection)
				{
					if($i == 0) $_collection = $this->collections->get_item_by(array('name' => trim($collection), 'manufacturer_id' => $_manufacturer->id));
					if($i == 1)	$_collection = $this->collections->get_item_by(array('name' => trim($collection), 'manufacturer_id' => $_manufacturer->id, 'parent_id' => $colection_parent_id));
					if (!$_collection)
					{
						$info = array(
							'name' => trim($collection),
							'url' => $this->string_edit->slug($collection),
							'is_collection' => 1,
							'manufacturer_id' => $_manufacturer->id
						);
						if($i == 1) $info['parent_id'] = $colection_parent_id;
						
						$this->collections->insert($info);
						$_collection = $this->collections->get_item($this->db->insert_id());
					}
					if($i == 0) $colection_parent_id = $_collection->id;
					$my_collections[] = $_collection->id;
				}
			}
			
			$my_series = array();
			if($series)
			{
				$serie_parent_id = array();
				foreach ($series as $i => $serie)
				{
					$ss = explode(';', (string) $serie); // $ss $s тут у меня конилась фантазия)))
					foreach($ss as $j => $s)
					{
						if($i == 0) $_seria = $this->collections->get_item_by(array('name' => trim($s), 'manufacturer_id' => $_manufacturer->id));
						if($i == 1) $_seria = $this->collections->get_item_by(array('name' => trim($s), 'manufacturer_id' => $_manufacturer->id, 'parent_id' => $serie_parent_id[$j]));
						if (!$_seria)
						{
							$info = array(
								'name' => trim($s),
								'url' => $this->string_edit->slug($s),
								'is_collection' => 0,
								'manufacturer_id' => $_manufacturer->id
							);
							if($i == 1) $info['parent_id'] = $serie_parent_id[$j];
						
							$this->collections->insert($info);
							$_seria = $this->collections->get_item($this->db->insert_id());
						}
						if($i == 0) $serie_parent_id[$j] = $_collection->id;
						$my_series[] = $_seria->id;
					}
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
				$data['lastmod'] = date("Y-m-d", filemtime('1c_exchange/import0_1.xml'));
				if (!$_product)
				{
					$this->products->insert($data);
					$product_id = $this->db->insert_id();
				} else {
					$this->products->update($_product->id,$data);
					$product_id = $_product->id;
				}
			
				$this->db->delete('product2collection', array('child_id' => $product_id));
				foreach ($my_collections as $_i => $collection_id)
				{
					$product2collection = array(
						'collection_parent_id' => $collection_id,
						'child_id' => $product_id,
						'is_main' => !$_i
					); 		
					
//					if (!$this->db->get_where('product2collection', $product2collection)->result())				
						$this->db->insert('product2collection', $product2collection);
				}
				
				foreach ($my_series as $_i => $seria_id)
				{
					$product2collection = array(
						'collection_parent_id' => $seria_id,
						'child_id' => $product_id,
						'is_main' => !$_i
					); 		
								
					$this->db->insert('product2collection', $product2collection);
				}
				
				if($filters)
				{
					foreach($filters as $type => $filter)
					{
						$characteristics = array(
							"type" => $type,
							'object_type' => "products"
						);
						if(is_array($filter))
						{
							foreach($filter as $value)
							{
								$characteristics['value'] = $value;

								$param = $this->db->get_where('characteristics', $characteristics)->row();
								
								if(empty($param))
								{
									$this->db->insert('characteristics', $characteristics);
									$characteristic_id = $this->db->insert_id();
								}
								else
								{
									$characteristic_id = $param->id;
								}
									
								$t2t = array(
									'product_id' => $product_id,
									'characteristic_id' => $characteristic_id
								);
															
								$this->db->insert('characteristic2product', $t2t);
							}
						}
						else
						{
							$characteristics['value'] = $filter;
							if($type == 'shortname')
							{
								$shortname = $this->db->get_where('characteristics', $characteristics)->row();
								if(!$shortname)
								{
									$this->db->insert('characteristics', $characteristics);
									$shortname_id = $characteristic_id = $this->db->insert_id();
								}
								else
								{
									$shortname_id = $characteristic_id = $shortname->id;
								}
							}
							elseif($type == 'shortdesc')
							{
								$shortdesc = $this->db->get_where('characteristics', $characteristics)->row();
								
								if(!$shortdesc)
								{
									$characteristics['parent_id'] = $shortname_id;
									$this->db->insert('characteristics', $characteristics);
									$characteristic_id = $this->db->insert_id();
								}
								else
								{
									$characteristic_id = $shortdesc->id;
								}
							}
							else
							{
								$this->db->insert('characteristics', $characteristics);
								$characteristic_id = $this->db->insert_id();
							}
							
							$t2t = array(
								'product_id' => $product_id,
								'characteristic_id' => $characteristic_id
							);
															
							$this->db->insert('characteristic2product', $t2t);
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
		$this->db->delete('products', array('for_delete' => 1));
	}
	
	public function update1CImageCovers()
	{
		$this->db->query('UPDATE images SET is_cover = 0 WHERE object_type="products"');
		$xmlstr = file_get_contents('1c_exchange/import0_1.xml');
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
			$main_image = false;
			foreach ($el->Картинка as $im)
			{
				if (!$main_image)
					$main_image = $im;
			}
			
			$data = array(
				'1c_id' => $id
			);
			
			foreach ($el->ЗначенияРеквизитов->ЗначениеРеквизита as $param)
			{
				switch ((string) $param->Наименование)
				{
					case 'ОписаниеФайла':
						$image = ( (string) $param->Значение);
						if (!$main_image)
							$main_image = $image;
						break;
				}
			}
			$product = ($this->products->get_item_by(array('1c_id' => $data['1c_id'])));
			if (!$product || !$main_image)
				continue;
			$main_image = basename($main_image);
			$main_image = explode('.', $main_image);
			$main_image = trim($main_image[0]);
			$this->db->query('UPDATE images SET is_cover = 1 WHERE object_type="products" AND object_id="'.$product->id.'" AND url LIKE "%'.$main_image.'%"');
			echo('UPDATE images SET is_cover = 1 WHERE object_type="products" AND object_id="'.$product->id.'" AND url LIKE "%'.$main_image.'%"<br>');
				
		}
		die('ok');
	}
	
	public function load1CImages($upload_jpg = false)
	{
		$xmlstr = file_get_contents('1c_exchange/import0_1.xml');
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
			$uniq_images = array();
			$jpgs = array();
			
			foreach ($el->Картинка as $im)
			{
				$images[] = '1c_exchange/'. $im;
			}
			
			$data = array(
				'1c_id' => $id
			);
			
			foreach ($el->ЗначенияРеквизитов->ЗначениеРеквизита as $param)
			{
				switch ((string) $param->Наименование)
				{
					case 'ОписаниеФайла':
						$image = '1c_exchange/'.( (string) $param->Значение);
						$images[] =  $image;
						break;
				}
			}
			$product = ($this->products->get_item_by(array('1c_id' => $data['1c_id'])));
			if (!$product)
				continue;
			//if ($product->id != 2294)
				//continue;
			$product_images = $this->images->get_list(array('object_type'=>'products', 'object_id' => $product->id)); 
			$product_image_names = array();
			foreach ($product_images as $im)
			{
				$fname = explode('.', basename($im->url));
				if (!$product_image_names[$fname[0]])
				{
					$product_image_names[] = $fname[0];
				}
			}
			$image_names =  array();
			$found_names =  array();
			foreach ($images as $im)
			{
				$fname = explode('.', basename($im));
				if (!isset($image_names[$fname[0]]))
				{
					$image_names[$fname[0]] = 1;
					if (!in_array(str_replace('_', '-', $fname[0]), $product_image_names))
					if (!in_array($fname[0], $product_image_names))
						$uniq_images[] = $im;
				}
				$found_names[] = $fname[0];
				$found_names[] = str_replace('_', '-', $fname[0]);
			}
//			print_r($found_names);
			foreach ($product_images as $im)
			{
				$fname = explode('.', basename($im->url));
				//echo $fname[0].'---';
				if (!in_array($fname[0], $found_names))
					$this->images->delete($im->id);
			}
			foreach ($uniq_images as $i => $im)
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
				
				} else
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
				} else
				if (strstr($im, '.gif'))
				{
					$jpg = str_replace('.gif', '.jpg', FCPATH.$im);
					$jpgs[$jpg] = true;
					if (!file_exists($jpg))
					{
						$gif = new Imagick();
						//$gif->setResolution(200,200);
						$gif->readImage(FCPATH.$im);
						$gif->setImageFormat('jpg');
						$gif->setCompressionQuality(97);
						$gif->writeImage($jpg);
					}
				} else
				if (strstr($im, '.jpg') || strstr($im, '.jpeg') )
				{
					$jpg = FCPATH.$im;
					$jpgs[$jpg] = true;
				}
			}
				
				{
					$i = 0;
					foreach ($jpgs as $jpg => $ok)
					{
						echo $jpg.' '.$product->id."\n";
						$filename = explode('/', $jpg);
						$filename = $filename[count($filename)-1];
						if ($upload_jpg)
							$this->images->upload_image(array('name' => $filename, 'tmp_name' => $jpg), array('object_type' => 'products', 'object_id' => $product->id));
						$i++;
					}
					//if ($i)
						//die('ok');
				} 
				
		}
		die('ok');
	}
}
