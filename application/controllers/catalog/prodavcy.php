<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Prodavcy class
*
* @package		kcms
* @subpackage	Controllers
* @category	    Prodavcy
*/
class Prodavcy extends Client_Controller {
	
	public function __construct()
	{
		parent::__construct();	
	}
	
	public function index()
	{
		$this->breadcrumbs->add(base_url()."prodavcy/", "Продавцы");
		
		$data = array(
			'title' => 'Брайтбилд — продавцы товаров для строительства и ремонта интерьера.',
			'meta_description' => 'Продавцы товаров для строительства и ремонта в Санкт-Петербурге.',
			'meta_keywords' => 'Товары и услуги для строительства, Брайтбилд, Брайтбилд',
			'left_menu' => $this->categories->get_tree(),
			'last_news' => $this->articles->prepare_list($this->articles->get_list(array('parent_id' => 1), 10, 0, 'date', 'asc')),
			'left_active_item' => ""
		);
		
		$content = $this->url->catalog_url_parse(2);

		if($content == 'root')
		{
			
			$data['vendors'] = $this->manufacturers->prepare_list($this->manufacturers->get_vendors());

			$data = array_merge($this->standart_data, $data);
			$this->load->view("client/catalog/vendors", $data);
		}
		elseif($content == FALSE)
		{
			redirect(base_url().'pages/page_404');
		}
		else
		{
			$name = $content->category->name;
			$genitive_name = $content->category->genitive_name;
			
			$data['title'] = 'Продавцы '.$name.' - каталог  компаний предоставляющих эти товары в Санкт-Петербурге | bрайтbилd';
			$data['meta_description'] = 'На сайте bрайтbилd вы можете выбрать в каталоге продавцов компанию, которая предоставляет '.$name.' в Санкт-Петербурге.';
			$data['meta_keywords'] = 'продавцы '.$name.' в Санкт-Петербурге.';
			$data['above_menu_title'] = $content->category->name;
			$data['left_active_item'] = isset($content->parent_category) ? $content->parent_category->url : $content->category->url;
			$data['breadcrumbs'] = $this->breadcrumbs->get();
			$data['page_title'] = $content->category->name;
			$data['active_category'] = $content->category->url;
			
			$data['vendors'] = $this->manufacturers->prepare_list($this->manufacturers->get_vendors($content->category->id));

			$data = array_merge($this->standart_data, $data);
			$this->load->view("client/catalog/vendors_by_category", $data);
		}
	}
}