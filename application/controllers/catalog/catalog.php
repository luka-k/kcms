<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Catalog class
*
* @package		kcms
* @subpackage	Controllers
* @category	    Catalog
*/
class Catalog extends Client_Controller {
	
	public function __construct()
	{
		parent::__construct();	
	}
	
	public function index()
	{
		$this->breadcrumbs->add(base_url()."catalog/", "Производители");
		$content = $this->url->catalog_url_parse(2);

		$data = array(
			'title' => 'Брайтбилд - крупный строительный портал. Все производители и продавцы товаров и услуг для строительства, ремонта и интерьера',
			'meta_description' => 'Строительный портал Брайтбилд. Вся актуальная информация о производителях и поставщиках в области строительства, ремонта и создания интерьера',
			'meta_keywords' => '',
			'page_title' => $this->standart_data['settings']->catalog_h1,
			'page_description' => htmlspecialchars_decode($this->standart_data['settings']->catalog_description),
			'left_menu' => $this->categories->get_tree(),
			'last_news' => $this->articles->prepare_list($this->articles->get_list(array('parent_id' => 1), 10, 0, 'date', 'asc')),
			'top_active' => 'catalog',
			'left_active_item' => '',
			'submenu_active_item' => '',
		);
		
		if($content == 'root')
		{
			$data['manufacturers'] = $this->manufacturers->prepare_list($this->manufacturers->get_list(FALSE, FALSE, FALSE, 'name', 'asc'));
			$data['breadcrumbs'] = $this->breadcrumbs->get();
			$data = array_merge($this->standart_data, $data);
			$this->load->view("client/catalog/index", $data);
		}
		elseif($content == FALSE)
		{
			redirect(base_url().'pages/page_404');
		}
		else
		{
			isset($content->manufacturer) ? $this->manufacturer($content) : $this->by_category($content);
		}
	}
	
	public function by_category($content)
	{
		$name = $content->category->name;
		$genitive_name = $content->category->genitive_name;
		$data = array(
			'title' => $this->string_edit->my_ucfirst($name).' - каталог производителей. Купить '.mb_strtolower($name, 'UTF-8').' в магазине в Санкт-Петербурге на заказ | Брайтбилд',
			'meta_description' => 'На сайте Брайтбилд вы можете ознакомиться с каталогом производителей '.$genitive_name.' и выбрать подходящий дизайн, подходящий к вашему интерьеру. '.$name.' - дизайн, интерьер, фото. Купить '.$name.' в магазине в Санкт-Петербурге.',
			'meta_keywords' => $name.' купить в Санкт-Петербурге, '.$name.' фото, '.$name.' дизайн, '.$name.' каталог, '.$name.' производители, '.$name.' интерьер, '.$name.' на заказ.',
			'above_menu_title' => $content->category->name,
			'left_menu' => $this->categories->get_tree(),
			'top_active' => 'catalog',
			'left_active_item' => isset($content->parent_category) ? $content->parent_category->url : $content->category->url,
			'submenu_active_item' => '',
			'last_news' => $this->articles->prepare_list($this->articles->get_list(array('parent_id' => 1), 10, 0, 'date', 'asc')),
			'breadcrumbs' => $this->breadcrumbs->get(),
			'page_title' => $content->category->name,
			'active_category' => $content->category->url
		);
		
		if(isset($content->parent_category)) $data['submenu_active_item'] = $content->category->url;
		
		$data['a_link'] = "";
		if(isset($content->parent_category)) $data['a_link'] .= $content->parent_category->url."/";
		$data['a_link'] .= $content->category->url;
		
		$data['shop_link_title'] = ': ';
		if(isset($content->parent_category)) $data['shop_link_title'] .= $content->parent_category->name." - ";
		$data['shop_link_title'] .= $content->category->name;
		
		$data['shop_link'] = '';
		if(isset($content->parent_category)) $data['shop_link'] .= $content->parent_category->url."/";
		$data['shop_link'] .= $content->category->url.'/';

		$manufacturers = $this->manufacturers->prepare_list($this->manufacturers->get_by_category($content->category));

		$data['manufacturers'] = $manufacturers;
		$data = array_merge($this->standart_data, $data);
		$this->load->view("client/catalog/manufacturer_by_category", $data);
	}
	
	public function manufacturer($content)
	{
		$manufacturer = $content->manufacturer;

		$documents = $this->documents->get_by_filter($content->manufacturer->id, $content->category, $content->doc_type['value']);

		$active_doc_type = $content->doc_type['title'];
		
		$manufacturer->documents = $this->documents->prepare_list($documents);
		
		$this->breadcrumbs->add("", $active_doc_type);
		
		$menu_link = "catalog/";
		if(isset($content->parent_category)) $menu_link = $menu_link.$content->parent_category->url."/";
		$menu_link = $menu_link.$content->category->url;

		$data = array(
			'title' => $this->string_edit->my_ucfirst($content->category->name).' '.$manufacturer->name.' производство '.$manufacturer->country.'. Каталог '.$content->category->genitive_name.' фирмы '.$manufacturer->name.' - продажа в магазинах Санкт-Петербурга | Брайтбилд',
			'meta_description' => $this->string_edit->my_ucfirst($content->category->name).' от производителя '.$manufacturer->name.' производство '.$manufacturer->country.'. Онлайн каталог с официального сайта фирмы '.$manufacturer->name.'. '.$this->string_edit->my_ucfirst($content->category->name).' фирмы '.$manufacturer->name.' станет прекрасным дополнением к интерьеру Вашего дома. Купить '.$content->category->name.' в Санкт-Петербурге',
			'meta_keywords'  => $content->category->name.' от '.$manufacturer->name.',  '.$content->category->name.' '.$manufacturer->name.' продажа в Санкт-Петербурге',
			'shop_link' => 'huy',
			'above_menu_title' => $manufacturer->name,
			'left_menu' => $this->categories->get_tree(),
			'top_active' => 'catalog',
			'left_active_item' => isset($content->parent_category) ? $content->parent_category->url : $content->category->url,
			'submenu_active_item' => '',
			'last_news' => $this->articles->prepare_list($this->articles->get_list(array("parent_id" => 1), 10, 0, "date", "asc")),
			'manufacturers' => $this->manufacturers->prepare_list($this->manufacturers->get_by_category($content->category)),
			'breadcrumbs' => $this->breadcrumbs->get(),
			'manufacturer' => $this->manufacturers->prepare_for_catalog($manufacturer),
			'active_category' => $content->category,
			'doc_type' => $active_doc_type,
			'active_doc' => $content->doc_type['value'],
			'is_news' => FALSE,
			'menu_link' => $menu_link
		);
		
		if(isset($content->parent_category)) $data['submenu_active_item'] = $content->category->url;
		
		$data['shop_link_title'] = ': ';
		if(isset($content->parent_category)) $data['shop_link_title'] .= $content->parent_category->name." - ";
		$data['shop_link_title'] .= $content->category->name.' - ';
		$data['shop_link_title'] .= $manufacturer->name;
		
		$data['shop_link'] = '';
		if(isset($content->parent_category)) $data['shop_link'] .= $content->parent_category->url."/";
		$data['shop_link'] .= $content->category->url.'/';
		$data['shop_link'] .= $manufacturer->url;
		
		$news_count = $this->articles->get_count(array('manufacturer_id' => $manufacturer->id));
		if($news_count > 0) $data['is_news'] = TRUE;
				
		$this->load->view("client/catalog/manufacturer", $data);
	}
}