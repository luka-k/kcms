<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Contractor class
*
* @package		kcms
* @subpackage	Controllers
* @category	    Contractor
*/
class Contractor extends Client_Controller {
	
	public function __construct()
	{
		parent::__construct();	
	}
	
	public function index($url)
	{
		$this->breadcrumbs->add(base_url()."podrjadchiki/", "Подрядчики");
		
		$contractor = $this->manufacturers->get_item_by(array("url" => $url));
		
		$this->breadcrumbs->add($contractor->url, $contractor->name);
		
		$data = array(
			'title' => 'обслуживание/ремонт сантехники от компании '.$contractor->name.' в Санкт-Петербурге | bрайтbилd',
			'meta_description' => 'Компания '.$contractor->name.' в Санкт-Петербурге производит обслуживание/ремонт сантехники. По всем вопросам обращайтесь к консультантам компании',
			'meta_keywords' => $contractor->name.' обслуживание/ремонт сантехники в Санкт-Петербурге.',
			'above_menu_title' => $contractor->name,
			'last_news' => $this->articles->prepare_list($this->articles->get_list(array('parent_id' => 1), 10, 0, 'date', 'asc')),
			'top_active' => 'contractors',
			'left_active_item' => '',
			'submenu_active_item' => '',
			'h1_title' => $contractor->name,
			'breadcrumbs' => $this->breadcrumbs->get(),
			'contractors' => $this->manufacturers->prepare_list($this->manufacturers->get_contractors()),
			'contractor' => $this->manufacturers->prepare_for_contractor($contractor)
		);
		
		$data['left_menu'] = $this->services->get_tree(0, 'parent_id');
		//my_dump($data['left_menu']);
		$data = array_merge($data, $this->standart_data);

		$this->load->view("client/catalog/contractor", $data);
	}
}