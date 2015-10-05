<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Index class
*
* @package		kcms
* @subpackage	Controllers
* @category	    Index
*/
class Index extends Client_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{		
		//$slider = $this->slider->get_list(FALSE, FALSE, FALSE, "sort", "asc");

		$this->config->load('articles');
		
		$publications = $this->articles->get_all_publication($this->config->item('publication_id'), 0, 6);
		
		$data = array(
			'title' => $this->standart_data['settings']->site_title,
			'select_item' => '',
			'publications' => $this->articles->prepare_list($publications)
		);
		$data = array_merge($this->standart_data, $data);
		
		$this->load->view('client/index.php', $data);
	}	
}

/* End of file Index.php */
/* Location: ./application/controllers/Index.php */