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
	
	public function index($url, $doc_type = FALSE)
	{
		$manufacturer = $this->manufacturers->get_item_by(array("url" => $url));
		
		$documents = $doc_type ? $this->documents->get_by_type($manufacturer->id, $doc_type) : $this->documents->get_list(array("manufacturer_id" => $manufacturer->id));
		$manufacturer->documents = $this->documents->prepare_list($documents);

		$data = array(
			'left_menu' => $this->categories->get_tree(),
			'last_news' => $this->articles->prepare_list($this->articles->get_list(array("parent_id" => 1), 10, 0, "date", "asc")),
			'manufacturers' => $this->manufacturers->prepare_list($this->manufacturers->get_list(FALSE)),
			'breadcrumbs' => $this->breadcrumbs->get(),
			'manufacturer' => $this->manufacturers->prepare_for_catalog($manufacturer),
			'doc_type' => "Каталоги"
		);
		
		//my_dump($data['manufacturer']);
		$data = array_merge($data, $this->standart_data);
		$this->load->view("client/catalog/manufacturer", $data);
	}
}