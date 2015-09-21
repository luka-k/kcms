<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Catalog class
*
* @package		kcms
* @subpackage	Controllers
* @category	    Catalog
*/
class Catalog extends Client_Controller {

	protected $get = array();
	protected $post = array();

	public function __construct()
	{
		parent::__construct();
		
		$this->benchmark->mark('code_start');
		
		$this->config->load('types');
		
		$this->post = $this->input->post();

		$price_min = $price_from = $this->products->get_min('sale_price');
		if(!empty($this->post['price_from'])) $price_from = preg_replace('/[^0-9]/', '', $this->post['price_from']);
		$price_max = $price_to = $this->products->get_max('sale_price');
		if(!empty($this->post['price_to'])) $price_to = preg_replace('/[^0-9]/', '', $this->post['price_to']);
		
		$width_min = $width_from = $this->products->get_min('width');
		if(!empty($this->post['width_from'])) $width_from = preg_replace('/[^0-9]/', '', $this->post['width_from']);
		$width_max = $width_to = $this->products->get_max('width');
		if(!empty($this->post['width_to'])) $width_to = preg_replace('/[^0-9]/', '', $this->post['width_to']);
		
		$height_min = $height_from = $this->products->get_min('height');
		if(!empty($this->post['height_from'])) $height_from = preg_replace('/[^0-9]/', '', $this->post['height_from']);
		$height_max = $height_to = $this->products->get_max('height');
		if(!empty($this->post['height_to'])) $height_to = preg_replace('/[^0-9]/', '', $this->post['height_to']);
		
		$depth_min = $depth_from = $this->products->get_min('depth');
		if(!empty($this->post['depth_from'])) $depth_from = preg_replace('/[^0-9]/', '', $this->post['depth_from']);
		$depth_max = $depth_to = $this->products->get_max('depth');
		if(!empty($this->post['depth_to'])) $depth_to = preg_replace('/[^0-9]/', '', $this->post['depth_to']);
		
		//$this->session->sess_destroy("cart_contents");
		
		/*$availability = array(
			'on_request' => 'По запросу',
			'in_stock' => 'На складе'
		);*/
		
		$availability = $this->config->item('availability');
		foreach($availability as $key => $value)
		{
			$filters_checked[$key] = 1;
		}
		
		$data = array(
			'title' => 'Интернет-магазин bрайтbилd',
			'url' => base_url().uri_string().'?'.get_filter_string($_SERVER['QUERY_STRING']),
			'top_active' => 'shop',
			'price_from' => $price_from,
			'price_to' => $price_to,
			'price_min' => $price_min,
			'price_max' => $price_max,
			'width_from' => $width_from,
			'width_to' => $width_to,
			'width_min' => $width_min,
			'width_max' => $width_max,
			'height_from' => $height_from,
			'height_to' => $height_to,
			'height_min' => $height_min,
			'height_max' => $height_max,
			'depth_from' => $depth_from,
			'depth_to' => $depth_to,
			'depth_min' => $depth_min,
			'depth_max' => $depth_max,
			'filters_checked' => $filters_checked,
			'left_menu' => $this->categories->get_tree(),
			'manufacturer' => $this->manufacturers->get_tree(FALSE, $this->post),
			'sku_tree' => array(),
			'collection' => array(),
			'availability' => $availability,
			'sku' => array(),
			//'nok' => array(),
			'ajax_from' => '',
			'childs_categories' => ''
		);
		
		$this->standart_data = array_merge($this->standart_data, $data);
		
		$this->load->helper('url_helper');
	}
	
	public function index()
	{
		$this->breadcrumbs->add(base_url(), 'Главная');
		$this->breadcrumbs->add('catalog', 'Каталог');
		
		$this->post = $this->input->post();
		
		if(isset($this->post['filter']))
		{
			 $this->get_by_filter();
		}
		else
		{		
			
			$content = $this->url->shop_url_parse(2);

			isset($content->product) ? $this->product($content) : $this->category($content);
		}
	}
	
