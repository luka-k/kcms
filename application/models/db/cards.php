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
	
	public function debiting($card_number, $type, $check_time = FALSE)
	{
		if($check_time)
		{
			$today = date("Y-m-d");
			
			$child = $this->child_users->get_item_by(array('card_number' => $card_number));
			
			$field = $type.'_debiting';

			$today_datetime = new DateTime($today);
			$last_datetime = new DateTime($child->$field);
			$interval = $today_datetime->diff($last_datetime);
			$date_interval = (int) $interval->format('%m');

			if($date_interval > 0)
			{
				if(!$this->_debiting($card_number, $type)) return FALSE;
				
				$this->child_users->update($child->id, array($field => $today));	
			}
			
			return TRUE;
		}
		else
		{
			if(!$this->_debiting($card_number, $type)) return FALSE;
			return TRUE;
		}
	}
	
	protected function _debiting($card_number, $type)
	{
		$this->load->config('orders');
		
		$card = $this->get_item_by(array('card_number' => $card_number));
		$new_balance = $card->card_balance - $this->config->item($type.'_price');
		
		if($new_balance < 0) return FALSE;
		
		$this->update($card->id, array('card_balance' => $new_balance));
		
		return TRUE;
	}
}