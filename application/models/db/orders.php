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
	/**
	* $editors = array(
	* 	"Наименование вкладки в админке" = array(
	*		"имя поля в базе" => array("Наименование поля для отображения", "наименования отображения", "условия для функции editors_post()", "условия для js валидации")
	*	)
	* )
	* 
	* "условия для функции editors_post" - функции php принимающие на вход один параметр + функции из библиотеки My_form_validation
	*
	* "условия для js валидации" - поддерживается три условия
	*	reqiure - обязателоно для заполнения
	*	email - коректный email
	*	matches[имя поля] - совпадение со значением поля имя которого указано
	* валидация функцией editors_post убрана полность. 
	* позднее расширю js валидацию.
	*/
	public $editors = array(
		'Основное' => array(
			'id' => array('id', 'hidden'),
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

	/**
	* Обновление заказа
	*
	* @param integer $id
	* @return bool
	*/
	function update($id, $data = FALSE)
	{
		if (!$id) return FALSE;
		
		$data ? $this->db->where($this->_primary_key, $id)->update($this->_table, $data) : $this->db->where($this->_primary_key, $id)->update($this->_table);
	}	
	
	/**
	* Возвращает уникальный id для внесения заказа в базу
	*
	* @return string
	*/
	function get_order_id()
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