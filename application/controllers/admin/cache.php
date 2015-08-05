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
	
	public function refresh_categories()
	{
		$this->db->where('type', 'categories');
		$this->db->delete('filters_cache');
		$counter = 1;

		echo '<h3>Категории</h3></br>';
		
		$categories = $this->categories->get_admin_tree(0);

		$insert_data = array();
		
		foreach($categories as $category)
		{
			$categories_checked = array();
			if(!empty($category->childs)) foreach($category->childs as $child_category)
			{
				$filters_checked = array(
					'filter' => TRUE, 
					'last_type_filter' => 'categories_checked', 
					'categories_checked' => array($child_category->id),
					'manufacturer_checked' => array(),
					'from' => 0,
				);
				
				$products = array();
				$data = array();
				
				$param = array('parent_id' => $child_category->id);
				
				$products = $this->products->get_list($param, 0, 10, 'sort', 'asc');
								
				$all_products = $this->products->get_list($param, FALSE, FALSE, 'sort', 'asc');
				$total_rows = count($all_products);
								
				$all_products_ids = $this->catalog->get_products_ids($all_products);
				
				$manufacturers = $this->manufacturers->get_tree($all_products);

				$data = array(
					'category' => $category,
					'filters_checked' => $filters_checked,
					'manufacturer_ch' => array(),
					'left_menu' => $categories,
					'manufacturer' => $manufacturers,
					'collection' => $this->collections->get_tree($all_products_ids),
					'sku_tree' => $manufacturers,
					'nok' => $this->catalog->get_nok_tree($all_products_ids),
					'filters' => $this->characteristics_type->get_filters($all_products),
					'childs_categories' => array(),
					'title' => $child_category->name.' | интернет-магазин bрайтbилd',
					'meta_description' => $category->meta_description,
					'meta_keywords' => $category->meta_keywords,
					'all_products_ids' => $all_products_ids,
					'total_rows' => $total_rows,
				);
				
				$data['categories_ch'][] = $child_category->name;
				$data['category']->products = $products;

				$semantic_url = 'catalog/'.$category->url.'/'.$child_category->url;
				
				echo $counter.' - '.$semantic_url.'</br>';
				$cache_id = md5(serialize($semantic_url));
								
				$insert_data[] = array(
					'id' => $cache_id,
					'cache_data' => serialize($data),
					'semantic_url' => $semantic_url,
					'type' => 'categories'
				);
				$counter++;
				
				$categories_checked[] = $child_category->id;
			}
			
			$filters_checked = array(
				'filter' => TRUE, 
				'last_type_filter' => 'categories_checked', 
				'parent_checked' => array($category->id),
				'from' => 0,
			);
			
			$products = array();
			$data = array();
			
			$filters_checked['categories_checked'] = $categories_checked;

			$products = $this->characteristics->get_products_by_filter($filters_checked, 'sort', 'asc', 10, 0);
				
			$all_products =  $this->characteristics->get_products_by_filter($filters_checked, 'sort', 'asc');
			$total_rows = count($all_products);
							
			$all_products_ids = $this->catalog->get_products_ids($all_products);
			
			$manufacturers = $this->manufacturers->get_tree($all_products);
			
			$data = array(
				'category' => $category,
				'filters_checked' => $filters_checked,
				'manufacturer_ch' => array(),
				'left_menu' => $categories,
				'manufacturer' => $manufacturers,
				'collection' => $this->collections->get_tree($all_products_ids),
				'sku_tree' => $manufacturers,
				'nok' => $this->catalog->get_nok_tree($all_products_ids),
				'filters' => $this->characteristics_type->get_filters($all_products),
				'childs_categories' => $category->childs,
				'title' => $category->name.' | интернет-магазин bрайтbилd',
				'meta_description' => $category->meta_description,
				'meta_keywords' => $category->meta_keywords,
				'all_products_ids' => $all_products_ids,
				'total_rows' => $total_rows,
			);
				
			$data['categories_ch'][] = $category->name;
			$data['category']->products = $products;

			$semantic_url = 'catalog/'.$category->url;
			
			echo $counter.' - '.$semantic_url.'</br>';
			$cache_id = md5(serialize($semantic_url));

			$insert_data[] = array(
				'id' => $cache_id,
				'cache_data' => serialize($data),
				'semantic_url' => $semantic_url,
				'type' => 'categories'
			);
			$counter++;
		}
		
		$this->db->insert_batch('filters_cache', $insert_data);

		echo "<a href='".base_url()."admin'>На главную</a>";
	}
	
	public function refresh_manufacturer_by_categories()
	{
		$this->db->where('type', 'categories/manufacturer');
		$this->db->delete('filters_cache');
		$counter = 1;

		echo '<h3>Категории</h3></br>';
		
		$categories = $this->categories->get_admin_tree(0);
		$manufacturers = $this->manufacturers->get_tree();

		$insert_data = array();
		
		foreach($categories as $category)
		{
			$categories_checked = array();
			if(!empty($category->childs)) foreach($category->childs as $child_category)
			{
				$filters_checked = array(
					'filter' => TRUE, 
					'last_type_filter' => 'manufacturer_checked', 
					'categories_checked' => array($child_category->id),
					'manufacturer_checked' => array(),
					'from' => 0,
				);
				
				$products = array();
				$data = array();
				
				foreach($manufacturers as $manufacturer)
				{
					$manufacturer_ch = array($manufacturer->name);
					$filters_checked['manufacturer_checked'] = array($manufacturer->id);

					$param = array('parent_id' => $child_category->id, 'manufacturer_id' => $manufacturer->id);
				
					$products = $this->products->get_list($param, 0, 10, 'sort', 'asc');
						
					if($products)
					{
						$all_products = $this->products->get_list($param, FALSE, FALSE, 'sort', 'asc');
						$total_rows = count($all_products);
								
						$all_products_ids = $this->catalog->get_products_ids($all_products);
				
						$data = array(
							'category' => $category,
							'filters_checked' => $filters_checked,
							'manufacturer_ch' => array(),
							'left_menu' => $this->categories->get_tree($all_products),
							'manufacturer' => $manufacturers,
							'manufacturer_ch' => array($manufacturer->name),
							'collection' => $this->collections->get_tree($all_products_ids),
							'sku_tree' => $manufacturers,
							/*'nok' => $this->catalog->get_nok_tree($all_products_ids),*/
							'filters' => $this->characteristics_type->get_filters($all_products),
							'childs_categories' => array(),
							'title' => $child_category->name.' | интернет-магазин bрайтbилd',
							'meta_description' => $category->meta_description,
							'meta_keywords' => $category->meta_keywords,
							'all_products_ids' => $all_products_ids,
							'total_rows' => $total_rows,
						);
				
						$data['categories_ch'][] = $child_category->name;
						$data['category']->products = $products;

						$semantic_url = 'catalog/'.$category->url.'/'.$child_category->url.'/'.mb_strtolower($manufacturer->name, 'UTF-8');
					
						echo $counter.' - '.$semantic_url.'</br>';
						$cache_id = md5(serialize($semantic_url));

						$insert_data[] = array(
							'id' => $cache_id,
							'cache_data' => serialize($data),
							'semantic_url' => $semantic_url,
							'type' => 'categories/manufacturer'
						);
						$counter++;
					}
				}
				
				$categories_checked[] = $child_category->id;
			}
			
			$filters_checked = array(
				'filter' => TRUE, 
				'last_type_filter' => 'categories_checked', 
				'parent_checked' => array($category->id),
				'manufacturer_checked' => array(),
				'from' => 0,
			);
			
			$filters_checked['categories_checked'] = $categories_checked;
			
			$products = array();
			$data = array();
						
			foreach($manufacturers as $manufacturer)
			{	
				$manufacturer_ch = array($manufacturer->name);
				$filters_checked['manufacturer_checked'] = array($manufacturer->id);

				$products = $this->characteristics->get_products_by_filter($filters_checked, 'sort', 'asc', 10, 0);
				
				if($products)
				{
					$all_products =  $this->characteristics->get_products_by_filter($filters_checked, 'sort', 'asc');
					$total_rows = count($all_products);
							
					$all_products_ids = $this->catalog->get_products_ids($all_products);
								
					$data = array(
						'category' => $category,
						'filters_checked' => $filters_checked,
						'manufacturer_ch' => array(),
						'left_menu' => $this->categories->get_tree($all_products),
						'manufacturer' => $manufacturers,
						'manufacturer_ch' => array($manufacturer->name),
						'collection' => $this->collections->get_tree($all_products_ids),
						'sku_tree' => $manufacturers,
						/*'nok' => $this->catalog->get_nok_tree($all_products_ids),*/
						'filters' => $this->characteristics_type->get_filters($all_products),
						'childs_categories' => $category->childs,
						'title' => $category->name.' | интернет-магазин bрайтbилd',
						'meta_description' => $category->meta_description,
						'meta_keywords' => $category->meta_keywords,
						'all_products_ids' => $all_products_ids,
						'total_rows' => $total_rows,
					);
					
					$data['categories_ch'][] = $category->name;
					$data['category']->products = $products;

					$semantic_url = 'catalog/'.$category->url.'/'.mb_strtolower($manufacturer->name, 'UTF-8');
			
					echo $counter.' - '.$semantic_url.'</br>';
					$cache_id = md5(serialize($semantic_url));

					$insert_data[] = array(
						'id' => $cache_id,
						'cache_data' => serialize($data),
						'semantic_url' => $semantic_url,
						'type' => 'categories/manufacturer'
					);
					$counter++;
				}
			}
		}
		
		/*$left_menu = $this->categories->get_tree();
		
		$categories = $this->categories->get_list(FALSE);
		
		foreach($categories as $category)
		{
			$filters_checked = array(
				'filter' => TRUE, 
				'last_type_filter' => 'manufacturers_checked', 
				'from' => 0,
			);
			
			$products = array();
			$semantic_urls = array();
			$data = array();
			$childs = array();
			
			$this->db->select('category_parent_id');
			$category_anchors = $this->db->get_where('category2category', array('child_id' => $category->id))->result();
			
			if(count($category_anchors) == 1 && $category_anchors[0]->category_parent_id == 0)
			{
				$filters_checked['parent_checked'][] = $category->id;
				$this->db->select('child_id');
				$sub_categories = $this->db->get_where('category2category', array('category_parent_id' => $category->id))->result();
				if($sub_categories) foreach($sub_categories as $sub_category)
				{
					$filters_checked['categories_checked'][] = $sub_category->child_id;
				}
				
				foreach($left_menu as $item_1)
				{
					if ($category->id == $item_1->id)
					{
						$childs = $item_1->childs;
						break;
					}
				}
								
				$semantic_urls[] = 'catalog/'.$category->url;		
			}
			else
			{
				$param = array('parent_id' => $category->id);

				$filters_checked['categories_checked'][] = $category->id;
				
				foreach($category_anchors as $c_anch)
				{
					$parent_category = $this->categories->get_item($c_anch->category_parent_id);
					$semantic_urls[] = 'catalog/'.$parent_category->url.'/'.$category->url;
				}
			}

			$this->db->distinct();
			$this->db->select('manufacturer_id');
			$m2c = $this->db->get_where('manufacturer2category', array('category_id' => $category->id))->result();
			
			$manufacturers = $this->manufacturers->get_tree(FALSE);
							
			if($m2c) foreach($m2c as $m)
			{	
				$manufacturer_ch = array();
				$filters_checked['manufacturer_checked'] = array();
				
				$manufacturer = $this->manufacturers->get_item($m->manufacturer_id);

				$manufacturer_ch = $manufacturer->name;
				$filters_checked['manufacturer_checked'][] = $manufacturer->id;
				
				$products = $this->characteristics->get_products_by_filter($filters_checked, 'sort', 'asc', 10, 0);
				$products = $this->products->prepare_list($products);
			
				$all_products = $this->characteristics->get_products_by_filter($filters_checked, 'sort', 'asc');
				$total_rows = count($all_products);
				
				$all_products_ids = $this->catalog->get_products_ids($all_products);
				
				$left_menu = $this->categories->get_tree($all_products);
				
				$collections =	$this->collections->get_tree($all_products_ids);
				/*$nok = $this->catalog->get_nok_tree($all_products_ids);
				$filters = $this->characteristics_type->get_filters($all_products);
					
				foreach($semantic_urls as $url)
				{
					$semantic_url = $url.'/'.$manufacturer->url;
					echo $counter.' - '.$semantic_url.'</br>';
					$cache_id = md5(serialize($semantic_url));
					
					$data = array(
						'category' => $category,
						'left_menu' => $left_menu,
						'manufacturer' => $manufacturers,
						'collection' =>	$collections,
						'sku_tree' => $manufacturers,
						/*'nok' => $nok,
						'filters' => $filters,
						'filters_checked' => $filters_checked,
						'manufacturer_ch' => array($manufacturer->name),
						'childs_categories' => $childs,
						'title' => $category->name.' | интернет-магазин bрайтbилd',
						'meta_description' => $category->meta_description,
						'meta_keywords' => $category->meta_keywords,
						/*'all_products' => $all_products,
						'total_rows' => $total_rows,
						'type' => 'manufacturers'
					);

					$data['categories_ch'][] = $category->name;
					$data['category']->products = $products;

					$this->filters_cache->insert($cache_id, $data, 'categories/manufacturer', $semantic_url);
					$insert_data[] = array(
						'id' => $cache_id,
						'cache_data' => serialize($data),
						'semantic_url' => $semantic_url,
						'type' => 'categories/manufacturer'
					);
					$counter++;
				}
			}	
		}*/
		$this->db->insert_batch('filters_cache', $insert_data);

		echo "<a href='".base_url()."admin'>На главную</a>";
	}
	
	public function refresh_manufacturers()
	{
		echo '<h3>Производители</h3></br>';
		
		$this->db->where('type', 'manufacturers');
		$this->db->delete('filters_cache');
		
		$manufacturers = $this->manufacturers->get_tree(FALSE);

		$counter = 1;
		
		foreach($manufacturers as $manufacturer)
		{
			$filters_checked = array(
				'filter' => TRUE, 
				'last_type_filter' => 'manufacturers_checked', 
				'from' => 0,
			);
			
			$filters_checked['manufacturer_checked'][] = $manufacturer->id;
			$manufacturer_ch = array($manufacturer->name);
			
			$products = $this->products->prepare_list($this->products->get_list(array('manufacturer_id' => $manufacturer->id), 0, 10, 'sort', 'asc'));
			$all_products = $this->products->get_list(array('manufacturer_id' => $manufacturer->id), FALSE, FALSE, 'sort', 'asc');
			$total_rows = count($all_products);
			
			$all_products_ids = $this->catalog->get_products_ids($all_products);
			
			$left_menu = $this->categories->get_tree($all_products);
			
			$data = array(
				'filters_checked' => $filters_checked,
				'childs_categories' => array(),
				'title' => $manufacturer->name.' | интернет-магазин bрайтbилd',
				'meta_keywords' => $manufacturer->meta_keywords,
				'meta_description' => $manufacturer->meta_description,
				'left_menu' => $left_menu,
				'manufacturer' => $manufacturers,
				'manufacturer_ch' => $manufacturer_ch,
				'collection' =>	$this->collections->get_tree($all_products_ids),
				'sku_tree' => $manufacturers,
				'nok' => $this->catalog->get_nok_tree($all_products_ids),
				'filters' => $this->characteristics_type->get_filters($all_products),
				'categories_ch' => array(),
				'all_products' => $all_products,
				'total_rows' => $total_rows,
				'type' => 'manufacturer'
			);
			
			$data['category'] = new stdClass();
			$data['category']->products = $products;
			
			$semantic_url = 'catalog/'.$manufacturer->url;
			
			echo $counter.' - '.$semantic_url.'</br>';
			$cache_id = md5(serialize($semantic_url));
				
			$this->filters_cache->insert($cache_id, $data, 'manufacturers', $semantic_url);
			$counter++;
		}
		
		echo "<a href='".base_url()."admin'>На главную</a>";
	}
}