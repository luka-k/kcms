<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['config'] = array(
	'protocol' => "mail",
	'charset' => "utf-8",
	'mailtype' => "html",
	'wordwrap' => TRUE
);

$config['message_type'] = array(
	"admin_order" => "Администратору при заказе",
	"customer_order" => "Клиенту при заказе",
	"change_order_status" => "Клиенту при изменении статуса заказа",
	"registration" => "При регистрации",
	"change_password" => "При изменении пароля",
	"callback" => "Обратный звонок"
);

$config['replace'] = array(
	"%ORDER_ID%" => "Номер заказа",
	"%USER_NAME%" => "Имя заказчика",
	"%CART%" => "Содержимое корзины"
);

/* End of file emails_config.php */
/* Location: ./application/config/emails_config.php */