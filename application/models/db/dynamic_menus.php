<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dynamic_menus extends MY_Model
{
	public $editors = array(
		'Основное' => array(
			'id' => array('id', 'hidden', ''),
			'name' => array('Заголовок', 'text', 'trim|required|htmlspecialchars|name'),
			'description' => array('Описание', 'text', 'trim|htmlspecialchars'),
			//'upload_image' => array('Загрузить изображение', 'image', 'img')
		)
	);
	
	public function get_menu($id)
	{
		$menu = new stdClass();
		$menu->info = $this->get_item_by(array("id" => $id));
		
		$menu->items = $this->menus_items->menu_tree($id);
		
		foreach($menu->items as $key => $item)
		{
			$base = $item->item_type;
			$item = $this->$base->prepare($item);
		}
		return $menu;
	}
}