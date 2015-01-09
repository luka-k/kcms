<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//videos page controller

class Videos extends Client_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{		
		$top_menu = $this->dynamic_menus->get_menu(1);
		$video = $this->video->get_list(FALSE);
		$settings = $this->settings->get_item_by(array("id" => 1));
		
		$data = array(
			'title' => $settings->site_title."|Видео",
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
			'video' => $this->video->get_prepared_list($video),
			'settings' => $this->settings->get_item_by(array('id' => 1)),
			'filials' => $this->filials->get_list(FALSE)
		);

		$this->load->view('client/video.php', $data);
	}	
}

/* End of file videos.php */
/* Location: ./application/controllers/videos.php */