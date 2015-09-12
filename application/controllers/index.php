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
		$data = array(
			'title' => $this->standart_data['settings']->site_title
		);
		$data = array_merge($this->standart_data, $data);
		
		$this->load->view('client/index.php', $data);
	}	
}

/* End of file Index.php */
/* Location: ./application/controllers/Index.php */