<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Client class

/*class Client extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url', 'translit', 'upload'));
	}
	
	public function index($url = false)
	{
		$data['page'] = $this->pages->get_item_by(array('url'=>$url));
		$data['menu'] = $this->menu_model->menu('top_menu');
		$this->load->view('client/template.php', $data);
	}
	
	public function category($url = false)
	{
		$cat_info = $this->categories->get_item_by(array('url'=>$url));
		$pages = $this->pages->get_list(array('cat_id'=>$cat_info->id));
		$data = array(
			'cat_info' => $cat_info,
			'pages' => $pages,
			'menu' => $this->menu_model->menu('top_menu')
		);
		$this->load->view('client/category.php', $data);
	}
	
	
		
}

/* End of file pages.php */
/* Location: ./application/controllers/pages.php */