<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['config'] = array(
	'protocol' => "mail",
	'charset' => "utf-8",
	'mailtype' => "html",
	'wordwrap' => TRUE
);

$config['replace'] = array(
	"%ORDER_ID%" => "Номер заказа",
	"%USER_NAME%" => "Имя заказчика",
	"%CART%" => "Содержимое корзины"
);

/* End of file emails_config.php */
/* Location: ./application/config/emails_config.php */