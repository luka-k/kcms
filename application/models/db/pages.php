<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends MY_Model
{
	function __construct()
	{
        parent::__construct();
		$this->load->database();
	}
}
