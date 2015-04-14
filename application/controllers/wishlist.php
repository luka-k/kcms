<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* WIshlist class
*
* @package		kcms
* @subpackage	Controllers
* @category	    Wishlist
*/
class Wishlist extends Client_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$wishlist = $this->wishlist->get();

		$data = array(
			'title' => "вишлист",
			'select_item' => '',
			'tree' => $this->categories->get_tree(0, "parent_id"),
			'wishlist' => $wishlist
		);
		$data = array_merge($this->standart_data, $data);		

		$this->load->view('client/wishlist.php', $data);
	}
}