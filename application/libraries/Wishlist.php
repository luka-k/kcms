<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Wishlist class
* 
* @package		kcms
* @subpackage	Libraries
* @category	    Wishlist
*/
class CI_Wishlist {
	
	var $CI;
	var $wishlist = array();
	
	public function __construct()
	{
		$this->CI =& get_instance();
		$this->CI->load->library('session');	
	}
	
	/**
	* Добавление в wishlist
	* 
	* @param object $item
	*/
	public function insert($item)
	{
		$this->wishlist = unserialize($this->CI->input->cookie('wishlist'));
		if(is_array($this->wishlist)&&in_array($item, $this->wishlist))
		{
			return;
		}
		else
		{
			$this->wishlist[] = $item;
		}
		$this->safe_wishlist();
	}
	
	/**
	* Получиние wishlist
	*
	* @return object
	*/
	public function get()
	{
		$wishlist_id = $this->CI->config->item('wishlist_id');
		$wishlist = unserialize($this->CI->input->cookie('wishlist-'.$wishlist_id));

		$wishlist_items = array();
		
		if($wishlist)foreach($wishlist as $item)
		{
			$wishlist_items[] = $this->CI->products->get_item_by(array("id" => $item));
		}
		return $this->CI->products->prepare_list($wishlist_items);
	}
	
	/**
	* Удаление из wishlist
	*
	* @param integer $id
	*/
	public function delete($id)
	{
		$this->wishlist = unserialize($this->CI->input->cookie('wishlist'));
		unset($this->wishlist[$id]);
		$this->safe_wishlist();
	}
	
	/**
	* Сохранение изменений в wishlist
	*/
	public function safe_wishlist()
	{
		$wishlist_id = $this->CI->config->item('wishlist_id');
		$cookie = array(
			'name'   => 'wishlist-'.$wishlist_id,
			'value'  => serialize($this->wishlist),
			'expire' =>  "622080000"
		);

		$this->CI->input->set_cookie($cookie); 
	}
}