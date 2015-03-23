<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Articles extends Client_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		var_dump('ok');
	}
}