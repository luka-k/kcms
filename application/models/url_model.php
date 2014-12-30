<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Url_model extends MY_Model
{	
    function __construct()
	{
        parent::__construct();
	}
	
	public function admin_url_parse()
	{
		$type = $this->uri->segment(3);
		$base = $this->uri->segment(4);
		$id = $this->uri->segment(5);
		if(($type == "item" || $type == "items")and($base == "products"))
		{
			$base = "categories";
			$item = $this->$base->get_item_by(array("id" => $id));
			$this->$base->add_active($id);
		}
		else
		{
			$item = $this->$base->get_item_by(array("id" => $id));
			$this->$base->add_active($id);
		}
		if (!empty($item))
		{
			$parent_id = $item->parent_id;
			while($parent_id <> 0)
			{
				$this->$base->add_active($item->parent_id);
				$item = $this->$base->get_item_by(array("id" => $parent_id));
				$this->$base->add_active($item->parent_id);
				$parent_id = $item->parent_id;
			}
			return TRUE;
		}	
		else
		{
			return TRUE;
		}	
	}
}