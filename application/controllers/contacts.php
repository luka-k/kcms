<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Contacts class
*
* @package		kcms
* @subpackage	Controllers
* @category	    contacts
*/
class Contacts extends Client_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$this->breadcrumbs->add("contacts", "Контакты");
		
		$data = array(
			"title" => "Контакты",
			"select_item" => "contacts",
			'breadcrumbs' => $this->breadcrumbs->get()
		);
		$data = array_merge($this->standart_data, $data);
		$this->load->view('client/contacts.php', $data);
	}
}