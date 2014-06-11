<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu_model extends CI_Model {

    function __construct()
	{
        parent::__construct();
	}
	
	public function menu($menu_name)
	{
		$menu = $this->menus->get_item_by(array('name' => $menu_name));
		$id = $menu->id;
		$menu = $this->menus_data->get_list(array('menu_id' => $id));
		
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
		return $menu_info;
	}

}

/* End of file menu_model.php */
/* Location: ./application/models/menu_model.php */