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
		$this->breadcrumbs->add("catalog", "Каталог");
		$content = $this->url->catalog_url_parse(2);

		$data = array(
			'left_menu' => $this->categories->get_tree(),
			'last_news' => $this->articles->prepare_list($this->articles->get_list(array("parent_id" => 1), 10, 0, "date", "asc"))
		);
		
		//my_dump();
		if($content == "root")
		{
			$data['manufacturers'] = $this->manufacturers->prepare_list($this->manufacturers->get_list(FALSE));
			$data['breadcrumbs'] = $this->breadcrumbs->get();
			$data = array_merge($this->standart_data, $data);
			$this->load->view("client/catalog/index", $data);
		}
		else
		{
			$data['page_title'] = $content->name;
			$data['breadcrumbs'] = $this->breadcrumbs->get();
			$data['active_category'] = $content->url;
	
			$manufacturers = $this->manufacturers->prepare_list($this->manufacturers->get_by_category($content));
			
			//my_dump($manufacturers);
			$data['manufacturers'] = $manufacturers;
			$data = array_merge($this->standart_data, $data);
			$this->load->view("client/catalog/manufacturer_by_category", $data);
		}
	}
}