<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Cache class
*
* @package		kcms
* @subpackage	Controllers
* @category	    import
*/
class Cache extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function refresh()
	{
		$counter = 1;
		// Добавление в кеш страниц категорий
		echo '<h4>Категории</h4></br>';
		
		$left_menu = $this->categories->get_tree();
		$categories = $this->categories->get_list(FALSE);
			
		foreach($categories as $category)
		{
			$filters_checked = array(
				'filter' => TRUE, 
				'last_type_filter' => 'categories_checked', 
				'from' => 0,
			);
			
			$products = array();
			$semantic_urls = array();
			$data = array();
			
			$category_anchors = $this->db->get_where('category2category', array('child_id' => $category->id))->result();

			if(count($category_anchors) == 1 && $category_anchors[0]->category_parent_id == 0)
			{
				$filters_checked['parent_checked'][] = $category->id;
				$sub_categories = $this->db->get_where('category2category', array('category_parent_id' => $category->id))->result();
				if($sub_categories) foreach($sub_categories as $sub_category)
				{
					$filters_checked['categories_checked'][] = $sub_category->child_id;
				}
				
				$products = $this->characteristics->get_products_by_filter($filters_checked, 'sort', 'asc', 10, 0);
				$products = $this->products->prepare_list($products);
				
				$semantic_urls[] = 'catalog/'.$category->url;		
				
				$all_products = $this->characteristics->get_products_by_filter($filters_checked, 'sort', 'asc');
				$total_rows = count($all_products);
			}
			else
			{
				$param = array('parent_id' => $category->id);

				$filters_checked['categories_checked'][] = $category->id;
				
				$products = $this->products->prepare_list($this->products->get_list($param, 0, 10, 'sort', 'asc'));
				
				foreach($category_anchors as $c_anch)
				{
					$parent_category = $this->categories->get_item($c_anch->category_parent_id);
					$semantic_urls[] = 'catalog/'.$parent_category->url.'/'.$category->url;
				}
				
				$all_products = $this->products->get_list($param, FALSE, FALSE, 'sort', 'asc');
				$total_rows = count($all_products);
			}
					
			$childs = array();
			foreach($left_menu as $item_1)
			{
				if ($category->id == $item_1->id)
				{
					$childs = $item_1->childs;
					break;
				}
			}
			
			$filters_checked['manufacturer_checked'] = array();

			$data = array(
				'category' => $category,
				'filters_checked' => $filters_checked,
				'manufacturer_ch' => array(),
				'left_menu' => $left_menu,
				'childs_categories' => $childs,
				'title' => $category->name.' | интернет-магазин bрайтbилd',
				'meta_description' => $category->meta_description,
				'meta_keywords' => $category->meta_keywords,
				'all_products' => $all_products,
				'total_rows' => $total_rows
			);

			$data['categories_ch'][] = $category->name;
			$data['category']->products = $products;

			foreach($semantic_urls as $url)
			{
				echo $counter.' - '.$url.'</br>';
				$cache_id = md5(serialize($url));
				
				$this->filters_cache->delete($cache_id);
				$this->filters_cache->insert($cache_id, $data, $url);
				$counter++;
			}
		}
		
		
		
		
		echo "<a href='".base_url()."admin'>На главную</a>";
	}
}