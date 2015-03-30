<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Menus_items class
*
* @package		kcms
* @subpackage	Models
* @category	    Menus_items
*/
class Menus_items extends MY_Model
{
	public $editors = array(
		'Основное' => array(
			'id' => array('id', 'hidden'),
			'menu_id' => array('Меню', 'hidden'),
			'name' => array('Заголовок', 'text', 'trim|name', 'require'),
			'parent_id' => array('Родительский пункт меню', 'select'),
			'description' => array('Описание', 'text'),
			'item_type' => array('Тип пункта', 'type'),
			'url' => array('Ссылка', 'link')
		)
	);
	
	function __construct()
	{
        parent::__construct();
	}
	
	/**
	* Получение дерева элементов меню
	*
	* @param integer $menu_id
	* @param integer $parent_id
	* @return object
	*/
	public function menu_tree($menu_id, $parent_id = 0)
	{
		$branches = $this->get_list(array("menu_id" => $menu_id, "parent_id" => $parent_id), $from = FALSE, $limit = FALSE, $order = "sort", $direction = "asc");
		if ($branches) foreach ($branches as $i => $b)
		{
			if($menu_id == 1)
			{
				$b->url == "#" ? $branches[$i]->full_url = $b->url : $branches[$i]->full_url = base_url().$b->url;
			}
			else
			{
				if($b->item_type == "articles")
				{
					$branches[$i] = $this->prepare($b);
				}
				else
				{
					$url = explode ("://", $b->url, -1);
					empty($url) ? $branches[$i]->full_url = $this->get_url($b) : $branches[$i]->full_url = $b->url;
				}
			}

			$branches[$i]->childs = $this->menu_tree($menu_id, $b->id);
		}		
		return $branches;
	}
	
	/**
	* Получение url пункта меню
	*
	* @param object $item
	* @return string
	*/
	public function get_url($item)
	{
		$item_url = $this->make_full_url($item);
		$full_url = implode("/", array_reverse($item_url));
		$full_url = base_url().$full_url;
		return $full_url;		
	}
	
	/**
	* Формирование полного url пункта меню
	*
	* @param object $item
	* @return array
	*/
	public function make_full_url($item)
	{
		$item_url = array();
		if(!empty($item)) 
		{
			$item_url[] = $item->url;
		
			while($item->parent_id <> 0)
			{
				$parent_id = $item->parent_id;
				$item = $this->get_item($parent_id);
				$item_url[] = $item->url;
			}
			$item_url[] = 'articles';
		}
		return $item_url;
	}	
	
	/**
	* 
	*
	* @param object $item
	* @return object
	*/
	function prepare($item)
	{
		if(!empty($item)) $item->full_url = $this->get_url($item);
		return $item;
	}

}