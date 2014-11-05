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
	"1" => "New",
	"2" => "Delivered",
	"3" => "Shipping",
	"4" => "Desabled"
);

$config['method_pay'] = array(
	"0" => "Выберите способ оплаты",
	"1" => "Сбербанк",
	"2" => "Yandex-деньги",
	"3" => "Наличные"
);