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
			'page_title' => $this->standart_data['settings']->contractor_h1,
			'page_description' => htmlspecialchars_decode($this->standart_data['settings']->contractor_description),
			'left_menu' => $this->services->get_tree(0, 'parent_id'),
			'top_active' => 'catalog',
			'left_active_item' => '',
			'submenu_active_item' => '',
			'content_description' => ''
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
			$this->contractor($content);
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

			if(isset($content->parent_service)) $data['submenu_active_item'] = $content->service->url;
			
			$data['contractors'] = $this->manufacturers->prepare_list($this->manufacturers->get_contractors($content->service));

			$data = array_merge($this->standart_data, $data);

			$this->load->view("client/catalog/contractors_by_category", $data);
		}
	}
	
	public function contractor($content)
	{
		$contractor = $this->manufacturers->get_item_by(array("url" => $content->manufacturer->url));
		//$this->breadcrumbs->add($contractor->url, $contractor->name);
		
		$data = array(
			'title' => 'обслуживание/ремонт сантехники от компании '.$contractor->name.' в Санкт-Петербурге | bрайтbилd',
			'meta_description' => 'Компания '.$contractor->name.' в Санкт-Петербурге производит обслуживание/ремонт сантехники. По всем вопросам обращайтесь к консультантам компании',
			'meta_keywords' => $contractor->name.' обслуживание/ремонт сантехники в Санкт-Петербурге.',
			'above_menu_title' => $contractor->name,
			'top_active' => 'catalog',
			'left_active_item' => isset($content->parent_service) ? $content->parent_service->url : $content->service->url,
			'submenu_active_item' => isset($content->parent_service) ? $content->service->url : '',
			'breadcrumbs' => $this->breadcrumbs->get(),
			'contractors' => $this->manufacturers->prepare_list($this->manufacturers->get_contractors($content->service)),
			'contractor' => $this->manufacturers->prepare_for_contractor($contractor)
		);
		
		$data['left_menu'] = $this->services->get_tree(0, 'parent_id');
		
		$data['h1_title'] = '';
		if(isset($content->service)) $data['h1_title'] .= $content->service->name.' - ';
		$data['h1_title'] .= $contractor->name;
		
		$data = array_merge($data, $this->standart_data);

		$this->load->view("client/catalog/contractor", $data);
	}
}
	
	