<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Pages class
*
* @package		kcms
* @subpackage	Controllers
* @category	    Pages
*/
class Pages extends Client_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$this->breadcrumbs->add(base_url(), "Главная");
		$page = $this->url->url_parse(2);

		$root = $this->articles->get_item_by(array("url" => $this->uri->segment(2)));
		
		if($page == FALSE) redirect(base_url()."pages/page_404");

		$selected_manufacturer = "";
		if(isset($page->article))
		{
			$sub_template = "single-news";
			$template = $root->id == 1 ? "client/news.php" : "client/article.php";
			$page->articles = $this->articles->prepare_list($this->articles->get_list(array("parent_id" => 1, "manufacturer_id" => $page->manufacturer_id), 10, 0, "date", "desc"));
			$content = $page;
		}		
		elseif(isset($page->articles))
		{
			$sub_template = "news";
			$template = $root->id == 1 ? "client/news.php" : "client/articles.php";
			
			$content = $page;
			$content->articles = $this->articles->prepare_list($content->articles);
			
			$manufacturer_id = $this->input->get('m_id');
			
			if(!empty($manufacturer_id))
			{
				$selected_news = array();
				foreach ($content->articles as $item)
				{
					if($item->manufacturer_id == $manufacturer_id) $selected_news[] = $item;
				}
				
				//$selected_manufacturer = $this->manufacturers->prepare($this->manufacturer->get_item($manufacturer_id));
				$content->articles = $selected_news;
			}
		}
		
		$price_min = $price_from = $this->products->get_min('price');
		if(!empty($this->post['price_from'])) $price_from = preg_replace("/[^0-9]/", "", $this->post['price_from']);
		$price_max = $price_to = $this->products->get_max('price');
		if(!empty($this->post['price_to'])) $price_to = preg_replace("/[^0-9]/", "", $this->post['price_to']);

		$width_min = $width_from = $this->products->get_min('width');
		if(!empty($this->post['width_from'])) $width_from = preg_replace("/[^0-9]/", "", $this->post['width_from']);
		$width_max = $width_to = $this->products->get_max('width');
		if(!empty($this->post['width_to'])) $width_to = preg_replace("/[^0-9]/", "", $this->post['width_to']);
		
		$height_min = $height_from = $this->products->get_min('height');
		if(!empty($this->post['height_from'])) $height_from = preg_replace("/[^0-9]/", "", $this->post['height_from']);
		$height_max = $height_to = $this->products->get_max('height');
		if(!empty($this->post['height_to'])) $height_to = preg_replace("/[^0-9]/", "", $this->post['height_to']);
		
		$depth_min = $depth_from = $this->products->get_min('depth');
		if(!empty($this->post['depth_from'])) $depth_from = preg_replace("/[^0-9]/", "", $this->post['depth_from']);
		$depth_max = $depth_to = $this->products->get_max('depth');
		if(!empty($this->post['depth_to'])) $depth_to = preg_replace("/[^0-9]/", "", $this->post['depth_to']);//Костыли.Наведу порядок в шаблонах магазина уберу
	
		$data = array(
			'title' => $content->name,
			'top_active' => 'articles',
			'meta_keywords' => $content->meta_keywords,
			'meta_description' => $content->meta_description,
			'breadcrumbs' => $this->breadcrumbs->get(),
			//'tree' => $this->categories->get_tree(0, "parent_id"),
			'select_item' => "",
			'content' => $content,
			'manufacturers' => $this->manufacturers->prepare_list($this->manufacturers->get_list(FALSE)),
			'manufacturers_with_news' => $this->manufacturers->prepare_list($this->manufacturers->get_manufacturers_with_news()),
			//'selected_manufacturer' => $selected_manufacturer,
			'sub_template' => $sub_template,
			'price_from' => $price_from,
			'price_to' => $price_to,
			'price_min' => $price_min,
			'price_max' => $price_max,
			'width_from' => $width_from,
			'width_to' => $width_to,
			'width_min' => $width_min,
			'width_max' => $width_max,
			'height_from' => $height_from,
			'height_to' => $height_to,
			'height_min' => $height_min,
			'height_max' => $height_max,
			'depth_from' => $depth_from,
			'depth_to' => $depth_to,
			'depth_min' => $depth_min,
			'depth_max' => $depth_max,
		);

		$data = array_merge($this->standart_data, $data);
		$this->load->view($template, $data);
	}
		
	/**
	* Страница 404
	*/
	public function page_404()
	{
		header("HTTP/1.0 404 Not Found");
		$settings = $this->settings->get_item_by(array("id" => 1));
		$data = array(
			'title' => 'Страница не найдена',
			'above_menu_title' => 'Страница не найдена',
			'select_item' => "",
			'settings' => $this->settings->get_item_by(array('id' => 1)),
		);
		
		$data = array_merge($this->standart_data, $data);
		
		$this->load->view("client/404", $data);
	}
}