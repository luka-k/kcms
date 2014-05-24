<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Client class

class Client extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url', 'translit', 'upload'));
		$this->load->model('temp_model');
		$this->load->model('menu_model');
	}
	
	public function index($url = false)
	{
		$data = $this->pages->get_item_by(array('url'=>$url));

		$temp[] = 'template.php';
		$this->temp_model->view_temp($temp, $data, 'client');
	}
	
	public function category($url = false)
	{
		$page = $this->categories->get_item_by(array('url'=>$url));
		var_dump ($page);
		$data = array(
			'page' => $page
		);
	}
	
	public function view_menu($menu_name)
	{
		$this->db->select('id');
		$query = $this->db->get_where('menus', array('name' => $menu_name));
		$id = $query->row_array();
		$menu_id = $id['id'];
		$query = $this->db->get_where('menus_data', array('menu_id' => $menu_id));
		$menu = $query->result_array();
		
		foreach ($menu as $menu_item)
		{
			if ($menu_item['item_type'] == 1)
			{
				$url = base_url()."page/".$menu_item['url'];

			}
			else if ($menu_item['item_type'] == 2)
			{
				$url = base_url()."category/".$menu_item['url'];
			}
			$menu_info[$menu_item['id']] = array(
				'title' => $menu_item['title'],
				'url' => $url
			);
		}
		$data['menu'] = $menu_info;
		$this->load->view('client/menu', $data);
	}
	
}

/* End of file pages.php */
/* Location: ./application/controllers/pages.php */