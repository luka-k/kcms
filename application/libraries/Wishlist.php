<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CI_Wishlist {
	
	var $CI;
	var $wishlist = array();
	
	public function __construct()
	{
		$this->CI =& get_instance();
		$this->CI->load->library('session');	
	}
	
	public function insert($item)
	{
		$this->wishlist = unserialize($this->CI->input->cookie('wishlist'));
		if(is_array($this->wishlist)&&array_key_exists($item->id, $this->wishlist))
		{
			return;
		}
		else
		{
			$this->wishlist[$item->id] = $item;
		}
		$this->safe_wishlist();
	}
	
	public function delete($id)
	{
		$this->wishlist = unserialize($this->CI->input->cookie('wishlist'));
		unset($this->wishlist[$id]);
		$this->safe_wishlist();
	}
	
	public function safe_wishlist()
	{
		$cookie = array(
			'name'   => 'wishlist',
			'value'  => serialize($this->wishlist),
			'expire' =>  "622080000"
		);

		$this->CI->input->set_cookie($cookie); 
	}
}