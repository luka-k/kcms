<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Characteristics class
*
* @package		kcms
* @subpackage	Models
* @category	    Characteristics
*/
class Characteristics extends MY_Model
{
	function __construct()
	{
        parent::__construct();
	}
	
	/**
	* Получение продуктов по фильтру
	*
	* @param array $filter
	* @param string $order
	* @param string $direction
	* @param integer $limit
	* @param integer $from
	* @return array
	*/
	function get_products_by_filter($filter, $order, $direction, $limit = FALSE, $from = FALSE)
	{
		$values = array();
		$id = array();
		$counter = 0;
		$filters_type = $this->characteristics_type->get_list(FALSE);
		
		$ff = array();
		if(isset($filter["shortdesc"]))
		{
			foreach($filter["shortdesc"] as $shortdesc)
			{
				$sd = explode ("/", $shortdesc);
	 			
				$this->db->where("type", "shortname");
				$this->db->where("value", $sd[0]);
				$this->db->select('object_id');
				$results = $this->db->get('characteristics')->result();
				
				$object_ids = array();
				if(!empty($results))foreach($results as $r)
				{
					$object_ids[] = $r->object_id;
				}	

				$this->db->where("type", "shortdesc");
				$this->db->where("value", $sd[1]);
				$this->db->where_in("object_id", $object_ids);
				$result = $this->db->get('characteristics')->result();

				if(!empty($result))foreach($result as $r)
				{
					$values[] = $r->object_id;
					$ff[] = $r->object_id;
				}
			}

		}

		if(isset($filter["shortname"]))
		{
			$this->db->where("type", "shortname");
			$this->db->where_in("value", $filter["shortname"]);
			$this->db->select('object_id');
			$result = $this->db->get('characteristics')->result();
			if($result) foreach($result as $r)
			{
				if(!in_array($r->object_id, $ff))$values[] = $r->object_id;
			}
			++$counter;
		}
		
		foreach($filters_type as $f)
		{
			if($f->url <> "shortname" && $f->url <> "shortdesc")
			{
				if(isset($filter[$f->url]))
				{
					$this->db->distinct();
					$this->db->where("type", $f->url);
					$this->db->where_in("value", $filter[$f->url]);
					$values = $this->_update_values($values);
					++$counter;
				}
			}
		}

		if($counter > 1)
		{
			$values = array_count_values($values);
			foreach($values as $key => $counter_value)
			{
				if($counter_value == $counter) $id[] = $key;
			}
		}
		else
		{
			$id = $values;
		}

		if(!empty($id) || (empty($id) && $counter == 0))
		{
			if(isset($filter['collection_checked']))
			{
				$this->db->where_in("collection_parent_id", $filter['collection_checked']);
				$this->db->select("child_id");
				$ids = $this->db->get("product2collection")->result();
				$product_ids = array();
				foreach($ids as $item)
				{
					$product_ids[] = $item->child_id;
				}
				$this->db->where_in("id", $product_ids);
			}
			
			//Если указан пункт в наличии 
			if(isset($filter['is_active'])) $this->db->where("is_active", 1);
			
			//фильтрация по категории
			if(isset($filter['categories_checked'])) $this->db->where_in("parent_id", $filter['categories_checked']);

			//фильтрация по производителю
			if(isset($filter['manufacturer_checked'])) $this->db->where_in("manufacturer_id", $filter['manufacturer_checked']);
			
			//фильтрация по артикулу
			if(isset($filter['sku_checked'])) $this->db->where_in("sku", $filter['sku_checked']);
			
			if(isset($filter['width_from']) && isset($filter['width_to'])) $this->set_range_param("width", $filter['width_from'], $filter['width_to']);
			if(isset($filter['height_from']) && isset($filter['height_to']))  $this->set_range_param("height", $filter['height_from'], $filter['height_to']);
			if(isset($filter['depth_from']) && isset($filter['depth_to']))  $this->set_range_param("depth", $filter['depth_from'], $filter['depth_to']);
			if(isset($filter['price_from']) && isset($filter['price_to']))  $this->set_range_param("price", $filter['price_from'], $filter['price_to']);
			
			if(!empty($id)) $this->db->where_in("id", $id);
			
			$this->db->order_by($order, $direction); 
			$result = $limit == FALSE ? $this->db->get("products")->result() : $this->db->get("products", $limit, $from)->result();

			if(!empty($result)) return $result;
		}
	
		return array();
	}
	
	/**
	* Фильтр по условию и обновление списка id продуктов соответствующих фильтрации
	*
	* @param array $values
	* @return array
	*/
	private function _update_values($values)
	{
		$this->db->select('object_id');
		$results = $this->db->get('characteristics')->result();
		foreach($results as $result)
		{
			$values[] = $result->object_id;
		}
		return $values;
	}
	
	private function set_range_param($type, $from, $to)
	{
		if(isset($from) && isset($to))
		{
			$from = preg_replace("/[^0-9]/", "", $from);
			$to = preg_replace("/[^0-9]/", "", $to);

			$where = "{$type} BETWEEN {$from} AND {$to}";
			$this->db->where($where);
		}
	}
	
	public function get_product_characteristics($item)
	{
		$item->color = $this->characteristics->get_list(array("type" => "color", "object_id" => $item->id));
		$item->shortname = $this->characteristics->get_item_by(array("type" => "shortname", "object_id" => $item->id));
		$item->shortdesc = $this->characteristics->get_list(array("type" => "shortdesc", "object_id" => $item->id));
		$item->finishing = $this->characteristics->get_list(array("type" => "finishing", "object_id" => $item->id));
		$item->turn = $this->characteristics->get_list(array("type" => "turn", "object_id" => $item->id));
		
		return $item;
	}
}