	/**
	* Вывод категории товаров
	*
	* @param object $content
	*/
	private function category($content)
	{	
		//$this->session->unset_userdata('last_cache_id');
		
		$filters_checked = array(
			'filter' => TRUE, 
			'last_type_filter' => 'categories_checked', 
			'from' => 0,
		);
		
		$availability = $this->config->item('availability');
		foreach($availability as $key => $value)
		{
			$filters_checked[$key] = 1;
		}

		if($content == "root")
		{
			$cache_id = md5(serialize($content));
			$cache = $this->filters_cache->get($cache_id);
			//$cache = FALSE;
			if($cache)
			{
				$this->filters_cache->set_last($cache_id);
				$data = $this->filters_cache->get($cache_id);	

				$data = array_merge($this->standart_data, $data);			
			}
			else
			{
				$products = $this->products->prepare_list($this->products->get_list(FALSE, 0, 10, 'name', 'asc'));

				$products_ids = $this->catalog->get_products_ids($products);

				$total_rows = count($this->products->get_list(FALSE));
			
				$data = array(
					'filters_checked' => $filters_checked,
					'left_menu' => $this->categories->get_tree(),
					'collection' => $this->collections->get_tree(),
					'sku_tree' => $this->manufacturers->get_tree(),
					'nok' => $this->catalog->get_nok_tree($products_ids),
					'breadcrumbs' => $this->breadcrumbs->get(),
					'total_rows' => $total_rows,
					'filters' => $this->characteristics_type->get_filters($this->products->get_list(FALSE)),
					'left_menu' => $this->categories->get_tree(),
				);
			
				$data['category'] = new stdClass;
				$data['category']->products = $products;
				
				$data = array_merge($this->standart_data, $data);
				
				$this->filters_cache->insert($cache_id, $data);
			}
			$this->load->view("client/shop/index", $data);
		}
		else
		{
			$semantic_url = $this->uri->uri_string();
			
			$cache_id = md5(serialize($semantic_url));
	
			$data = $this->filters_cache->get($cache_id);
			
			//$cache = FALSE;
			if($data)
			{
				$this->filters_cache->set_last($cache_id);
				$cache = $this->filters_cache->get_item_by(array('id' => $cache_id));	

				$data['breadcrumbs'] = $this->breadcrumbs->get();
				$data['category']->products = $this->products->prepare_list($data['category']->products);
				$data['nok'] = $this->catalog->get_nok_tree($data['all_products_ids']);
				if($cache->type == 'categories') $data['logo_column'] = TRUE;
				$data['beautiful_link'] = $semantic_url;
				
				if($data['all_products_ids']) 
				{
					$this->db->where_in('id', $data['all_products_ids']);
					$all_products = $this->db->get('products')->result();
					
					$data['price_min'] = $data['price_from'] = $this->catalog->get_min($all_products, 'sale_price');
					$data['price_max'] = $data['price_to'] = $this->catalog->get_max($all_products, 'sale_price');
			
					$data['width_min'] = $data['width_from'] = $this->catalog->get_min($all_products, 'width');
					$data['width_max'] = $data['width_to'] = $this->catalog->get_max($all_products, 'width');
			
					$data['height_min'] = $data['height_from'] = $this->catalog->get_min($all_products, 'height');
					$data['height_max'] = $data['height_to'] = $this->catalog->get_max($all_products, 'height');
			
					$data['depth_min'] = $data['depth_from'] = $this->catalog->get_min($all_products, 'depth');
					$data['depth_max'] = $data['depth_to'] = $this->catalog->get_max($all_products, 'depth');
				}
				
				$data['no_shadow'] = TRUE;
				$data = array_merge($this->standart_data, $data);
		
				$this->load->view("client/shop/categories", $data);
			}
			else
			{
				redirect(base_url().'pages/page_404');
			}
		}
	}
	
