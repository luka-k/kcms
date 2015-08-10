<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Manufacturer class
*
* @package		kcms
* @subpackage	Controllers
* @category	    Manufacturer
*/
class Manufacturer extends Client_Controller {
	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index($url, $doc_type = "catalogs")
	{
		if($this->uri->segment(3) == 'catalogs') redirect(base_url().'manufacturer/'.$url);
		$this->breadcrumbs->add(base_url(), "Производители");
		$manufacturer = $this->manufacturers->get_item_by(array("url" => $url));
		
		$this->breadcrumbs->add("manufacturer/".$manufacturer->url, $manufacturer->name);
		
		$documents = $this->documents->get_by_filter($manufacturer->id, FALSE, $doc_type);

		$this->config->load('types');
		$doc_types = $this->config->item('doc_type');
		$active_doc_type = $doc_types[$doc_type];

		$this->breadcrumbs->add("", $active_doc_type);
		
		$manufacturer->documents = $this->documents->prepare_list($documents);
		
		$shop_link_title = ': '.$manufacturer->name;

		$data = array(
			'title' => 'Каталоги от производителя '.$manufacturer->name.' | Брайтбилд',
			'meta_description' => 'Каталоги  от производителя '.$manufacturer->name.' производство '.$manufacturer->country.'. По всем вопросам обращайтесь к сотрудникам компании Брайтбилд в Санкт-Петербурге.',
			'meta_keywords'  => 'каталоги '.$manufacturer->name.' продажа в Спб, каталог '.$manufacturer->name,
			'shop_link_title' => $shop_link_title,
			'shop_link' => $manufacturer->url,
			'above_menu_title' => $manufacturer->name,
			'left_menu' => $this->categories->get_another_tree(),
			'top_active' => 'catalog',
			'left_active_item' => '',
			'submenu_active_item' => '',
			'manufacturers' => $this->manufacturers->prepare_list($this->manufacturers->get_manufacturers()),
			'breadcrumbs' => $this->breadcrumbs->get("catalog"),
			'manufacturer' => $this->manufacturers->prepare_for_catalog($manufacturer),
			'doc_type' => $active_doc_type,
			'active_category_item' => '',
			'active_doc' => $doc_type,
			'is_news' => FALSE,
			'menu_link' => "manufacturer",
			'doc_link' => $doc_type
		);
		
		$news_count = $this->articles->get_count(array('manufacturer_id' => $manufacturer->id));
		if($news_count > 0) $data['is_news'] = TRUE;
		
		$data = array_merge($this->standart_data, $data);

		$this->load->view("client/catalog/manufacturer", $data);
	}
}