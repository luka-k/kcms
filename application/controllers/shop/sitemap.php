<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Sitemap class
*
* @package		kcms
* @subpackage	Controllers
* @category	    Sitemap
*/
class Sitemap extends Client_Controller 
{	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index($map_type = "html")
	{
		/*$types = $this->config->item('sitemap_types');
		$content = array();
		foreach($types as $type)
		{
			$content = array_merge($content, $this->$type->prepare_list($this->$type->get_list(FALSE)));
		}
		
		foreach ($this->manufacturers->get_list(FALSE) as $manufacturer)
		{
			$manufacturer->full_url = 'http://brightbuild.ru/manufacturer/'.strtolower($manufacturer->url);
			$content[] = $manufacturer;
		}*/
		
		$manufacturers = $this->manufacturers->get_list(FALSE);
		$categories = $this->categories->prepare_list($this->categories->get_admin_tree(0));

		$categories_sitemap = array();
		
		foreach($categories as $category)
		{
			$key = 'c-'.$category->id;
			
			$map_item = new stdClass();
			$map_item->name = $category->name;
			$map_item->full_url = $category->full_url;
			$map_item->lastmod = $category->lastmod;
			$map_item->changefreq = $category->changefreq;
			$map_item->priority = $category->priority;
					
			$categories_sitemap[$key] = $map_item;
						
			if(!empty($category->childs))
			{
				$childs = array();
				foreach($category->childs as $child)
				{
					$categories_checked = $this->catalog->get_products_ids($category->childs);
					
					foreach($manufacturers as $manufacturer)
					{
						$m_key = 'm-'.$category->id.'-'.$manufacturer->id;
				
						$this->db->where_in('parent_id', $categories_checked);
						$this->db->where('manufacturer_id', $manufacturer->id);
						$counter = $this->db->count_all_results('products');
						//$products = $this->characteristics->get_products_by_filter(array('categories_checked' => $categories_checked), 'sort', 'asc');
				
						if($counter > 0)
						{
							$map_item = new stdClass();
							$map_item->name = $category->name.' - '.$manufacturer->name;
							$map_item->full_url = $category->full_url.'/'.$manufacturer->url;
							$categories_sitemap[$m_key] = $map_item;
						}
					}		

					$sub_key = 'c-'.$child->id;
					
					$map_item = new stdClass();
					$map_item->name = $category->name.' - '.$child->name;
					$map_item->full_url = $category->full_url.'/'.$child->url;
					$map_item->lastmod = $child->lastmod;
					$map_item->changefreq = $child->changefreq;
					$map_item->priority = $child->priority;
					
					$childs[$sub_key] = $map_item;
					
					foreach($manufacturers as $manufacturer)
					{
						$sub_key = 'm-'.$child->id.'-'.$manufacturer->id;
						$products = $this->products->get_list(array('parent_id' => $child->id, 'manufacturer_id' => $manufacturer->id));
						if($products)
						{
							$map_item = new stdClass();
							$map_item->name = $category->name.' - '.$child->name.' - '.$manufacturer->name;
							$map_item->full_url = $category->full_url.'/'.$child->url.'/'.$manufacturer->url;
							$childs[$sub_key] = $map_item;
						}
					}
				}
				$categories_sitemap[$key]->childs = $childs;
			}
		}
		
		$products = $this->products->get_list(FALSE);
		foreach($products as $i => $p)
		{
			$products[$i]->full_url = $this->products->get_url($p);
		}

		$content = array(
			'Категории' => $categories_sitemap,
			'Производители' => $this->manufacturers->prepare_list($this->manufacturers->get_list(FALSE)),
			'Товары' => $products
		);
		
		
		$data = array(
			'title' => "Карта сайта",
			'meta_description' => '',
			'meta_keywords' => '',
			'select_item' => '',
			'left_menu' => $this->categories->get_another_tree(),
			'left_active_item' => '',
			'submenu_active_item' => '',
			'open_tag' => '<?xml version="1.0" encoding="UTF-8"?>',
			'content' => $content,
			'no_ajax' => TRUE
		);
		$data = array_merge($this->standart_data, $data);
		
		$template = "client/shop/sitemap_".$map_type.".php";
		$this->load->view($template, $data);
	}
	
}