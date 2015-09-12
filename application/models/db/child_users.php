<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Child_users extends MY_Model
{
	public $editors = array(
		'Основное' => array(
			'id' => array('id', 'hidden'),
			'first_name' => array('Фамилия', 'text', 'name'),
			'last_name' => array('Имя', 'text'),
			'middle_name' => array('Отчество', 'text'),
			'parent_id' => array('Родитель', 'select'),
			'school_id' => array('Школа', 'select'),
			'class' => array('Класс', 'text'),
			'card_number' => array('Номер карты', 'text'),
			'birthday' => array('Дата', 'date'),
			'phone' => array('Номер телефона', 'text'),
			'dinner_sms_enabled' => array('Оповещения об обедах', 'checkbox'),
			'dinner_sms_enabled_date' => array('Дата включения оповещения', 'date'),
			'visit_sms_enabled' => array('Оповещение о посещаемости', 'checkbox'),
			'visit_sms_enabled_date' => array('Дата включения оповещения', 'date'),
			'image' => array('Аватар', 'image', 'img')
		),
		'Продукты' => array(
			'child2products' => array('Разрешенные продукты', 'child2products')
		)
	);
	
	function __construct()
	{
        parent::__construct();
	}
	
	public function get_orders($child)
	{
		$orders = $this->orders->get_list(array('card_number' => $child->card_number));
		
		if($orders) foreach($orders as $i => $order)
		{
			$order_date = new DateTime($order->date);
			$order->dinner_sms_enabled_date = date_format($order_date, 'm.d.Y');
			
			$orders[$i]->products = array();
			
			$this->db->select('product_id');
			$this->db->where('order_id', $order->id);
			$result = $this->db->get('order2products')->result();
			
			if(!empty($result))
			{
				foreach($result as $r)
				{
					$products_ids[] = $r->product_id;
				}
				
				$this->db->where_in('id', $products_ids);
				$orders[$i]->products = $this->db->get('products')->result();
			}
		}		
		
		return $orders;
	}
	
	public function get_disabled_products($child_id)
	{
		$disabled_products = array();
		
		$this->db->select('product_id');
		$result = $this->db->get_where('child2product', array('child_id' => $child_id, 'disabled' => 1))->result();
			
		if($result) foreach($result as $r)
		{
			$disabled_products[] = $r->product_id;
		}
		
		return $disabled_products;
	}
	
	public function prepare($item, $all_info = FALSE)
	{
		if(!empty($item))
		{
			$item->full_name = $item->first_name.' '.$item->last_name.' '.$item->middle_name; 
		
			if($all_info)
			{
				$item_date = new DateTime($item->dinner_sms_enabled_date);
				$item->dinner_sms_enabled_date = date_format($item_date, 'm.d.Y'); //???
				$item_date = new DateTime($item->visit_sms_enabled_date);
				$item->visit_sms_enabled_date = date_format($item_date, 'm.d.Y'); //???
				$item->card = $this->cards->get_item_by(array('card_number' => $item->card_number));
				$item->school = $this->schools->get_item($item->school_id);
				
				$item->orders = array();
			}
			
			return $item;
		}
	}
}