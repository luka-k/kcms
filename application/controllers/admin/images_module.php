<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Images_module extends Admin_Controller 
{

	public function __construct()
	{
		parent::__construct();
	}
	
	public function rethumb($action)
	{
		if (isset($_FILES['import_images'])&&($_FILES['import_images']['error'] <> 4))
		{
			var_dump($_FILES['import_images']);
		}
		else
		{
			echo "fuck";
		}
		
		$images= $this->images->get_list(FALSE);
		

		$this->images->resize($images);
		
		redirect(base_url()."admin/content/item/settings/1");
	}
	
	//Думаю сюда стоит перенести всю работу скартинками. удаление и тд.
}