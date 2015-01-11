<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Orders extends MY_Model
{
	public $editors = array(
		'Основное' => array(
			'id' => array('id', 'hidden', ''),
			'customer_id' => array('customer_id', 'hidden'),
			'order_total' => array('Сумма заказа', 'hidden'),
			'method_delivery' => array('Способ доставки', 'select'),
			'method_pay' => array('Способ оплаты', 'select'),
			'order_date' => array('Дата заказа', 'hidden'),
			'order_status' => array('Статус', 'select')
		),
	);
	
	protected $_primary_key = 'order_id';
	
	function __construct()
	{
        parent::__construct();
		$this->load->database();
	}

	function update($id, $data = FALSE)
	{
		if (!$id)
		{	
			return FALSE;
		}
		
		if ($data)
		{
			$this->db->where($this->_primary_key, $id)->update($this->_table, $data);
		}
		else
		{
			$this->db->where($this->_primary_key, $id)->update($this->_table);
		}
	}

	function get_order_id()
	{
		$this->db->select_max('order_id');
		$query = $this->db->get('orders');
		$order_id = $query->row()->order_id;
		return $order_id + 1;
	}
	
	function prepare($item)
	{
		if(!is_object($item)) $item = (object)$item;
		$item->img = $this->images->get_images(array('object_type' => 'products', 'object_id' => $item->product_id), 1);
		if(isset($item->url)) $item->full_url = $this->get_url($item->url);
		return $item;		
	}
	
}

/* End of file news.php */
/* Location: ./application/models/db/news.php */