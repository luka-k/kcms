<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Главная страница

class Main extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{		
		$settings = $this->settings->get_item_by(array('id' => 1));
		$menu = $this->menus->top_menu;
		$menu = $this->menus->set_active($menu, 'main');
		$data = array(
			'title' => $settings->site_title,
			'meta_title' => $settings->site_title,
			'meta_keywords' => $settings->site_keywords,
			'meta_description' => $settings->site_description,
			'menu' => $menu,
			'works' => $this->works->get_list(FALSE),
			'partners' => $this->partners->get_list(FALSE)
		);
		$data['partners'] = $this->images->get_img_list($data['partners'], 'partners');
		foreach($data['works'] as $item)
		{
			$images = $this->images->get_images(array("object_id" => $item->id, "object_type" => "works"));
			foreach($images as $img)
			{
				$item->img[$img->image_type] = $img;
			}
			$item->word = end_maker('day', $item->time);
		}
		$this->load->view('client/index.php', $data);
	}	
}

/* End of file main.php */
/* Location: ./application/controllers/main.php */