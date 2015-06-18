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
		//my_dump($content);
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
		elseif($content == FALSE)
		{
			redirect(base_url()."pages/page_404");
		}
		else
		{
			isset($content->manufacturer) ? $this->manufacturer($content) : $this->by_category($content);
		}
	}
	
	public function by_category($content)
	{
		$data = array(
			'left_menu' => $this->categories->get_tree(),
			'last_news' => $this->articles->prepare_list($this->articles->get_list(array("parent_id" => 1), 10, 0, "date", "asc")),
			'breadcrumbs' => $this->breadcrumbs->get(),
			'page_title' => $content->category->name,
			'active_category' => $content->category->url
		);
		
		$manufacturers = $this->manufacturers->prepare_list($this->manufacturers->get_by_category($content->category));
			
		//my_dump($manufacturers);
		$data['manufacturers'] = $manufacturers;
		$data = array_merge($this->standart_data, $data);
		$this->load->view("client/catalog/manufacturer_by_category", $data);
	}
	
	public function manufacturer($content)
	{
		$manufacturer = $content->manufacturer;

		$documents = $this->documents->get_by_filter($content->manufacturer->id, $content->category, $content->doc_type['value']);
		if($content->doc_type)
		{
			$active_doc_type = $content->doc_type['title'];
		}
		else
		{
			$active_doc_type = "Каталоги";
		}
		
		$manufacturer->documents = $this->documents->prepare_list($documents);
		
		$data = array(
			'left_menu' => $this->categories->get_tree(),
			'last_news' => $this->articles->prepare_list($this->articles->get_list(array("parent_id" => 1), 10, 0, "date", "asc")),
			'manufacturers' => $this->manufacturers->prepare_list($this->manufacturers->get_list(FALSE)),
			'breadcrumbs' => $this->breadcrumbs->get(),
			'manufacturer' => $this->manufacturers->prepare_for_catalog($manufacturer),
			'doc_type' => $active_doc_type
		);
		
		$this->load->view("client/catalog/manufacturer", $data);
	}
}