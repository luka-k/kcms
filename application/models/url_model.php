<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Url_model extends MY_Model
{	
    function __construct()
	{
        parent::__construct();
	}
	
	public function admin_url_parse()
	{
		$type = $this->uri->segment(2);
		$base = $this->uri->segment(3);
		$id = $this->uri->segment(4);

		if(($type == "item")and($base == "products"))
		{
			$item = $this->$base->get_item_by(array("id" => $id));
			$base = "categories";
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