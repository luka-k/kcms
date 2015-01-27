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
			'select_item' => "",
			'video' => $this->video->get_prepared_list($video),
			'settings' => $this->settings->get_item_by(array('id' => 1))
		);
		$data = array_merge($this->standart_data, $data);

		$this->load->view('client/video.php', $data);
	}	
}

/* End of file videos.php */
/* Location: ./application/controllers/videos.php */