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
		
		$this->config->load('characteristics');
		
		$this->get = $this->input->get();
		$this->post = $this->input->post();

		if(!isset($this->get['order']))
		{
			$this->get['order'] = "sort";
			$this->get['direction'] = "asc";
		}

		$price_min = $price_from = $this->products->get_min('price');
		if(!empty($this->post['price_from'])) $price_min = preg_replace("/[^0-9]/", "", $this->post['price_from']);
		$price_max = $price_to = $this->products->get_max('price');
		if(!empty($this->post['price_to'])) $price_max = preg_replace("/[^0-9]/", "", $this->post['price_to']);

		$width_min = $width_from = $this->products->get_min('width');
		if(!empty($this->post['width_from'])) $width_min = preg_replace("/[^0-9]/", "", $this->post['width_from']);
		$width_max = $width_to = $this->products->get_max('width');
		if(!empty($this->post['width_to'])) $width_max = preg_replace("/[^0-9]/", "", $this->post['width_to']);
		
		$height_min = $height_from = $this->products->get_min('height');
		if(!empty($this->post['height_from'])) $height_min = preg_replace("/[^0-9]/", "", $this->post['height_from']);
		$height_max = $height_to = $this->products->get_max('height');
		if(!empty($this->post['height_to'])) $height_max = preg_replace("/[^0-9]/", "", $this->post['height_to']);
		
		$depth_min = $depth_from = $this->products->get_min('depth');
		if(!empty($this->post['depth_from'])) $depth_min = preg_replace("/[^0-9]/", "", $this->post['depth_from']);
		$depth_max = $depth_to = $this->products->get_max('depth');
		if(!empty($this->post['depth_to'])) $depth_max = preg_replace("/[^0-9]/", "", $this->post['depth_to']);
		
		$data = array(
			'title' => "Каталог",
			'select_item' => '',
			'tree' => $this->categories->get_tree(0, "category_parent_id"),
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
			'depth_max' => $depth_max, //Тут мне кажется я переборшил с 4-мя интервалами вроде должно хваттать и двух. 
			'filters_checked' => array(),
			'left_menu' => $this->categories->get_tree(0, "category_parent_id"),
			'manufacturer' => $this->manufacturer->get_tree(FALSE),
			'collection' => array(),
			'sku' => array(),
			'nok' => array(),
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
		$parent_id = 0;
		$data['category'] = new stdClass;
		if($content <> "root")
		{
			$parent_id = $content->id;

			$data = array(
				'title' => $content->name,
				'meta_keywords' => $content->meta_keywords,
				'meta_description' => $content->meta_description,
				'category' => $content
			);
		}
		
		$new_products = $this->products->get_list(array("is_new" => 1), FALSE, 3);
		$special = $this->products->get_list(array("is_special" => 1), FALSE, 3, $this->get['order'], $this->get['direction']);
		
		$data['special'] = $this->products->prepare_list($special);
		$data['new_products'] = $this->products->prepare_list($new_products);
		$data['breadcrumbs'] = $this->breadcrumbs->get();
		$data['category']->products = $this->products->prepare_list($this->products->get_list(FALSE));
		$data['total_rows'] = count($data['category']->products);
		$data['filters'] = $this->characteristics_type->get_filters($data['category']->products);
		$data = array_merge($this->standart_data, $data);
				
		$this->load->view("client/categories", $data);
	}
	
	/**
	* Вывод товаров по фильтру
	*/
	public function filtred()
	{	
		$products = $this->characteristics->get_products_by_filter($this->post, $this->get['order'], $this->get['direction']);
		$products_ids = $this->catalog->get_products_ids($products);
		
		$last_type_filter = $this->post['last_type_filter'];
		//wlt - without last type
		$filters_wlt = $this->post;
		
		unset($filters_wlt[$last_type_filter]);
		
		//var_dump($filters_wlt);
		//Костыление диапозонов
		$filters_wlt['price_from'] = $this->standart_data['price_from'];
		$filters_wlt['price_to'] = $this->standart_data['price_to'];
		$filters_wlt['width_from'] = $this->standart_data['width_from'];
		$filters_wlt['width_to'] = $this->standart_data['width_to'];
		$filters_wlt['height_from'] = $this->standart_data['height_from'];
		$filters_wlt['height_to'] = $this->standart_data['height_to'];
		$filters_wlt['depth_from'] = $this->standart_data['depth_from'];
		$filters_wlt['depth_to'] = $this->standart_data['depth_to'];

		$products_wlt =  $this->characteristics->get_products_by_filter($filters_wlt, $this->get['order'], $this->get['direction']);
		//var_dump($products);
		$products_ids_wlt = $this->catalog->get_products_ids($products_wlt);
		
		$filters = $this->characteristics_type->get_filters($products);
		$filters_2 = $this->characteristics_type->get_filters($products_wlt);
		if(isset($filters[$last_type_filter])) $filters[$last_type_filter] = $filters_2[$last_type_filter];
		
		$categories_ch = $this->catalog->get_filters_info($this->post, "categories", "categories_checked");
		$manufacturer_ch = $this->catalog->get_filters_info($this->post, "manufacturer", "manufacturer_checked");
		$collections_ch = $this->catalog->get_filters_info($this->post, "collections", "collection_checked");
		$sku_ch = $this->catalog->get_filters_info($this->post, "products", "sku_checked");
		$shortname_ch = $this->catalog->get_filters_info($this->post, "characteristics", "shortname");
		$color_ch = $this->catalog->get_filters_info($this->post, "characteristics", "color");
		$material_ch = $this->catalog->get_filters_info($this->post, "characteristics", "material");
		$finishing_ch = $this->catalog->get_filters_info($this->post, "characteristics", "finishing");
		$turn_ch = $this->catalog->get_filters_info($this->post, "characteristics", "turn");
		
		$data = array(
			'breadcrumbs' => $this->breadcrumbs->get(),
			'filters_checked' => $this->post,
			'filters' => $filters,
			'total_rows' => count($products),
			'price_from' => $this->catalog->get_min_for_filtred($products, "price"),
			'price_to' => $this->catalog->get_max_for_filtred($products, "price"),
			'price_min' => $this->catalog->get_min_for_filtred($products, "price"),
			'price_max' => $this->catalog->get_max_for_filtred($products, "price"),
			'width_from' => $this->catalog->get_min_for_filtred($products, "width"),
			'width_to' => $this->catalog->get_max_for_filtred($products, "width"),
			'width_min' => $this->catalog->get_min_for_filtred($products, "width"),
			'width_max' => $this->catalog->get_max_for_filtred($products, "width"),
			'height_from' => $this->catalog->get_min_for_filtred($products, "height"),
			'height_to' => $this->catalog->get_max_for_filtred($products, "height"),
			'height_min' => $this->catalog->get_min_for_filtred($products, "height"),
			'height_max' => $this->catalog->get_max_for_filtred($products, "height"),
			'depth_from' => $this->catalog->get_min_for_filtred($products, "depth"),
			'depth_to' => $this->catalog->get_max_for_filtred($products, "depth"),
			'depth_min' => $this->catalog->get_min_for_filtred($products, "depth"),
			'depth_max' => $this->catalog->get_max_for_filtred($products, "depth"),
			'collection' => $last_type_filter == "collections" ? $this->collections->get_tree($products_ids_wlt) : $this->collections->get_tree($products_ids),
			'manufacturer' => $last_type_filter == "manufacturer" ? $this->manufacturer->get_tree($products_wlt) : $this->manufacturer->get_tree($products),
			'categories_ch' => $categories_ch,
			'manufacturer_ch' => $manufacturer_ch,
			'collections_ch' => $collections_ch,
			'sku_ch' => $sku_ch,
			'shortname_ch' => $shortname_ch,
			'color_ch' => $color_ch,
			'material_ch' => $material_ch,
			'finishing_ch' => $finishing_ch,
			'turn_ch' => $turn_ch
		);
		
		if($last_type_filter == "shortname" || $last_type_filter == "shortdesc")
		{
			$data['nok'] = $this->catalog->get_nok_tree($products_ids_wlt);
		}
		else
		{
			$data['nok'] = $this->catalog->get_nok_tree($products_ids);
		}

		$data = array_merge($this->standart_data, $data);
		$data['category'] = new stdClass;
		$data['category']->products = $this->products->prepare_list($products);

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
		$data = array(
			'title' => $content->product->name,
			'meta_keywords' => $content->product->meta_keywords,
			'meta_description' => $content->product->meta_description,
			'breadcrumbs' => $this->breadcrumbs->get(),
			'product' => $this->products->prepare($content->product, FALSE),
			'new_products' => $this->products->prepare_list($new_products)
		);
		
		$data['product']->recommended_products = $this->products->prepare_list($this->products->get_recommended($data['product']->id));
		
		$data = array_merge($this->standart_data, $data);

		$this->load->view("client/product", $data);
	}
	
	public function count()
	{
		$products = $this->characteristics->get_products_by_filter($this->post, $this->get['order'], $this->get['direction']);
		echo count($products);
	}
}

/* End of file catalog.php */
/* Location: ./application/controllers/catalog.php */