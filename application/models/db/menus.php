<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menus extends MY_Model
{
	function __construct()
	{
        parent::__construct();
		$this->load->database();
	}
}