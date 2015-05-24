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
		
		$this->config->load('characteristics');
		
		$this->get = $this->input->get();
		$this->post = $this->input->post();

		if(!isset($this->get['order']))
		{
			$this->get['order'] = "sort";
			$this->get['direction'] = "asc";
		}

		$price_min = $price_from = $this->products->get_min('price');
		if(!empty($this->post['price_from'])) $price_from = preg_replace("/[^0-9]/", "", $this->post['price_from']);
		$price_max = $price_to = $this->products->get_max('price');
		if(!empty($this->post['price_to'])) $price_to = preg_replace("/[^0-9]/", "", $this->post['price_to']);

		$width_min = $width_from = $this->products->get_min('width');
		if(!empty($this->post['width_from'])) $width_from = preg_replace("/[^0-9]/", "", $this->post['width_from']);
		$width_max = $width_to = $this->products->get_max('width');
		if(!empty($this->post['width_to'])) $width_to = preg_replace("/[^0-9]/", "", $this->post['width_to']);
		
		$height_min = $height_from = $this->products->get_min('height');
		if(!empty($this->post['height_from'])) $height_from = preg_replace("/[^0-9]/", "", $this->post['height_from']);
		$height_max = $height_to = $this->products->get_max('height');
		if(!empty($this->post['height_to'])) $height_to = preg_replace("/[^0-9]/", "", $this->post['height_to']);
		
		$depth_min = $depth_from = $this->products->get_min('depth');
		if(!empty($this->post['depth_from'])) $depth_from = preg_replace("/[^0-9]/", "", $this->post['depth_from']);
		$depth_max = $depth_to = $this->products->get_max('depth');
		if(!empty($this->post['depth_to'])) $depth_to = preg_replace("/[^0-9]/", "", $this->post['depth_to']);
		
		//$this->session->sess_destroy("cart_contents");
		
		$data = array(
			'title' => "Каталог",
			'url' => base_url().uri_string()."?".get_filter_string($_SERVER['QUERY_STRING']),
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
			'filters_checked' => array(),
			'left_menu' => $this->categories->get_tree(),
			'manufacturer' => $this->manufacturer->get_tree(FALSE, $this->post),
			'sku_tree' => array(),
			'collection' => array(),
			'sku' => array(),
			'nok' => array(),
			'last_news' => $this->articles->prepare_list($this->articles->get_list(array("parent_id" => 1), 10, 0, "date", "asc")),
			'ajax_from' => ""
		);
	
		$this->standart_data = array_merge($this->standart_data, $data);
		
		$this->load->helper('url_helper');
	}
	
	public function index()
	{
		$this->breadcrumbs->add("catalog", "Каталог");
		
		if(isset($this->post['filter']))
		{
			 $this->filtred();
		}
		else
		{		
			$content = $this->url->catalog_url_parse(2);
			if($content == FALSE) redirect(base_url()."pages/page_404"); 
			
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
		$data['category'] = new stdClass;
		if($content <> "root")
		{
			$data = array(
				'title' => $content->name,
				'meta_keywords' => $content->meta_keywords,
				'meta_description' => $content->meta_description,
				'category' => $content
			);
		}

		$data['breadcrumbs'] = $this->breadcrumbs->get();
		
		// сортировка вывода
		$products = $this->products->prepare_list($this->products->get_list(FALSE, 0, 10, "sort", "asc"));
		
		$data['category']->products = $products;
		$data['total_rows'] = count($this->products->get_list(FALSE));
		$data['filters'] = $this->characteristics_type->get_filters($data['category']->products);
		$data = array_merge($this->standart_data, $data);
	
		$this->benchmark->mark('code_end');
		//my_dump($this->benchmark->elapsed_time('code_start', 'code_end'));
		$this->load->view("client/categories", $data);
	}
	
	/**
	* Вывод товаров по фильтру
	*/
	public function filtred()
	{	
		$cache_id = md5(serialize($this->post));
		
		$cache = $this->file_cache->get($cache_id);
		//$cache = FALSE;
		if($cache)
		{
			$data = $cache;
			$this->benchmark->mark('code_end');
		}
		else
		{	
			$products = $this->characteristics->get_products_by_filter($this->post, $this->get['order'], $this->get['direction']);
			$products_ids = $this->catalog->get_products_ids($products);
		
			$last_type_filter = $this->post['last_type_filter'];
			//wlt - without last type
			$filters_wlt = $this->post;
			if($last_type_filter == "shortname" || $last_type_filter == "shortdesc")
			{
				unset($filters_wlt['shortname']);
				unset($filters_wlt['shortdesc']);
			}
			else
			{
				unset($filters_wlt[$last_type_filter]);
			}
		
			$products_wlt =  $this->characteristics->get_products_by_filter($filters_wlt, $this->get['order'], $this->get['direction']);
		
			$products_ids_wlt = $this->catalog->get_products_ids($products_wlt);
		
			$products_for_content = $this->characteristics->get_products_by_filter($this->post, $this->get['order'], $this->get['direction'], 10, 0);
		
			$filters = $this->characteristics_type->get_filters($products, $this->post);
			$filters_2 = $this->characteristics_type->get_filters($products_wlt);
			if(isset($filters[$last_type_filter])) $filters[$last_type_filter] = $filters_2[$last_type_filter];

			$data = array(
				'breadcrumbs' => $this->breadcrumbs->get(),
				'filters_checked' => $this->post,
				'filters' => $filters,
				'total_rows' => count($products),
				'left_menu' => $last_type_filter == "categories_checked" ? $this->categories->get_tree($products_wlt) : $this->categories->get_tree($products, $this->post),
				'collection' => $last_type_filter == "collection_checked" ? $this->collections->get_tree($products_ids_wlt) : $this->collections->get_tree($products_ids, $this->post),
				'manufacturer' => $last_type_filter == "manufacturer_checked" ? $this->manufacturer->get_tree($products_wlt) : $this->manufacturer->get_tree($products, $this->post),
				'sku_tree' => $last_type_filter == "sku_checked" ? $this->manufacturer->get_tree($products_wlt) : $this->manufacturer->get_tree($products, $this->post),
				'categories_ch' => $this->catalog->get_filters_info($this->post, "categories", "categories_checked"),
				'manufacturer_ch' => $this->catalog->get_filters_info($this->post, "manufacturer", "manufacturer_checked"),
				'collections_ch' => $this->catalog->get_filters_info($this->post, "collections", "collection_checked"),
				'sku_ch' => $this->catalog->get_filters_info($this->post, "products", "sku_checked"),
				'shortname_ch' => $this->catalog->get_filters_info($this->post, "characteristics", "shortname"),
				'shortdesc_ch' => $this->catalog->get_filters_info($this->post, "characteristics", "shortdesc"),
				'color_ch' => $this->catalog->get_filters_info($this->post, "characteristics", "color"),
				'material_ch' => $this->catalog->get_filters_info($this->post, "characteristics", "material"),
				'finishing_ch' => $this->catalog->get_filters_info($this->post, "characteristics", "finishing"),
				'turn_ch' => $this->catalog->get_filters_info($this->post, "characteristics", "turn"),
				'ajax_from' => ""
			);
		
			if($last_type_filter == "shortname" || $last_type_filter == "shortdesc")
			{
				$data['nok'] = $this->catalog->get_nok_tree($products_ids_wlt);
			}
			else
			{
				$data['nok'] = $this->catalog->get_nok_tree($products_ids, $this->post);
			}
	
			$data = array_merge($this->standart_data, $data);
			
			$data['category'] = new stdClass;	
			$data['category']->products = $this->products->prepare_list($products_for_content);
			
			$this->file_cache->insert($cache_id, $data);
			$this->benchmark->mark('code_end');
		}
		//my_dump($this->benchmark->elapsed_time('code_start', 'code_end'));
		$this->load->view("client/categories", $data);
	}
	
	/**
	* Вывод страницы товара
	*
	* @param object $content
	*/
	private function product($content)
	{
		$new_products = $this->products->get_list(array("is_new" => 1), FALSE, 3);

		$this->session->unset_userdata("pre_cart");
		$data = array(
			'title' => $content->product->name,
			'meta_keywords' => $content->product->meta_keywords,
			'meta_description' => $content->product->meta_description,
			'breadcrumbs' => $this->breadcrumbs->get(),
			'product' => $this->products->prepare($content->product, FALSE, TRUE),
		);
		$data['title'] = $data['breadcrumbs'][count($data['breadcrumbs'])-1]['name'];

		$data['product']->recommended_products = $this->products->prepare_list($this->products->get_anchor($data['product']->id, "recommended"), TRUE);
		$data['product']->components_products = $this->products->prepare_list($this->products->get_anchor($data['product']->id, "components"), TRUE);
		$data['product']->accessories_products = $this->products->prepare_list($this->products->get_anchor($data['product']->id, "accessories"), TRUE);

		$data = array_merge($this->standart_data, $data);
		
		$this->load->view("client/product", $data);
	}
	
	public function count()
	{
		$products = $this->characteristics->get_products_by_filter($this->post, $this->get['order'], $this->get['direction']);
		echo count($products);
	}
	
	public function ajax_more()
	{
		$products = $this->characteristics->get_products_by_filter($this->post, $this->get['order'], $this->get['direction'], 10, $this->post['from']);

		$content = "";
		
		if($products) foreach($products as $item)
		{
			$product = array("item" => $this->products->prepare($item, TRUE, FALSE));
			$content.= $this->load->view('client/include/ajax_product.php', $product, TRUE);
		}

		$ajax_from = $this->post['from'] + 10;
		
		$data = array(
			"content" => $content,
			"ajax_from" => $ajax_from
		);
		
		echo json_encode($data);
	}
}

/* End of file catalog.php */
/* Location: ./application/controllers/catalog.php */