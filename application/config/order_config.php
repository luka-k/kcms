<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['method_delivery'] = array(
	"1" => array("Курьерская доставка", "от 500 руб."),
	"2" => array("Самовывоз", "бесплатно"),
	"3" => array("Транспортная компания", "от 500 руб.")
);

$config['order_status'] = array(
	"1" => "Новый",
	"2" => "Подтвержден",
	"3" => "Доставлен",
	"4" => "Отменен"
);

$config['city_id'] = array(
	"1" => "Санкт-Петербург",
	"2" => "Москва",
	"3" => "Ульяновск"
);

$config['method_pay'] = array(
	"0" => "Наличными курьеру",
	"1" => "Банковской картой"
);