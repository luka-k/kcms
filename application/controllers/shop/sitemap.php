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
			$map_item->priority = '0.6';
					
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

						if($counter > 0)
						{
							$map_item = new stdClass();
							$map_item->name = $category->name.' - '.$manufacturer->name;
							$map_item->full_url = $category->full_url.'/'.$manufacturer->url;
							$map_item->lastmod = $category->lastmod;
							$map_item->priority = '0.5';
							$categories_sitemap[$m_key] = $map_item;
						}
					}		

					$sub_key = 'c-'.$child->id;
					
					$map_item = new stdClass();
					$map_item->name = $category->name.' - '.$child->name;
					$map_item->full_url = $category->full_url.'/'.$child->url;
					$map_item->lastmod = $child->lastmod;
					$map_item->changefreq = $child->changefreq;
					$map_item->priority = '0.5';
					
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
							$map_item->lastmod = $child->lastmod;
							$map_item->priority = '0.5';
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
			$products[$i]->priority = '0.4';
		}

		$content = array(
			'Категории' => $categories_sitemap,
			'Товары' => $products
		);
		
		
		$data = array(
			'title' => "Карта сайта",
			'meta_description' => '',
			'meta_keywords' => '',
			'select_item' => '',
			'price_from' => $this->products->get_min('price'),
			'price_to' => $this->products->get_max('price'),
			'price_min' => $this->products->get_min('price'),
			'price_max' => $this->products->get_max('price'),
			'width_from' => $this->products->get_min('width'),
			'width_to' => $this->products->get_max('width'),
			'width_min' => $this->products->get_min('width'),
			'width_max' => $this->products->get_max('width'),
			'height_from' => $this->products->get_min('height'),
			'height_to' => $this->products->get_max('height'),
			'height_min' => $this->products->get_min('height'),
			'height_max' => $this->products->get_max('height'),
			'depth_from' => $this->products->get_min('depth'),
			'depth_to' => $this->products->get_max('depth'),
			'depth_min' => $this->products->get_min('depth'),
			'depth_max' => $this->products->get_max('depth'),
			'left_menu' => $this->categories->get_another_tree(),
			'filters_checked' => array(),
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