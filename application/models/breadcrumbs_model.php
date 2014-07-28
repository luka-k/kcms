<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//Модель хлебные крошки
class Breadcrumbs_model extends CI_Model 
{
    function __construct()
	{
        parent::__construct();
	}
	
	public function bread($url)
	{
		$info = $this->categories->get_item_by(array('url' => $url));
		if ($info == NULL)
		{
			$info = $this->cat_pages->get_item_by(array('url' => $url));
			$breadcrumbs[$info->title] = base_url()."product/".$info->url;
			$parent = $info->cat_id;
		}
		else
		{
			$breadcrumbs[$info->title] = base_url()."catalog/".$info->url;
			$parent = $info->parent;		
		}

		if ($parent <> 0)
		{
			do 
			{
				$info = $this->categories->get_item_by(array('id' => $parent));
				$breadcrumbs[$info->title] = base_url()."catalog/".$info->url;
				$parent = $info->parent;
			}
			while ($parent <> 0);
		}
		
		$breadcrumbs['Каталог'] = base_url()."catalog";
		$breadcrumbs['Главная'] = base_url();
		return array_reverse($breadcrumbs);
	}
}