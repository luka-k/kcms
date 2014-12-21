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
	
	public function menu_tree($menu_id, $parent_id = 0)
	{
		$branches = $this->get_list(array("menu_id" => $menu_id, "parent_id" => $parent_id), $from = FALSE, $limit = FALSE, $order = "sort", $direction = "asc");
		if ($branches) foreach ($branches as $i => $b)
		{
			
			if($b->item_type == "articles")
			{
				$base = $b->item_type;
				$branches[$i] = $this->$base->prepare($b);
			}
			elseif($b->item_type == "link")
			{
				$branches[$i]->full_url = $b->url;
			}
			$branches[$i]->childs = $this->menu_tree($menu_id, $b->id);
		}		
		return $branches;
	}

}