<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Orders_products class
*
* @package		kcms
* @subpackage	Models
* @category	    Orders_products
*/
class Orders_products extends MY_Model
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

/* End of file orders.php */
/* Location: ./application/models/db/orders_products.php */