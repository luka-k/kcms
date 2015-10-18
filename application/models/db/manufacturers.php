<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manufacturers extends MY_Model
{
	public $editors = array(
		'Основное' => array(
			'id' => array('id', 'hidden'),
			'name' => array('Заголовок', 'text', "name", 'require'),
			'is_active' => array('Активна', 'checkbox'),
			'is_ranging' => array('Товары из топ', 'checkbox'),
			'phone' => array('Телефон', 'text'),
			'email' => array('email', 'text'),
			'country' => array('Страна', 'text'),
			'city' => array('city', 'text'),
			'link' => array('Ссылка на сайт', 'text'),
			'description' => array('Описание', 'tiny'),
			'manufacturer2category' => array('Категория', 'manufacturer2category'),
			'manufacturer2categorygoods' => array('Категория товаров', 'manufacturer2category'),
			'manufacturer2manufacturer' => array('Продавцы', 'manufacturer2manufacturer'),
			'manufacturer2service' => array('Услуги', 'manufacturer2service')
		),	
		'SEO' => array(
			'meta_title' => array('Meta title страницы', 'text', 'trim|htmlspecialchars'),
			'meta_keywords' => array('Ключевые слова страницы', 'text', 'trim|htmlspecialchars'),
			'meta_description' => array('Описание страницы', 'text', 'trim|htmlspecialchars'),
			'url' => array('Url', 'text', 'substituted[name]'),
			'seo_text' => array('seo_text', 'tiny'),
			'lastmod' => array('lastmod', 'hidden')	
		),		
		'Изображения' => array(
			'upload_image' => array('Загрузить изображение', 'image', 'img')
		),
		'Складские остатки' => array(
			'upload_file' =>  array('Складские остатки', 'upload_file', 'upload_file'),
		),
		'Документы' => array(
			'documents' =>  array('Документы', 'documents'),
		),
	);
	
	public $thumbs = array('manufacturer');
	
	function __construct()
	{
        parent::__construct();
		$this->load->database();
	}
	
	public function get_tree($products = FALSE, $selected = array())
	{
		if(!$products) $products = $this->products->get_list(FALSE);

		if(isset($selected['sku_checked']))
		{
			$this->db->where_in('sku', $selected['sku_checked']);
			$result = $this->db->get('products')->result();
			$products = array_merge($result, $products);
		}
		
		$manufacturer = array();
		$manufacturer_tree = array();
		$m_ids = array();
		$sku = array();
		
		foreach($products as $p)
		{
			if(!array_key_exists($p->manufacturer_id, $manufacturer_tree))
			{
				$manufacturer_tree[$p->manufacturer_id] = $this->get_item($p->manufacturer_id);
			}
			$manufacturer_tree[$p->manufacturer_id]->sku[] = $p;
		}
		
		$volume_1 = array();
		foreach($manufacturer_tree as $i => $manufacturer)
		{
			$volume_1[$i] = $manufacturer->name;
			$volume_2 = array();
			foreach ($manufacturer->sku as $key => $p) 
			{
				$volume_2[$key] = $p->sku;
			}
			array_multisort($volume_2, SORT_ASC, $manufacturer->sku);
		}
		
		array_multisort($volume_1, SORT_ASC, $manufacturer_tree);
		
		return $manufacturer_tree;
	}
	
	public function get_by_category($category)
	{
		$parent_id = $this->table2table->get_parent_ids("category2category", "category_parent_id", "child_id", $category->id);
		
		$manufacturers_ids = array();
		if($parent_id[0] == 0)
		{
			$child_ids = $this->table2table->get_parent_ids("category2category", "child_id", "category_parent_id", $category->id);
			if($child_ids) foreach($child_ids as $id)
			{
				$category_manufacturers = $this->table2table->get_parent_ids("manufacturer2category", "manufacturer_id", "category_id", $id);
				$manufacturers_ids = array_merge($manufacturers_ids, $category_manufacturers);
			}
		}
		else
		{
			$manufacturers_ids = $this->table2table->get_parent_ids("manufacturer2category", "manufacturer_id", "category_id", $category->id);
		}
		
		$manufacturers = array();
		
		$manufacturers_ids = array_unique($manufacturers_ids);
		if($manufacturers_ids) 
		{
			$this->db->where_in("id", $manufacturers_ids);
			$manufacturers = $this->db->get("manufacturers")->result();
		}
		
		foreach($manufacturers as $i => $m)
		{
			$manufacturers[$i]->categories = $this->_get_subcategories($m->id);
		}
		
		$names = array();
		foreach ($manufacturers as $key => $m)
		{
			$names[] = $m->name;
		}
		$names= array_map('strtolower', $names);
		
		array_multisort($names, $manufacturers);
		
		return $manufacturers;
	}
	
	public function get_have_inventory()
	{
		$manufacturers = array();
		
		$files = $this->files->get_list(array("object_type" => "manufacturers"));
		if($files)foreach($files as $file)
		{
			$manufacturers[] =  $this->manufacturers->get_item($file->object_id);
		}
		
		return $manufacturers;
	}
	
	private function _get_subcategories($manufacturer_id, $type = 'catalog')
	{
		$categories = array();
		
		if($type == 'vendor')
		{
			$table = 'manufacturer2categorygoods';
			$field = 'goods_category_id';
		}
		else
		{
			$table = 'manufacturer2category';
			$field = 'category_id';
		}
		
		$categories_ids = $this->table2table->get_parent_ids($table, $field, "manufacturer_id", $manufacturer_id);
		
		if(!empty($categories_ids))
		{
			$parent_categories_ids = $this->table2table->get_parent_ids("category2category", "child_id", "category_parent_id", 0);
		
			$categories_ids = array_diff ($categories_ids, $parent_categories_ids);
	
			$this->db->where_in("id", $categories_ids);
			$categories = $this->db->get("categories")->result();
		}
		
		if($categories) foreach($categories as $i => $c)
		{
			$parent_id = $this->db->get_where("category2category", array("child_id" => $c->id))->row()->category_parent_id;
			if($parent_id) $categories[$i]->parent_category = $this->categories->get_item($parent_id);
		}
		
		$volume = array();
		foreach ($categories as $key => $row) 
		{
			$volume[$key]  = $row->name;
		}
		array_multisort($volume, SORT_ASC, $categories);
		
		return $categories;
	}
	
	public function _get_services($manufacturer_id)
	{
		$services = array();
		
		$services_ids = $this->table2table->get_parent_ids("manufacturer2service", "service_id", "manufacturer_id", $manufacturer_id);

		if(!empty($services_ids))
		{
			$this->db->where_in("id", $services_ids);
			$services = $this->db->get("services")->result();
		}
		
		if($services) foreach($services as $i => $c)
		{
			if($c->parent_id == 0) unset($services[$i]);
		}
		
		$names = array();
		foreach ($services as $key => $s)
		{
			$names[] = $s->name;
		}
		$names= array_map('strtolower', $names);
		
		array_multisort($names, $services);
		
		return $services;
	}
	
	private function _get_categories_tree($manufacturer_id, $type = 'catalog')
	{
		$categories_tree = array();
		
		if($type == 'vendor')
		{
			$table = 'manufacturer2categorygoods';
			$field = 'goods_category_id';
		}
		else
		{
			$table = 'manufacturer2category';
			$field = 'category_id';
		}
		
		$categories_ids = $this->table2table->get_parent_ids($table, $field, "manufacturer_id", $manufacturer_id);

		if(!empty($categories_ids))
		{
			//$this->db->where_in("child_id", $categories_ids);
			$result = $this->db->get_where("category2category", array("category_parent_id" => 0))->result();
			
			if($result)foreach($result as $i => $r)
			{				
				$categories_tree[$i] = $this->categories->get_item($r->child_id);
				
				$categories_tree[$i]->childs = array();
				
				$this->db->where_in("child_id", $categories_ids);
				$sub_result = $this->db->get_where("category2category", array("category_parent_id" => $r->child_id))->result();
				
				if($sub_result)foreach($sub_result as $j => $s_r)
				{
					$categories_tree[$i]->childs[$j] = $this->categories->get_item($s_r->child_id);
					$categories_tree[$i]->childs[$j]->parent_category_url = $categories_tree[$i]->url;
				}
			}
		}
		
		$categories_tree = $this->categories->prepare_list($categories_tree);

		$volume = array();
		foreach($categories_tree as $i => $branch)
		{
			if(empty($branch->childs)) 
			{
				unset($categories_tree[$i]);
			}
			else
			{
				$volume[$i]  = $branch->name;
			}
		}

		array_multisort($volume, SORT_ASC, $categories_tree);

		return $categories_tree;
	}
	
	public function _get_services_tree($manufacturer_id)
	{
		$services_tree = array();
		
		$services_ids = $this->table2table->get_parent_ids('manufacturer2service', 'service_id', 'manufacturer_id', $manufacturer_id);

		$parent_services = $this->services->get_list(array('parent_id' => 0));
		if($parent_services) foreach($parent_services as $i => $p_s)
		{
			$services_tree[$i] = $p_s;
			if(!empty($services_ids))$this->db->where_in('id', $services_ids);
			$services_tree[$i]->childs = $this->services->get_list(array('parent_id' => $p_s->id));
		}
		
		foreach($services_tree as $i => $branch)
		{
			if(empty($branch->childs)) 
			{
				unset($services_tree[$i]);
			}
			else
			{
				$volume = array();
				foreach ($services_tree[$i]->childs as $key => $row) 
				{
					$volume[$key]  = $row->name;
				}
				array_multisort($volume, SORT_ASC, $services_tree[$i]->childs);
			}
		}
		
		$services_tree = $this->services->prepare_list($services_tree);
		
		$names = array();
		foreach ($services_tree as $key => $s_t)
		{
			$names[] = $s_t->name;
		}
		$names= array_map('strtolower', $names);
		
		array_multisort($names, $services_tree);
		
		return $services_tree;
	}
	
	public function get_vendors($category_id = FALSE)
	{
		$vendors = array();
				
		if($category_id)
		{
			$parent_id = $this->table2table->get_parent_ids("category2category", "category_parent_id", "child_id", $category_id);
			if($parent_id[0] == 0)
			{
				$child_ids = $this->table2table->get_parent_ids("category2category", "child_id", "category_parent_id", $category_id);

				if(!empty($child_ids)) $this->db->where_in("goods_category_id", $child_ids);
			}
			else
			{
				$this->db->where("goods_category_id", $category_id);
			}
		}
		$this->db->distinct();
		$this->db->select("manufacturer_id");
		
		$result = $this->db->get("manufacturer2categorygoods")->result();
		if($result) foreach($result as $i => $item)
		{
			$vendors[$i] = $this->get_item($item->manufacturer_id);
			$vendors[$i]->categories = $this->_get_categories_tree($item->manufacturer_id, 'vendor');
		}
		
		sort($vendors);
		
		return $vendors;
	}
	
	public function get_manufacturers($category_id = FALSE)
	{
		$manufacturers = array();
				
		if($category_id)
		{
			$parent_id = $this->table2table->get_parent_ids("category2category", "category_parent_id", "child_id", $category_id);
			if($parent_id[0] == 0)
			{
				$child_ids = $this->table2table->get_parent_ids("category2category", "child_id", "category_parent_id", $category_id);

				if(!empty($child_ids)) $this->db->where_in("category_id", $child_ids);
			}
			else
			{
				$this->db->where("category_id", $category_id);
			}
		}
		$this->db->distinct();
		$this->db->select("manufacturer_id");
		
		$result = $this->db->get("manufacturer2category")->result();
		if($result) foreach($result as $i => $item)
		{
			$manufacturers[$i] = $this->get_item($item->manufacturer_id);
			$manufacturers[$i]->categories = $this->_get_categories_tree($item->manufacturer_id, 'vendor');
		}
		
		foreach ($manufacturers as $key => $m)
		{
			$names[] = $m->name;
		}
		$names= array_map('strtolower', $names);
		
		array_multisort($names, $manufacturers);
		return $manufacturers;
	}
	
	public function get_manufacturers_with_news()
	{
		$manufacturers = $this->manufacturers->get_list(FALSE, 0, 0, 'name', 'asc');
		
		foreach ($manufacturers as $i => $m)
		{
			$news = $this->articles->get_item_by(array('manufacturer_id' => $m->id));
			if (!$news)
				unset($manufacturers[$i]);
		}
		
		return $manufacturers;
	}
	
	public function get_contractors($service = FALSE)
	{
		$contractors = array();
		
		if($service)
		{
			if($service->parent_id == 0)
			{
				$sub_services = $this->services->get_list(array("parent_id" => $service->id));
				if($sub_services)
				{
					$services_ids = array();
					
					foreach($sub_services as $ss)
					{
						 $services_ids[] = $ss->id;
					}
					if($services_ids) $this->db->where_in("service_id", $services_ids);
				}
			}
			else
			{
				$this->db->where("service_id", $service->id);
			}
		}
		$this->db->distinct();
		$this->db->select("manufacturer_id");
		
		$result = $this->db->get("manufacturer2service")->result();
		if($result) foreach($result as $i => $item)
		{
			$contractors[$i] = $this->get_item($item->manufacturer_id);
			if(!empty($contractors[$i])) 
			{
				$contractors[$i]->services = $this->_get_services($item->manufacturer_id);
			}
			else
			{
				unset($contractors[$i]);
			}
		}
		
		sort($contractors);
		
		return $contractors;
	}
	
	public function prepare($item)
	{
		if(!empty($item))
		{
			$item->img = $this->images->get_cover(array('object_type' => 'manufacturers', 'object_id' => $item->id));
			
			$item->full_url = 'http://brightbuild.ru/manufacturer/'.strtolower($item->url);
			
			return $item;
		}
	}
	
	public function prepare_for_catalog($item)
	{
		$item = $this->prepare($item);
		
		$item->categories = $this->_get_categories_tree($item->id);
		$item->subcategories = $this->_get_subcategories($item->id);
		$distributors_ids = $this->table2table->get_parent_ids("manufacturer2manufacturer", "distributor", "distributor_2", $item->id);
		
		$item->distributors = array();
		if($distributors_ids )
		{
			$this->db->where_in("id", $distributors_ids);
			$item->distributors = $this->prepare_list($this->db->get("manufacturers")->result());
		}
		
		if ($this->uri->segment(1) != 'manufacturer' || ($this->uri->segment(3) != ''))
			$item->description = '';
	
		return $item;
	}
	
	public function prepare_for_vendor($item)
	{
		$item = $this->prepare($item);
		$item->categories = $this->_get_categories_tree($item->id, 'vendor');
		$item->subcategories = $this->_get_subcategories($item->id);
		
		$distributed_ids = $this->table2table->get_child_ids("manufacturer2manufacturer", "distributor", "distributor_2", $item->id);
		
		if($distributed_ids) 
		{
			$this->db->where_in("id", $distributed_ids);
			$item->distributed = $this->prepare_list($this->db->get("manufacturers")->result());
		}
		
		return $item;
	}
	
	public function prepare_for_contractor($item)
	{
		$item = $this->prepare($item);
		$item->services = $this->_get_services_tree($item->id);

		return $item;
	}
}