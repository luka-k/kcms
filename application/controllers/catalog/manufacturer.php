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
		$this->breadcrumbs->add(base_url(), "Производители");
		$manufacturer = $this->manufacturers->get_item_by(array("url" => $url));
		
		$this->breadcrumbs->add("manufacturer/".$manufacturer->url, $manufacturer->name);
		
		$documents = $this->documents->get_by_filter($manufacturer->id, FALSE, $doc_type);

		$this->config->load('types');
		$doc_types = $this->config->item('doc_type');
		$active_doc_type = $doc_types[$doc_type];

		$this->breadcrumbs->add("", $active_doc_type);
		
		$manufacturer->documents = $this->documents->prepare_list($documents);

		$data = array(
			'left_menu' => $this->categories->get_tree(),
			'last_news' => $this->articles->prepare_list($this->articles->get_list(array("parent_id" => 1), 10, 0, "date", "asc")),
			'manufacturers' => $this->manufacturers->prepare_list($this->manufacturers->get_list(FALSE)),
			'breadcrumbs' => $this->breadcrumbs->get("catalog"),
			'manufacturer' => $this->manufacturers->prepare_for_catalog($manufacturer),
			'doc_type' => $active_doc_type,
			'menu_link' => "manufacturer"
		);
		
		$data = array_merge($data, $this->standart_data);
		$this->load->view("client/catalog/manufacturer", $data);
	}
}