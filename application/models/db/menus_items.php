<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menus_items extends MY_Model
{
	public $editors = array(
		'Основное' => array(
			'id' => array('id', 'hidden', ''),
			'menu_id' => array('Меню', 'hidden', ''),
			'name' => array('Заголовок', 'text', 'trim|required|htmlspecialchars|name'),
			'parent_id' => array('Родительский пункт меню', 'select', ''),
			'description' => array('Описание', 'text', ''),
			'item_type' => array('Тип пункта', 'type', ''),
			'url' => array('Ссылка', 'link', '')//,
			//'upload_image' => array('Загрузить изображение', 'image', 'img')
		)
	);
	
	function __construct()
	{
        parent::__construct();
	}
	
	public function menu_tree($menu_id, $parent_id = 0)
	{
		$branches = $this->get_list(array("menu_id" => $menu_id, "parent_id" => $parent_id), $from = FALSE, $limit = FALSE, $order = "sort", $direction = "asc");
		if ($branches) foreach ($branches as $i => $b)
		{
			$branches[$i]->childs = $this->menu_tree($menu_id, $b->id);
		}		
		return $branches;
	}
	
		public function menu_tree($menu_id, $parent_id = 0)
	{
		$branches = $this->get_list(array("menu_id" => $menu_id, "parent_id" => $parent_id), $from = FALSE, $limit = FALSE, $order = "sort", $direction = "asc");
		if ($branches) foreach ($branches as $i => $b)
		{
			$url = explode ("://", $b->url, -1);
			empty($url) ? $branches[$i] = $this->prepare($b) : $branches[$i]->full_url = $b->url;

			$branches[$i]->childs = $this->menu_tree($menu_id, $b->id);
		}		
		return $branches;
	}
	
	public function get_url($item)
	{
		$item_url = $this->make_full_url($item);
		$full_url = implode("/", array_reverse($item_url));
		$full_url = base_url().$full_url;
		return $full_url;		
	}
	
	public function make_full_url($item)
	{
		$item_url = array();
		if(!empty($item)) 
		{
			$item_url[] = $item->url;
		
			while($item->parent_id <> 0)
			{
				$parent_id = $item->parent_id;
				$item = $this->get_item_by(array("id" => $parent_id));
				$item_url[] = $item->url;
			}
			$item_url[] = 'articles';
		}
		return $item_url;
	}	
	
	function prepare($item)
	{
		if(!empty($item)) $item->full_url = $this->get_url($item);
		return $item;
	}

}