<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Menu{

	public function __construct()
	{
		$this->CI =& get_instance();
	}

	public function view($menu_name)
	{
		$menu = $this->CI->menus->get_item_by(array('name' => $menu_name));
		$id = $menu->id;
		$menu = $this->CI->menus_data->get_list(array('menu_id' => $id));
		
		foreach ($menu as $menu_item)
		{
			if ($menu_item->item_type == 1)
			{
				$url = base_url()."page/".$menu_item->url;

			}
			else if ($menu_item->item_type == 2)
			{
				$url = base_url()."category/".$menu_item->url;
			}
			$menu_info[$menu_item->id] = array(
				'title' => $menu_item->title,
				'url' => $url
			);
		}
		$data['menu'] = $menu_info;
		$this->CI->load->view('client/menu', $data);
	}
	
	
}

/* End of file Menu.php */