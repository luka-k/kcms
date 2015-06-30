<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Podrjadchiki class
*
* @package		kcms
* @subpackage	Controllers
* @category	    Podrjadchiki
*/
class Podrjadchiki extends Client_Controller {
	
	public function __construct()
	{
		parent::__construct();	
	}
	
	public function index()
	{
		$this->breadcrumbs->add(base_url()."podrjadchiki/", "Подрядчики");
		
		$data = array(
			'title' => 'Брайтбилд — услуги по строительству и ремонту в интерьере дома.',
			'meta_description' => 'Подрядчики и услуги для строительства и ремонта в интерьере в Санкт-Петербурге.',
			'meta_keywords' => 'Услуги для строительства и ремонта, Брайтбилд, Брайтбилд',
			'left_menu' => $this->services->get_tree(0, 'parent_id'),
			'last_news' => $this->articles->prepare_list($this->articles->get_list(array('parent_id' => 1), 10, 0, 'date', 'asc')),
			'left_active_item' => "",
			'content_description' => 'Подрядчики для строительства, ремонта, производства, оказания услуг на сайте brightbuild'
		);
		
		$content = $this->url->contractors_url_parse(2);

		if($content == 'root')
		{
			$data['contractors'] = $this->manufacturers->prepare_list($this->manufacturers->get_contractors());

			$data = array_merge($this->standart_data, $data);
			$this->load->view("client/catalog/contractors", $data);
		}
		elseif($content == FALSE)
		{
			redirect(base_url().'pages/page_404');
		}
		elseif(isset($content->manufacturer))
		{
			$this->contractor($content->manufacturer->url, FALSE);
		}
		else
		{
			$name = $content->service->name;

			$data['title'] = $name.' - каталог компаний предоставляющие эти услуги в Санкт-Петербурге | bрайтbилd';
			$data['meta_description'] = 'На сайте bрайтbилd вы можете выбрать в каталоге услуг компанию, которая производит '.$name.' в Санкт-Петербурге.';
			$data['meta_keywords'] = $name.'Гарантийное/Сервисное обслуживание/ремонт в Санкт-Петербурге.';
			$data['above_menu_title'] = $name;
			$data['left_active_item'] = isset($content->parent_service) ? $content->parent_service->url : $content->service->url;
			$data['breadcrumbs'] = $this->breadcrumbs->get();
			$data['page_title'] = $content->service->name;
			$data['active_category'] = $content->service->url;
			
			$data['a_link'] = "";
			if(isset($content->parent_service)) $data['a_link'] .= $content->parent_service->url."/";
			$data['a_link'] .= $content->service->url."/";

			$data['contractors'] = $this->manufacturers->prepare_list($this->manufacturers->get_contractors($content->service));

			$data = array_merge($this->standart_data, $data);

			$this->load->view("client/catalog/contractors_by_category", $data);
		}
	}
	
	public function contractor($url, $action = TRUE)
	{
		if($action) $this->breadcrumbs->add(base_url()."podrjadchiki/", "Подрядчики");
		
		$contractor = $this->manufacturers->get_item_by(array("url" => $url));
		if($action) $this->breadcrumbs->add($contractor->url, $contractor->name);
		
		$data = array(
			'title' => $contractor->name.' Каталог фирмы '.$contractor->name.' | bрайтbилd',
			'meta_description' => '',
			'meta_keywords' => '',
			'above_menu_title' => $contractor->name,
			'left_menu' => $this->services->get_tree(0, 'parent_id'),
			'last_news' => $this->articles->prepare_list($this->articles->get_list(array('parent_id' => 1), 10, 0, 'date', 'asc')),
			'left_active_item' => "",
			'breadcrumbs' => $this->breadcrumbs->get(),
			'contractors' => $this->manufacturers->prepare_list($this->manufacturers->get_contractors()),
			'contractor' => $this->manufacturers->prepare_for_contractor($contractor)
		);
		
		
		$data = array_merge($data, $this->standart_data);

		$this->load->view("client/catalog/contractor", $data);
	}
}
	
	