	/**
	* Вывод товаров по фильтру
	*/
	public function get_by_filter()
	{	
		if($this->uri->uri_string() == "catalog/sale")
		{
			$this->post = array(
				'filter' => TRUE, 
				'last_type_filter' => '', 
				'is_sale' => 1,
				'name' => '',
				'from' => 0,
				'order' => 'name',
				'direction' => 'asc',
				'discontinued' => 2
			);
		}

		$cache_id = md5(serialize($this->post));

		$cache = $this->filters_cache->get($cache_id);
		//if($cache) $this->filters_cache->delete($cache_id);
		//$cache = FALSE;
		if($cache)
		{
			redirect(base_url().'catalog/filter/'.$cache_id);
		}
		else
		{	
			if($this->post['name'])
			{
				$product = $this->products->get_item_by(array("name" => $this->post['name']));
				if(!empty($product))
				{
					$product = $this->products->prepare($product, FALSE);
					redirect($product->full_url);
				}
			}
			
			$products = $this->characteristics->get_products_by_filter($this->post, $this->post['order'], $this->post['direction']);
			$products_ids = $this->catalog->get_products_ids($products);
		
			$last_type_filter = $this->post['last_type_filter'];
			//wlt - without last type
			$filters_wlt = $this->post;
			if($last_type_filter == 'shortname' || $last_type_filter == 'shortdesc')
			{
				unset($filters_wlt['shortname']);
				unset($filters_wlt['shortdesc']);
			}
			else
			{
				unset($filters_wlt[$last_type_filter]);
			}

			$products_wlt =  $this->characteristics->get_products_by_filter($filters_wlt, $this->post['order'], $this->post['direction']);
		
			$products_ids_wlt = $this->catalog->get_products_ids($products_wlt);
		
			$products_for_content = $this->characteristics->get_products_by_filter($this->post, $this->post['order'], $this->post['direction'], 10, 0);
		
			$filters = $this->characteristics_type->get_filters($products, $this->post);
			$filters['name'] = $this->post['name'];
			$filters['is_sale'] = $this->post['is_sale'];
			$filters['discontinued'] = $this->post['discontinued'];
			
			$filters_2 = $this->characteristics_type->get_filters($products_wlt);
			if(isset($filters[$last_type_filter])) $filters[$last_type_filter] = $filters_2[$last_type_filter];
			
			if($products) foreach($products as $i => $p)
			{
				$products[$i]->sale_price = round($p->sale_price, -1);
			}
			
			$price_min = $price_from = $this->catalog->get_min($products, 'sale_price');
			$price_max = $price_to = $this->catalog->get_max($products, 'sale_price');
			
			if($last_type_filter == "price") 
			{
				$price_min = $price_from = preg_replace('/[^0-9]/', '', $this->post['price_from']);
				$price_max = $price_to = preg_replace('/[^0-9]/', '', $this->post['price_to']);
			}
			
			$width_min = $width_from = $this->catalog->get_min($products, 'width');
			$width_max = $width_to = $this->catalog->get_max($products, 'width');
			
			if($last_type_filter == "width") 
			{
				$width_min = $width_from = preg_replace('/[^0-9]/', '', $this->post['width_from']);
				$width_max = $width_to = preg_replace('/[^0-9]/', '', $this->post['width_to']);
			}
		
			$height_min = $height_from = $this->catalog->get_min($products, 'height');
			$height_max = $height_to = $this->catalog->get_max($products, 'height');
			
			if($last_type_filter == "height")
			{
				$height_min = $height_from = preg_replace('/[^0-9]/', '', $this->post['height_from']);
				$height_max = $height_to = preg_replace('/[^0-9]/', '', $this->post['height_to']);
			}
		
			$depth_min = $depth_from = $this->catalog->get_min($products, 'depth');
			$depth_max = $depth_to = $this->catalog->get_max($products, 'depth');
			
			if($last_type_filter == "depth") 
			{
				$depth_min = $depth_from = preg_replace('/[^0-9]/', '', $this->post['depth_from']);	
				$depth_max = $depth_to = preg_replace('/[^0-9]/', '', $this->post['depth_to']);
			}

			$data = array(
				'breadcrumbs' => $this->breadcrumbs->get(),
				'filters_checked' => $this->post,
				'filters' => $filters,
				'total_rows' => count($products),
				'left_menu' => $last_type_filter == "categories_checked" ? $this->categories->get_tree($products_wlt) : $this->categories->get_tree($products, $this->post),
				'collection' => $last_type_filter == "collection_checked" ? $this->collections->get_tree($products_ids_wlt) : $this->collections->get_tree($products_ids, $this->post),
				'manufacturer' => $last_type_filter == "manufacturer_checked" ? $this->manufacturers->get_tree($products_wlt) : $this->manufacturers->get_tree($products, $this->post),
				'sku_tree' => $last_type_filter == "sku_checked" ? $this->manufacturers->get_tree($products_wlt) : $this->manufacturers->get_tree($products, $this->post),
				'parent_ch' => $this->catalog->get_filters_info($this->post, 'categories', 'parent_checked'),
				'categories_ch' => $this->catalog->get_filters_info($this->post, 'categories', 'categories_checked'),
				'manufacturer_ch' => $this->catalog->get_filters_info($this->post, 'manufacturers', 'manufacturer_checked'),
				'collections_ch' => $this->catalog->get_filters_info($this->post, 'collections', 'collection_checked'),
				'sku_ch' => $this->catalog->get_filters_info($this->post, 'products', 'sku_checked'),
				'shortname_ch' => $this->catalog->get_filters_info($this->post, 'characteristics', 'shortname'),
				'shortdesc_ch' => $this->catalog->get_filters_info($this->post, 'characteristics', 'shortdesc'),
				'color_ch' => $this->catalog->get_filters_info($this->post, 'characteristics', 'color'),
				'material_ch' => $this->catalog->get_filters_info($this->post, 'characteristics', 'material'),
				'finishing_ch' => $this->catalog->get_filters_info($this->post, 'characteristics', 'finishing'),
				'turn_ch' => $this->catalog->get_filters_info($this->post, 'characteristics', 'turn'),
				'ajax_from' => '',
				'price_from' => $price_from,
				'price_to' => $price_to,
				'price_min' => $price_min,
				'price_max' => $price_max,
				'width_from' => $width_from,
				'width_to' => $width_to,
				'width_min' => $width_min,
				'width_max' => $width_max,
				'height_from' => $height_from,
				'height_to' => $height_to,
				'height_min' => $height_min,
				'height_max' => $height_max,
				'depth_from' => $depth_from,
				'depth_to' => $depth_to,
				'depth_min' => $depth_min,
				'depth_max' => $depth_max
			);

			if($last_type_filter == 'shortname' || $last_type_filter == 'shortdesc')
			{
				$data['nok'] = $this->catalog->get_nok_tree($products_ids_wlt, $this->post);
			}
			else
			{
				$data['nok'] = $this->catalog->get_nok_tree($products_ids, $this->post);
			}
			
			$data['category'] = new stdClass;	
			$data['category']->products = $this->products->prepare_list($products_for_content);
						
			if(!empty($data['parent_ch']))
			{
				$data['title'] = $data['parent_ch'][0].' | интернет-магазин bрайтbилd';
			}
			elseif(!empty($data['categories_ch'][0]))
			{
				$data['title'] = $data['categories_ch'][0].' | интернет-магазин bрайтbилd';
			}

			$availability = $this->config->item('availability');
			
			$data['availability_ch'] = array();
			foreach($availability as $key => $value)
			{
				if($data['filters_checked'][$key] == 1) $data['availability_ch'][] = $value;
			}

			$this->filters_cache->insert($cache_id, $data);
			
			$this->benchmark->mark('code_end');
			//my_dump($this->benchmark->elapsed_time('code_start', 'code_end'));
			redirect(base_url()."catalog/filter/".$cache_id);
		}	
	}
	
