<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Inventory class
*
* @package		kcms
* @subpackage	Controllers
* @category	    Inventory
*/
class Inventory extends Client_Controller {
	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index($manufacturer_url = FALSE)
	{
		$data = array(
			'title' => "Складские остатки",
			'meta_description' => '',
			'meta_keywords' => '',
			'top_active' => 'inventory',
			'manufacturers' => $this->manufacturers->prepare_list($this->manufacturers->get_have_inventory()),
		);
		
		if($manufacturer_url)
		{
			$manufacturer = $this->manufacturers->get_item_by(array("url" => $manufacturer_url));
			$param = array("object_type" => "manufacturers", "object_id" => $manufacturer->id);
		}
		else
		{
			$param = array("object_type" => "manufacturers");
		}
		
		$data['inventories'] = $this->files->prepare_list($this->files->get_list($param, FALSE, FALSE, 'name', 'asc'));
		$data = array_merge($this->standart_data, $data);
		
		$this->load->view("client/catalog/inventory", $data);
	}
}