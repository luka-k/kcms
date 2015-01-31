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
	}

	function update($id, $data = FALSE)
	{
		if (!$id) return FALSE;
		
		$data ? $this->db->where($this->_primary_key, $id)->update($this->_table, $data) : $this->db->where($this->_primary_key, $id)->update($this->_table);
	}	
	
}

/* End of file Orders.php */
/* Location: ./application/models/db/Orders.php */