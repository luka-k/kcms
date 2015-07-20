<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Index class
*
* @package		kcms
* @subpackage	Controllers
* @category	    Index
*/
class Index extends Client_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{		
		$this->breadcrumbs->add(base_url()."catalog/", "Производители");
		
		$data = array(
			'title' => 'Брайтбилд - крупный строительный портал. Все производители и продавцы товаров и услуг для строительства, ремонта и интерьера',
			'meta_description' => 'Строительный портал Брайтбилд. Вся актуальная информация о производителях и поставщиках в области строительства, ремонта и создания интерьера',
			'meta_keywords' => '',
			'page_title' => $this->standart_data['settings']->catalog_h1,
			'page_description' => htmlspecialchars_decode($this->standart_data['settings']->catalog_description),
			'left_menu' => $this->categories->get_another_tree(),
			'top_active' => 'catalog',
			'left_active_item' => '',
			'submenu_active_item' => '',
			'manufacturers' => $this->manufacturers->prepare_list($this->manufacturers->get_manufacturers()),
			'breadcrumbs' => $this->breadcrumbs->get()
		);

		$data = array_merge($this->standart_data, $data);
		
		$this->load->view("client/catalog/index", $data);
	}	
}

/* End of file Index.php */
/* Location: ./application/controllers/catalog/index.php */