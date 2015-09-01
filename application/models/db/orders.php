<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Orders class
*
* @package		kcms
* @subpackage	Models
* @category	    Orders
*/
class Orders extends MY_Model
{
	function __construct()
	{
        parent::__construct();
	}

	/**
	* Обновление заказа
	*
	* @param integer $id
	* @return bool
	*/
	/*function update($id, $data = FALSE)
	{
		if (!$id) return FALSE;
		
		$data ? $this->db->where("id", $id)->update($this->_table, $data) : $this->db->where($this->_primary_key, $id)->update($this->_table);
	}*/	
	
	/**
	* Возвращает уникальный id для внесения заказа в базу
	*
	* @return string
	*/
	function get_order_code()
	{
		$this->db->select_max("id");
		$id = $this->db->get($this->_table)->row()->id;
		$order_id = $id + START_ORDER_ID;
		return $order_id;
	}
	
	/**
	* 
	*
	* @param object $item
	* @return object
	*/
	function prepare($item)
	{
		if(!is_object($item)) $item = (object)$item;
		$item->img = $this->images->get_images(array('object_type' => 'products', 'object_id' => $item->product_id), 1);
		if(isset($item->url)) $item->full_url = $this->get_url($item->url);
		return $item;		
	}
	
}

/* End of file Orders.php */
/* Location: ./application/models/db/Orders.php */