<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['method_delivery'] = array(
	"0" => "Выберите способ доставки",
	"1" => "Самовывоз",
	"2" => "Курьер СПб",
	"3" => "Почта России",
	"4" => "EMS",
	"5" => "PickPoint",
);

$config['order_status'] = array(
	"1" => "Новый",
	"2" => "Предоплата",
	"3" => "Товар заказан",
	"4" => "Товар прибыл",
	"5" => "Доставка",
	"6" => "Отгружен/оплачен",
	"7" => "Отмена",
	"8" => "Возврат",
);

$config['method_pay'] = array(
	"0" => "Выберите способ оплаты",
	"1" => "Сбербанк",
	"2" => "Yandex-деньги",
	"3" => "Наличные"
);