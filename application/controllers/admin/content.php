<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Content class
*
* @package		kcms
* @subpackage	Controllers
* @category	    content
*/
class Content extends Admin_Controller 
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
				'sku' => $sku
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
					case 'Название':
						$value = (string) $param->Значение;
						if(!empty($value)) $filters['shortname'] = $value;
						/*$filter = explode('/', (string) $param->Значение);
						foreach ($filter as $i => $f)
						{
							if(!empty($f)) $filters['shortname'][$i] = $f;
						}*/
						break;
					case 'Описание':
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
	
	/**
	* Импорт
	* Может стоит вынести импорт в отдельный контроллер?
	*/
	function import()
	{
		$this->load->library('import');
		
		/*$categories = array(
			0 => array("category_name" => "Импортируемая категория 1", "parent_category_name" => "Категория 1", "image" => "/b/r/bring.jpg"),
			1 => array("category_name" => "Импортируемая категория 2", "parent_category_name" => "Импортируемая категория 1"),
			2 => array("category_name" => "Подкатегория 2_1", "parent_category_name" => "Категория 2"),
		);
		
		$this->import->import_categories($categories, true);*/
		
		$products = array(
			0 => array(
				"name" => "Товар 25", 
				"parent_category" => "Категория 3", 
				"price" => "1120", 
				"description" => "Описание", 
				"images" => array(
					0 => "b/r/bring.jpg",
					1 => "d/r/dring.jpg"
				)
			), 
			1 => array(
				"name" => "Товар 26", 
				"parent_category" => "Категория 3", 
				"price" => "520", 
				"description" => "Описание",
				"images" => array(
					0 => "d/r/dring.jpg"
				)
			)
		);
		$this->import->import_products($products, FALSE, TRUE, TRUE);
	}
	
	/**
	* Вывод списка элементов
	*
	* @param string $type - имя базы
	* @param integer $id - id категории
	*/
	public function items($type, $id = FALSE)
	{		
		$name = editors_get_name_field('name', $this->$type->editors);
		
		$left_column = isset($this->$type->admin_left_column) ? $this->$type->admin_left_column : "off";

		$data = array(
			'title' => "Страницы",
			'left_column' => $left_column,
			'type' => $type,
			'name' => $name,
			'url' => $this->uri->uri_string(),
			'tree' => $this->categories->get_tree(0, "category_parent_id")
		);	
		$data = array_merge($this->standart_data, $data);
				
		$order = $this->db->field_exists('sort', $type) ?  "sort" : "name";
		$direction = "acs";
		
		if($this->db->field_exists('parent_id', $type))
		{
			$data['tree'] = $type == "products" ?  $this->categories->get_tree(0, "category_parent_id") : $this->$type->get_tree(0, "parent_id");
		}
		
		if($id == "all")
		{
			$data['content'] = $this->$type->get_list(FALSE, FALSE, FALSE, $order, $direction);
			$data['sortable'] = !($this->db->field_exists('parent_id', $type)) ? TRUE : FALSE;
		}
		else
		{
			if($type == "categories")
			{
				$data['content'] = $this->$type->get_list(FALSE, FALSE, FALSE, $order, $direction);
			}
			else
			{
				$parent = $type == "emails" ? "type" : "parent_id";
				$data["parent_id"] = $id;
				$data['content'] = $this->$type->get_list(array($parent => $id), FALSE, FALSE, $order, $direction);
			}
			$data['sortable'] = TRUE;
		}
		
		if(editors_get_name_field('img', $this->$type->editors))
		{
			foreach($data['content'] as $key => $item)
			{
				$data['content'][$key]->image = $this->images->get_cover(array("object_type" => $type, "object_id" => $item->id));
			}
			$data['images'] = TRUE;
		}
		
		$this->load->view('admin/items.php', $data);
	}
	
	/**
	* Вовод, редактирование, создание элемента.
	*
	* @param string $action - действие(редактировани, сохранение, копирование)
	* @param string $type - имя базы
	* @param integer $id - id элемента
	* @param boolen $exit - выход из редактирования
	*/
	public function item($action, $type, $id = FALSE, $exit = FALSE)
	{
		$left_column =  isset($this->$type->admin_left_column) ? $this->$type->admin_left_column : "off";
		$name = editors_get_name_field('name', $this->$type->editors);
		$parent_id = $this->input->get('parent_id');
		
		$data = array(
			'title' => "Редактировать",
			'left_column' => $left_column,
			'editors' => $this->$type->editors,
			'type' => $type,
			'parent_id' => $parent_id,
			'url' => "/".$this->uri->uri_string(),
			'tree' => $this->categories->get_tree(0, "category_parent_id")
		);
	
		$data['selects']['parent_id'] = $this->categories->get_tree(0, "category_parent_id");
		$data['selects']['manufacturer_id'] = $this->manufacturer->get_list(FALSE);
		$data['selects']['collection_parent_id'] = $this->collections->get_tree(0, "parent_id");
		if($type == "products") $data['selects']['manufacturer_id'] = $this->manufacturer->get_list(FALSE);

		$data = array_merge($this->standart_data, $data);
		
		if($this->db->field_exists('parent_id', $type))
		{
			$tree =  $type == "products" ? $this->categories->get_tree(0, "category_parent_id") : set_disabled_option($this->$type->get_tree(0, "parent_id"), $id);
			$data['tree'] = $tree;
			$data['selects']['parent_id'] = $tree;
		}
		
		if($type == "characteristics_type") 
		{
			$this->config->load('characteristics');
			$data['selects']['view_type'] = $this->config->item('view_type');
		}
		
		if($type == "emails") $data['selects']['users_type'] = $this->users_groups->get_list(FALSE);
		
		$is_characteristics = editors_get_name_field('ch', $data['editors']);
		if(!empty($is_characteristics)) $data['ch_select'] = $this->characteristics_type->get_list(FALSE);
		
		if($action == "edit")
		{
			if($id == FALSE)
			{	
				$data['content'] = set_empty_fields($data['editors']);
				
				if($type == "categories" || $type == "products") $data['content']->parent_id[] = 0;
				
				if($this->db->field_exists('parent_id', $type))	$data['content']->parent_id = $parent_id;
				if(!empty($is_characteristics)) $data['content']->characteristics = array();
				if($type == "products") $data['content']->collections_id = array();
				if($type == "emails") $data['content']->type = 2;				
			}	
			else
			{			
				$data['content'] = $this->$type->get_item($id);
				
				if($type == "categories") $data['content']->parent_id = $this->categories->get_parent_ids("category2category", "category_parent_id", $id);
				if($type == "products") $data['content']->collections_id = $this->products->get_parent_ids("product2collection", "collection_parent_id", $id);
				
				// Галлерея
				$is_image = editors_get_name_field('img', $data['editors']);
				if($is_image) $data['content']->images = $this->images->prepare_list($this->images->get_list(array("object_type" => $type,"object_id" => $data['content']->id)));
				
				// Двойная галлерея
				$is_double_image = editors_get_name_field('double_img', $data['editors']);
				if($is_double_image)
				{
					$field = get_editors_field($data['editors'], $is_double_image);
					if($field) foreach($field[4] as $image_type)
					{
						$data['content']->images[$image_type] = $this->images->prepare_list($this->images->get_list(array("object_type" => $type, "object_id" => $data['content']->id, "image_type" => $image_type)));
					}
				}
				
				// Характеристики
				if(!empty($is_characteristics))
				{
					$data['content']->characteristics = $this->characteristics->get_list(array("object_id" => $id, "object_type" => $type));
					foreach($data['content']->characteristics as $characteristic)
					{
						foreach($data['ch_select'] as $ch)
						{
							if($characteristic->type == $ch->url) $characteristic->name = $ch->name;
						}
					}
				}
				
				// Аналогичные
				$is_recommend = editors_get_name_field('recommended', $data['editors']);
				if($is_recommend) $data['content']->recommended = $this->products->get_anchor($id, "recommended");
				
				// Комплектующие
				$is_components = editors_get_name_field('components', $data['editors']);
				if($is_components) $data['content']->components = $this->products->get_anchor($id, "components");
				
				// Запчасти
				$is_accessories = editors_get_name_field('accessories', $data['editors']);
				if($is_accessories) $data['content']->accessories = $this->products->get_anchor($id, "accessories");
			}
			$this->load->view('admin/item.php', $data);
		}
		elseif($action == "save")
		{
			$data['content'] = $this->$type->editors_post();
			
			//fixing - привязка
			$fixing_name = editors_get_name_field('fixing', $data['editors']);
			$fixing_base = $type == "category" ? "category2category" : "product2category";
			
			//Если в базе присутствует колонка lastmod заполняем дату последней модификации
			if($this->db->field_exists('lastmod', $type)) $data['content']->lastmod = date("Y-m-d");
					
			if($data['content']->id == FALSE)
			{
				//Если id пустая создаем новую страницу в базе
				$this->$type->insert($data['content']);
				$data['content']->id = $this->db->insert_id();				
			}
			else
			{
				//Если id не пустая вносим изменения.
				$this->$type->update($data['content']->id, $data['content']);
				
				if($fixing_name)
				{
					$this->db->where('child_id', $data['content']->id);
					$this->db->delete($fixing_base);
				}
				
				if($type == "products")
				{
					$this->db->where('child_id', $data['content']->id);
					$this->db->delete("product2collection");
				}
			}
			
			if($fixing_name) $this->$type->insert_fixing_info($fixing_base, $fixing_name, $data['content']->id);
			if($type == "products") $this->$type->insert_fixing_info("product2collection", "collection_parent_id", $data['content']->id);
			
			$field_name = editors_get_name_field('img', $data['editors']);
			//Получаем id эдитора который предназначен для загрузки изображения

			/*****************************************
			/ Требует более серьезного рефакторинга
			/****************************************/
			if(!empty($field_name))
			{
				$object_info = array(
					"object_type" => $type,
					"object_id" => $data['content']->id
				);
					
				if (isset($_FILES[$field_name]))
				{
					if(is_array($_FILES[$field_name]['name']))
					{
						foreach($_FILES[$field_name]['error'] as $key => $error)
						{
							if($error == UPLOAD_ERR_OK)
							{
								$file = array(
									"name" => $_FILES[$field_name]['name'][$key],
									"type" => $_FILES[$field_name]['type'][$key],
									"tmp_name" => $_FILES[$field_name]['tmp_name'][$key]
								);

								$this->images->upload_image($file, $object_info);
							}
						}
					}
					else
					{
						if($_FILES[$field_name]['error'] == UPLOAD_ERR_OK) $this->images->upload_image($_FILES[$field_name], $object_info);
					}
				}
			}
				
			$field_name = editors_get_name_field('double_img', $data['editors']);
			
			if(!empty($field_name))
			{
				$object_info = array(
					"object_type" => $type,
					"object_id" => $data['content']->id
				);
				
				if (isset($_FILES[$field_name]))
				{
					foreach($_FILES[$field_name]['error'] as $key => $error)
					{
						if($error == UPLOAD_ERR_OK)
						{
							$file = array(
								"name" => $_FILES[$field_name]['name'][$key],
								"type" => $_FILES[$field_name]['type'][$key],
								"tmp_name" => $_FILES[$field_name]['tmp_name'][$key]
							);
						
							$object_info['image_type'] = $key;
							$this->images->upload_image($file, $object_info);
						}
					}
				}	
			}
			/*****************************************************
			/ Конец куска требующего рефакторинга
			/****************************************************/
				
			$p_id = isset($data['content']->parent_id) ?  $data['content']->parent_id : "all";
			if($type == "emails") $p_id = $data['content']->type;
				
			$exit == false ? redirect(base_url().'admin/content/item/edit/'.$type."/".$data['content']->id) : redirect(base_url().'admin/content/items/'.$type."/".$p_id);	

		}
		if($action == "copy")
		{
			$data['content'] = $this->$type->get_item($id);
			
			if(!empty($is_characteristics)) $characteristics = $this->characteristics->get_list(array("object_id" => $data['content']->id));
			
			$data['content']->id = NULL;
			$data['content']->url = "";
			
			$this->$type->insert($data['content']);
			$new_id = $this->db->insert_id();
			
			if(isset($characteristics) && is_array($characteristics)) foreach($characteristics as $ch)
			{
				$ch->id = NULL;
				$ch->object_id = $new_id;
				$this->characteristics->insert($ch);
			}			
			redirect(base_url().'admin/content/item/edit/'.$type."/".$new_id);
		}
	}
		
	/**
	* Удаление элемента
	*
	* @param string $type
	* @param integer $id
	*/
	public function delete_item($type, $id)
	{
		// Удаляем картинки связанные с элементом
		$is_images = editors_get_name_field('img', $this->$type->editors);
		$is_dbl_img = editors_get_name_field('double_img', $this->$type->editors);
		if($is_images || $is_dbl_img)
		{
			$item_images = $this->images->get_list(array("object_type" => $type, "object_id" => $id));
			if($item_images) foreach($item_images as $image)
			{
				$this->images->delete_img(array("object_type" => $type, "id" => $image->id));
			}
		}
		
		// Удаляем характеристики связанные с товаром.
		$is_characteristics = editors_get_name_field('ch', $this->$type->editors);
		if($is_characteristics)
		{
			$item_characteristics = $this->characteristics->get_list(array("object_type" => $type, "object_id" => $id));
			if($item_characteristics) foreach($item_characteristics as $ch)
			{
				$this->characteristics->delete($ch->id);
			}
		}
		
		// Удаляем рекомендованные элементы
		$is_recommended = editors_get_name_field('recommend', $this->$type->editors);
		if($is_recommended)	$this->products->delete_recommended($id);
	
		$item = $this->$type->get_item($id);
		$this->$type->delete($id);
		redirect(base_url().'admin/content/items/'.$type."/".$item->parent_id);
	}
	
	/**
	* Удаление изображения
	* 
	* @param string $type - тип изображения(категория)
	* @param integer $id - id изображения
	* @param integer $tab - номер вкладки с изображениями.
	*/
	public function delete_image($type, $id, $tab)
	{
		$item_id = $this->images->delete_img(array("object_type" => $type, "id" => $id));
		
		redirect(base_url().'admin/content/item/edit/'.$type."/".$item_id."#tab_".$tab);
	}
	
	/**
	* Переименования изображения
	*/
	public function rename_image()
	{
		$info = json_decode(file_get_contents('php://input', true));
		
		$this->images->update($info->id, array("name" => $info->name));
	}
	
	/**
	* Установка обложки альбома
	*/
	public function set_cover($object_type, $object_id, $id, $tab)
	{
		$this->images->set_cover(array("object_type" => $object_type, "object_id" => $object_id), $id);
		
		redirect(base_url().'admin/content/item/edit/'.$object_type."/".$object_id."#tab_".$tab);
	}
	
	/**
	* Добавление характеристики товару
	*/
	public function edit_characteristic()
	{
		$info = json_decode(file_get_contents('php://input', true));
		if(!isset($info->id))
		{
			$this->characteristics->insert($info);
			$info->id = $this->db->insert_id();
			
			$ch_select = $this->characteristics_type->get_list(FALSE);
			
			foreach($ch_select as $item)
			{
				if($info->type == $item->url) $info->name = $item->name;
			}
			
			$answer = array(
				'base_url' => base_url(),
				'info' => $info
			);
		}
		else
		{
			$this->characteristics->update($info->id, $info);
			$answer['message'] = 'ok';
		}
			
		echo json_encode($answer);
	}
	
	/**
	* Удаление характеристики товара
	*/
	public function delete_characteristic($id, $tab)
	{
		$ch = $this->characteristics->get_item_by(array("id" => $id));
		if($this->characteristics->delete($id)) redirect(base_url().'admin/content/item/edit/'.$ch->object_type."/".$ch->object_id."#tab_".$tab);
	}
	
	/**
	* Редактирование на странице списка товаров - спецпредложения и новинка
	*/
	public function advanced()
	{
		$info = json_decode(file_get_contents('php://input', true));
		
		
		if($info->type == "new")
		{
			$this->products->update($info->id, array("is_new" => $info->value));
		}
		elseif($info->type == "special")
		{
			$this->products->update($info->id, array("is_special" => $info->value));
		}
	}
}