<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function collections_tree()
	{
		my_dump($this->collections->get_tree());
		
	}
}