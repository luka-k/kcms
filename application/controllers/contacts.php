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
		
		$this->config->load('articles');
		$publications = $this->articles->get_all_publication($this->config->item('publication_id'), 0, 6);
		$partners = $this->partners->get_list(FALSE);

		$data = array(
			"title" => "Контакты",
			"select_item" => "contacts",
			'breadcrumbs' => $this->breadcrumbs->get(),
			'publications' => $this->articles->prepare_list($publications),
			'partners' => $this->partners->prepare_list($partners),
		);
		
		$data = array_merge($this->standart_data, $data);
		
		$this->load->view('client/contacts.php', $data);
	}
}