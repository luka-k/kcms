<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//Модель работы с изображениями
class Files extends MY_Model 
{
	function __construct()
	{
        parent::__construct();
		$this->load->database();
		
		$this->config->load('upload_config');
	}
	
	public function upload_file($file)
	{
		$upload_path = $this->config->item('file_upload_path');
		$file_name = slug($file["name"]);
		$temp_path = make_upload_path($file_name, $upload_path).$file_name;
		//Загружаем оригинал
		if(!move_uploaded_file($file["tmp_name"], $temp_path))
		{
			return FALSE;
		}
	}
}