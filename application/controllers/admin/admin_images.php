<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_images extends Admin_Controller 
{

	public function __construct()
	{
		parent::__construct();
	}
	
	public function rethumb()
	{
		$images= $this->images->get_list(FALSE);
		
		$sizes = $this->config->item('thumb_config');
		
		$this->images->resize($images);
		die('ok'); 
		redirect(base_url()."admin/content/item/settings/1");
	}
	
	//Думаю сюда стоит перенести всю работу скартинками. удаление и тд.
}