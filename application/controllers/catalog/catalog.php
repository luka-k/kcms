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
		$data = array(
			'left_menu' => $this->categories->get_tree(),
			'manufacturers' => $this->manufacturer->prepare_list($this->manufacturer->get_list(FALSE)),
			'last_news' => $this->articles->prepare_list($this->articles->get_list(array("parent_id" => 1), 10, 0, "date", "asc"))
		);
		//my_dump($data['left_menu']);
		$data = array_merge($this->standart_data, $data);
		
		$this->load->view("client/catalog/index", $data);
	}
}