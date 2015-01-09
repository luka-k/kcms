<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//main page controller

class Index extends Client_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{		
		$settings = $this->settings->get_item_by(array('id' => 1));
		$slider = $this->slider->get_list(FALSE, FALSE, FALSE, "sort", "asc");
		
		$top_menu = $this->dynamic_menus->get_menu(1);
		
		$filters = $this->characteristics->get_filters();
		foreach($filters['use']->values as $item)
		{
			$catalog_by_filter[$item] = base_url()."catalog?filter=true&use=".str_replace(" ", "+", $item);
		}
		
		$good_buy = $this->products->get_list(array("is_good_buy" => 1), FALSE, 4);
		$new_products = $this->products->get_list(array("is_new" => 1), FALSE, 4);
		
		$news_sub = $this->articles->get_list(array("parent_id" => 1));
		foreach($news_sub as $level)
		{
			$sub_level_id[] = $level->id;
		}
		$this->db->where_in("parent_id", $sub_level_id);
		$this->db->limit(4);
		$query = $this->db->get("articles");
		$last_news = $query->result();
		
		foreach($last_news as $news_item)
		{
			$desc = strip_tags($news_item->description);
			$desc_arr = explode(' ', $desc);
			$desc = '';
			for ($i = 0; $i < 20 && $i < count($desc_arr); $i++)
			{
				$desc .= $desc_arr[$i].' ';
			}
			if ($i >= 19) $desc .= '...';
			$news_item->description = $desc;			
		}
		
		$video = $this->video->get_list(array("is_main" => 1));
		
		$settings = $this->settings->get_item_by(array("id" => 1));
		
		$data = array(
			'title' => $settings->site_title."|Главная",
			'meta_title' => $settings->site_title,
			'meta_keywords' => $settings->site_keywords,
			'meta_description' => $settings->site_description,
			'user' => $this->users->get_item_by(array("id" => $this->user_id)),
			'cart_items' => $this->cart_items,
			'total_price' => $this->total_price,
			'total_qty' => $this->total_qty,
			'product_word' => end_maker("товар", $this->total_qty),
			'top_menu' => $top_menu->items,
			'select_item' => "",
			'slider' => $this->slider->get_prepared_list($slider),
			'catalog_by_filter' => $catalog_by_filter,
			'good_buy' => $this->products->get_prepared_list($good_buy),
			'new_products' => $this->products->get_prepared_list($new_products),
			'last_news' => $this->articles->get_prepared_list($last_news),
			'video' => $this->video->get_prepared_list($video),
			'settings' => $settings,
			'filials' => $this->filials->get_list(FALSE)
		);

		$this->load->view('client/main.php', $data);
	}	
}

/* End of file index.php */
/* Location: ./application/controllers/index.php */