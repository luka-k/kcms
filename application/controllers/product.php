<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product extends Client_Controller {

	public function __construct()
	{
		parent::__construct();
		
	}
	
	public function index($url)
	{
		$url = explode('-', $url);
		$sku = $url[count($url)-1];
		$product = $this->products->get_item_by(array('sku' => $sku));
		if ($product)
		{
			header('HTTP/1.1 301 Moved Permanently');
			header('Location: '.$this->products->get_url($product));
			exit();
		} else {
			Redirect('/');
		}
	}
}