	public function filter($cache_id)
	{
		$this->filters_cache->set_last($cache_id);
		$data = $this->filters_cache->get($cache_id);

		$data = array_merge($this->standart_data, $data);
		
		if($data['total_rows'] <> count($this->products->get_list())) 
		{
			$data['no_shadow'] = TRUE;
		}
		else
		{
			redirect(base_url().'catalog');
		}
		
		$this->load->view("client/shop/categories", $data);
	}
	
	/**
	* Вывод страницы товара
	*
	* @param object $content
	*/
	private function product($content)
	{
		$last_cache_id = $this->session->userdata('last_cache_id');
			
		$back_link = '';
		if($last_cache_id) 
		{
			$cache = $this->filters_cache->get_item_by(array('id' => $last_cache_id));
			if($cache) $back_link = $cache->semantic_url;
			
			$cache_data = $this->filters_cache->get($this->session->userdata('last_cache_id'));
		}
		
		$new_products = $this->products->get_list(array('is_new' => 1), FALSE, 3);

		$this->session->unset_userdata('pre_cart');
		$data = array(
			'title' => $content->product->name.' | интернет-магазин bрайтbилd',
			'meta_keywords' => $content->product->meta_keywords,
			'meta_description' => $content->product->meta_description,
			'breadcrumbs' => $this->breadcrumbs->get(),
			'product' => $this->products->prepare($content->product, FALSE),
			'back_link' => $back_link
		);
		$data['title'] = $data['breadcrumbs'][count($data['breadcrumbs'])-1]['name'];

		$data['product']->recommended_products = $this->products->prepare_list($this->products->get_anchor($data['product']->id, 'recommended'), TRUE);
		$data['product']->components_products = $this->products->prepare_list($this->products->get_anchor($data['product']->id, 'components'), TRUE);
		$data['product']->accessories_products = $this->products->prepare_list($this->products->get_anchor($data['product']->id, 'accessories'), TRUE);
		
		if(!empty($cache_data))
		{
			$data['filters'] = $cache_data['filters'];
			$data['left_menu'] = $cache_data['left_menu'];
			$data['manufacturer'] = $cache_data['manufacturer'];
			
			if(isset($cache_data['filters_checked'])) $data['filters_checked'] = $cache_data['filters_checked'];
			if(isset($cache_data['categories_ch'])) $data['categories_ch'] = $cache_data['categories_ch'];
			if(isset($cache_data['manufacturer_ch'])) $data['manufacturer_ch'] = $cache_data['manufacturer_ch'];
			if(isset($cache_data['collection'])) $data['collection'] = $cache_data['collection'];
			if(isset($cache_data['sku_tree'])) $data['sku_tree'] = $cache_data['sku_tree'];
			if(isset($cache_data['collections_ch'])) $data['collections_ch'] = $cache_data['collections_ch'];
			if(isset($cache_data['sku_ch'])) $data['sku_ch'] = $cache_data['sku_ch'];
			if(isset($cache_data['shortname_ch'])) $data['shortname_ch'] = $cache_data['shortname_ch'];
			if(isset($cache_data['shortdesc_ch'])) $data['shortdesc_ch'] = $cache_data['shortdesc_ch'];
			if(isset($cache_data['color_ch'])) $data['color_ch'] = $cache_data['color_ch'];
			if(isset($cache_data['material_ch'])) $data['material_ch'] = $cache_data['material_ch'];
			if(isset($cache_data['finishing_ch'])) $data['finishing_ch'] = $cache_data['finishing_ch'];
			if(isset($cache_data['turn_ch'])) $data['turn_ch'] = $cache_data['turn_ch'];
			
			$data['last_cache_id'] = $this->session->userdata('last_cache_id');
		}

		$data = array_merge($this->standart_data, $data);
		
		$this->load->view('client/shop/product', $data);
	}
	
