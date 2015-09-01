<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cards extends MY_Model
{
	public $editors = array(
		'Основное' => array(
			'id' => array('id', 'hidden'),
			'card_number' => array('Номер карты', 'text', 'name'),
			'card_day_limit' => array('Дневной лимит', 'text'),
			'card_credit_limit' => array('Кредитный лимит', 'text'),
			'card_balance' => array('Баланс', 'text')
		)		
	);

	function __construct()
	{
        parent::__construct();
	}
}