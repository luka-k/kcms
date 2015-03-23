<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Orders_products_model extends MY_Model
{
	public $editors = array(
		'Основное' => array(
			'id' => array('id', 'hidden'),
			'order_id' => array('Номер заказа', 'hidden'),
			'product_id' => array('id товара', 'select'),
			'product_name' => array('Наименование товара', 'select'),
			'product_price' => array('Цена товара', 'select'),
			'order_qty' => array('Количество в заказе', 'hidden')
		),
	);
	
	function __construct()
	{
        parent::__construct();
	}
}

/* End of file news.php */
/* Location: ./application/models/db/news.php */