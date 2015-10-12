<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Child_users extends MY_Model
{
	public $editors = array(
		'Основное' => array(
			'id' => array('id', 'hidden'),
			'first_name' => array('Фамилия', 'text', 'name', 'require'),
			'last_name' => array('Имя', 'text', '', 'require'),
			'middle_name' => array('Отчество', 'text', '', 'require'),
			'parent_id' => array('Родитель', 'select', '', 'require'),
			'school_id' => array('Школа', 'select', '', 'require'),
			'class' => array('Класс', 'text', '', 'require'),
			'birthday' => array('Дата', 'date', '', 'require'),
			'phone' => array('Номер телефона', 'text', '', 'require'),
			'dinner_sms_enabled' => array('Оповещения об обедах', 'checkbox'),
			'dinner_sms_enabled_date' => array('Дата включения оповещения', 'date'),
			'visit_sms_enabled' => array('Оповещение о посещаемости', 'checkbox'),
			'visit_sms_enabled_date' => array('Дата включения оповещения', 'date'),
			'image' => array('Аватар', 'image', 'img')
		),
		'Карта' => array(
			'child_card' => array('Карта', 'child_card')
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
		$orders = $this->orders->get_list(array('card_number' => $child->card_number), FALSE, FALSE, 'date', 'desc');
		
		if($orders) foreach($orders as $i => $order)
		{
			$order_date = new DateTime($order->date);
			$order->date = date_format($order_date, 'd/m/y');
			
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
		$result = $this->db->get_where('child2product', array('child_user_id' => $child_id, 'disabled' => 1))->result();
			
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
				$item->dinner_sms_enabled_date = date_format($item_date, 'd.m.Y');
				$item_date = new DateTime($item->visit_sms_enabled_date);
				$item->visit_sms_enabled_date = date_format($item_date, 'd.m.Y');
				$item->card = $this->cards->get_item_by(array('card_number' => $item->card_number));
				$item->school = $this->schools->get_item($item->school_id);
				
				$item->orders = array();
			}
			
			return $item;
		}
	}
}