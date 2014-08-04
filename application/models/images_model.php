<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//Модель работы с изображениями
class Images_model extends MY_Model 
{
    function __construct()
	{
        parent::__construct();
		//require_once base_url().'phpthumb.class.php';
	}
	
	public function upload_image($pic)
	{
		//var_dump($pic);
	}
}