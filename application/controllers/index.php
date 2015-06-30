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
		die(header('Location: /catalog'));
	}	
}

/* End of file Index.php */
/* Location: ./application/controllers/Index.php */