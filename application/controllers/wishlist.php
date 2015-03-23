<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Wishlist extends Client_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	// wishlist()
	// вывод вишлиста
	public function index()
	{
		$left_menu = $this->dynamic_menus->get_menu(4);
		
		$wishlist = $this->wishlist->get();

		$data = array(
			'title' => "вишлист",
			'tree' => $this->categories->get_tree(0, "parent_id"),
			'left_menu' => $left_menu,
			'wishlist' => $wishlist
		);
		$data = array_merge($this->standart_data, $data);		

		$this->load->view('client/wishlist.php', $data);
	}
}