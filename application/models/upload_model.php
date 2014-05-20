<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Upload_model extends CI_Model {

    function __construct()
	{
        parent::__construct();
		//Подгружаем файл конфигурации загрузки
		$this->config->load('upload_config');
	}
	
	public function upload_img($upload_path, $file_name)
	{
		//Формируем помощником путь с подпапками
		$upload_path = make_upload_path($file_name, $upload_path);
		
		//Загружаем из конфигурационного файла параметры
		$config['allowed_types'] = $this->config->item('allowed_types');
		$config['max_size'] = $this->config->item('max_size');
		$config['max_width'] = $this->config->item('max_width');
		$config['max_height'] = $this->config->item('max_height');
		$config['upload_path'] = $upload_path;
		$config['file_name'] = $file_name;
		//Производим загрузку файла
		$this->load->library('upload', $config);
		
		if(!$this->upload->do_upload())
		{
			//Если не удалась загрузка в err_exist записываем что есть ошибка, 
			//а в err_text текст ошибки
			$upload_info['err_exist'] = TRUE;
			$upload_info['err_text'] = $this->upload->display_errors();
			return $upload_info;
		} 
		else 
		{
			//Если загрузка удалась в err_exist записываем отсутствие ошибки
			//в upload_data данные загрузки
			$upload_info['err_exist'] = FALSE;
			$upload_info['upload_data'] = $this->upload->data();
			return $upload_info;
		}
	}
		
    public function do_resize($file_path, $upload_path, $file_name)
	{
		
		$file_name = substr($file_name, 0, -4);
		//Загружаем из конфигурационного файла параметры
		$config['source_image'] = $file_path;
		$config['image_library'] = $this->config->item('image_library');
		$config['create_thumb'] = $this->config->item('create_thumb');
		$config['maintain_ratio'] = $this->config->item('maintain_ratio');
		$thumb = $this->config->item('thumb');
		//Подгружаем библиотеку обработки изображений
		$this->load->library('image_lib'); 
		
		for ($i=1; $i<=$thumb; $i++ )
		{
			$config['width'] = $this->config->item("width_$i");
			$config['height'] = $this->config->item("height_$i");
		
			//Если папка с миниатурами не существует создаем ее.
			$upload_path = "./uploads/images/thumb_{$this->config->item("width_$i")}_{$this->config->item("height_$i")}";
			
			$upload_path = make_upload_path($file_name, $upload_path);
	
			$config['new_image'] = $upload_path;
		
			$this->image_lib->initialize($config);
			if (!$this->image_lib->resize())  
			{
				$resize_info['err_exist'] = TRUE;
				$resize_info['err_text'] = $this->image_lib->display_errors();
				return $resize_info;
			} 
			else 
			{
				$resize_info['err_exist'] = FALSE;		
			}
		}
		return $resize_info;
	}
}

/* End of file upload.php */
/* Location: ./application/models/task_1/upload.php */