<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menus_data extends MY_Model
{
	function __construct()
	{
        parent::__construct();
		$this->load->database();
	}
}