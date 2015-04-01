<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Cart class
* 
* @package		kcms
* @subpackage	Libraries
* @category	    Cart
*/
class CI_Cart {

	var $CI;
	var $cart_contents = array(
		'items' => array(),
		'cart_total' => 0,
		'total_qty' =>0
	);

	public function __construct()
	{
		$this->CI =& get_instance();
		$this->CI->load->library('session');
		
		if ($this->CI->session->userdata('cart_contents') !== FALSE) $this->cart_contents = $this->CI->session->userdata('cart_contents');
	}
	
	/**
	* Вставка в корзину
	*
	* @param array $items
	*/
	public function insert($items = array())
	{
		if (isset($items['id']))
		{
			$this->insert_item($items);
		}
		elseif(is_array($items))
		{
			foreach ($items as $item)
			{
				if (is_array($item) && isset($item['id'])) $this->insert_item($item);
			}
		}	
		else
		{
			return FALSE;
		}
		$this->safe_cart();
	}
	
	/**
	* Вставка отдельного элемента в корзину
	* 
	* @param array $item
	*/
	public function insert_item($item = array())
	{
		isset($item['options']) && count($item['options']) > 0 ? $item_id = md5($item['id'].implode('_', $item['options'])) : $item_id = md5($item['id']);
		
		if(array_key_exists($item_id, $this->cart_contents['items']))
		{
			$this->cart_contents['items'][$item_id]['qty'] += $item['qty']; 
			$this->cart_contents['items'][$item_id]['item_total'] = $this->cart_contents['items'][$item_id]['price']*$this->cart_contents['items'][$item_id]['qty'];
		}
		else
		{
			$item['item_total'] = ($item['price'] * $item['qty']);
			$this->cart_contents['items'][$item_id] = $item;
		}
	}
	
	/**
	* Обновление корзины
	*
	* @param array $item
	*/
	public function update($item = array())
	{
		$item_id = $item['item_id'];
		$qty = $item['qty'];
		if ($qty < 0) return;
		if ($qty == 0) 
		{
			$this->delete($item_id);
			return;
		}
		$this->cart_contents = $this->CI->session->userdata('cart_contents');
		$this->cart_contents['items'][$item_id]['qty'] = $qty;
		$this->cart_contents['items'][$item_id]['item_total'] = ($this->cart_contents['items'][$item_id]['price'] * $qty);
		$this->safe_cart();
	}
	
	/**
	* Сохраниние изменений в корзине
	*/
	public function safe_cart()
	{
		unset($this->cart_contents['total_qty']);
		unset($this->cart_contents['cart_total']);
		$total_qty = 0;
		$cart_total = 0;
		foreach($this->cart_contents['items'] as $item)
		{
			$cart_total += $item['price']*$item['qty'];
			$total_qty += $item['qty'];		
		}
		$this->cart_contents['total_qty'] = $total_qty;
		$this->cart_contents['cart_total'] = $cart_total; 
		$this->CI->session->set_userdata(array('cart_contents' => $this->cart_contents));
	}
	
	/**
	* Получение всех элементов корзины
	* 
	* @return array
	*/
	public function get_all()
	{
		$this->cart_contents = $this->CI->session->userdata('cart_contents');
		return $this->cart_contents['items'];
	}
	
	/**
	* Получение элемента корзин
	*
	* @param integer $item_id
	*
	* @return bool/array
	*/
	public function get($item_id)
	{
		$this->cart_contents = $this->CI->session->userdata('cart_contents');
		
		if(!array_key_exists($item_id, $this->cart_contents['items'])) return FALSE;

		$item = $this->cart_contents['items'][$item_id];
		return $item;
	}
	
	/**
	* Сумма корзины
	*
	* @return string
	*/
	public function total_price()
	{
		$this->cart_contents = $this->CI->session->userdata('cart_contents');
		if($this->cart_contents['cart_total'] == NULL) $this->cart_contents['cart_total'] = 0;
		return $this->cart_contents['cart_total'];		
	}
	
	/**
	* Общее количество товаров в корзине
	*
	* @return string
	*/
	public function total_qty()
	{
		$this->cart_contents = $this->CI->session->userdata('cart_contents');
		if($this->cart_contents['total_qty'] == NULL) $this->cart_contents['total_qty'] = 0;
		return $this->cart_contents['total_qty'];		
	}
	
	/**
	* Удаление элемента корзины
	*
	* @param integer $item_id
	*/
	public function delete($item_id)
	{
		$this->cart_contents = $this->CI->session->userdata('cart_contents');
		unset($this->cart_contents['items'][$item_id]);
		$this->safe_cart();
	}
	
	/**
	* Полная очистка корзины
	*/
	public function clear()
	{
		$this->cart_contents = array(
			"items" => array(),
			"cart_total" => "",
			"total_qty" => ""
		);
		$this->CI->session->set_userdata(array('cart_contents' => $this->cart_contents));
	}
}