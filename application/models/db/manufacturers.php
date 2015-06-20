<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manufacturers extends MY_Model
{
	public $editors = array(
		'Основное' => array(
			'id' => array('id', 'hidden'),
			'name' => array('Заголовок', 'text', "name"),
			'is_active' => array('Активна', 'checkbox'),
			'phone' => array('Телефон', 'text'),
			'email' => array('email', 'text'),
			'country' => array('Страна', 'text'),
			'city' => array('city', 'text'),
			'link' => array('Ссылка на сайт', 'text'),
			'manufacturer2category' => array('Категория', 'manufacturer2category'),
			'manufacturer2categorygoods' => array('Категория товаров', 'manufacturer2category'),
			'manufacturer2manufacturer' => array('Продавцы', 'manufacturer2manufacturer'),
			'manufacturer2service' => array('Услуги', 'manufacturer2service')
		),	
		'SEO' => array(
			'meta_title' => array('Meta title страницы', 'text', 'trim|htmlspecialchars'),
			'meta_keywords' => array('Ключевые слова страницы', 'text', 'trim|htmlspecialchars'),
			'meta_description' => array('Описание страницы', 'text', 'trim|htmlspecialchars'),
			'url' => array('Url', 'text'),
			'seo_text' => array('seo_text', 'tiny'),
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
	
	function __construct()
	{
        parent::__construct();
		$this->load->database();
	}
	
	public function get_tree($products = FALSE, $selected = array())
	{
		if(!$products) $products = $this->products->get_list(FALSE);
		
		$manufacturer = array();
		$m_ids = array();
		$sku = array();
		
		if($products)
		{
			foreach($products as $p)
			{
				$m_ids[] = $p->manufacturer_id;
				$sku[$p->manufacturer_id][] = $p->sku;
			}
		
			if(isset($selected['manufacturer_checked'])) array_merge($m_ids, $selected['manufacturer_checked']);
		
			foreach($sku as $i => $articls)
			{
				asort($articls, SORT_STRING);
				$sku[$i] = $articls;
			}
		
		
			$this->db->order_by("name", "asc"); 
			if(!empty($m_ids)) $this->db->where_in("id", array_unique($m_ids));
			$manufacturer = $this->db->get($this->_table)->result();
		
			if(isset($selected["sku_checked"])) foreach($selected["sku_checked"] as $sk)
			{	
				$product = $this->products->get_item_by(array("sku" => $sk));	
				$sku[$product->manufacturer_id][] = $sk; 
			}
		
			foreach($manufacturer as $i => $m)
			{
				$manufacturer[$i]->sku = $sku[$m->id];
			}
		}
		return $manufacturer;
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
		$this->db->where_in("id", $manufacturers_ids);
		$manufacturers = $this->db->get("manufacturers")->result();
		
		foreach($manufacturers as $i => $m)
		{
			$manufacturers[$i]->categories = $this->_get_subcategories($m->id);
		}
		
		return $manufacturers;
	}
	
	private function _get_subcategories($manufacturer_id)
	{
		$categories = array();
		
		$categories_ids = $this->table2table->get_parent_ids("manufacturer2category", "category_id", "manufacturer_id", $manufacturer_id);
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
		
		return $categories;
	}
	
	private function _get_categories_tree($manufacturer_id)
	{
		$categories_tree = array();
		
		$categories_ids = $this->table2table->get_parent_ids("manufacturer2category", "category_id", "manufacturer_id", $manufacturer_id);

		if(!empty($categories_ids))
		{
			$this->db->where_in("child_id", $categories_ids);
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
		
		return $categories_tree;
	}
	
	public function prepare($item)
	{
		if(!empty($item))
		{
			$item->img = $this->images->get_cover(array('object_type' => 'manufacturers', 'object_id' => $item->id));
			return $item;
		}
	}
	
	public function prepare_for_catalog($item)
	{
		$item = $this->prepare($item);
		
		$item->categories = $this->_get_categories_tree($item->id);
		$item->subcategories = $this->_get_subcategories($item->id);
		$distributors_ids = $this->table2table->get_parent_ids("category2category", "child_id", "category_parent_id", 0);
		
		$this->db->where_in("id", $distributors_ids);
		$item->distributors = $this->prepare_list($this->db->get("manufacturers")->result());
	
		return $item;
	}
}