	public function count()
	{
		$products = $this->characteristics->get_products_by_filter($this->post, $this->post['order'], $this->post['direction']);
		echo count($products);
	}
	
	public function ajax_more()
	{
		$products = $this->characteristics->get_products_by_filter($this->post, $this->post['order'], $this->post['direction'], 10, $this->post['from']);

		$content = '';
		
		if($products) foreach($products as $item)
		{
			$product = array('item' => $this->products->prepare($item, TRUE, FALSE));
			$content.= $this->load->view('client/shop/include/ajax_product', $product, TRUE);
		}

		$ajax_from = $this->post['from'] + 10;
		
		$data = array(
			'content' => $content,
			'ajax_from' => $ajax_from
		);
		
		echo json_encode($data);
	}
	
	public function search_more()
	{
		$name = $this->input->post('name');
		
		$this->db->like('name', $name);
		$this->db->limit(10, $this->input->post('from'));
		$query = $this->db->get('products');
		$products = $query->result();
		
		$content = '';
		if($products) foreach($products as $item)
		{
			$product = array('item' => $this->products->prepare($item, TRUE, FALSE));
			$content.= $this->load->view('client/shop/include/ajax_product', $product, TRUE);
		}

		$ajax_from = $this->post['from'] + 10;
		
		$data = array(
			'content' => $content,
			'ajax_from' => $ajax_from
		);
		
		echo json_encode($data);
	}
	
	function autocomplete()
	{
		$products = $this->characteristics->get_products_by_filter($this->post, $this->post['order'], $this->post['direction']);

		$available_tags = array();
		foreach($products as $p)
		{
			$available_tags[] = $p->name;
		}
		$answer['available_tags'] = $available_tags;
		
		echo json_encode($answer);
	}
}

/* End of file catalog.php */
/* Location: ./application/controllers/catalog.php */