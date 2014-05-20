<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Upload_model extends CI_Model {

    function __construct()
	{
        parent::__construct();
		//���������� ���� ������������ ��������
		$this->config->load('upload_config');
	}
	
	public function upload_img($upload_path, $file_name)
	{
		//��������� ���������� ���� � ����������
		$upload_path = make_upload_path($file_name, $upload_path);
		
		//��������� �� ����������������� ����� ���������
		$config['allowed_types'] = $this->config->item('allowed_types');
		$config['max_size'] = $this->config->item('max_size');
		$config['max_width'] = $this->config->item('max_width');
		$config['max_height'] = $this->config->item('max_height');
		$config['upload_path'] = $upload_path;
		$config['file_name'] = $file_name;
		//���������� �������� �����
		$this->load->library('upload', $config);
		
		if(!$this->upload->do_upload())
		{
			//���� �� ������� �������� � err_exist ���������� ��� ���� ������, 
			//� � err_text ����� ������
			$upload_info['err_exist'] = TRUE;
			$upload_info['err_text'] = $this->upload->display_errors();
			return $upload_info;
		} 
		else 
		{
			//���� �������� ������� � err_exist ���������� ���������� ������
			//� upload_data ������ ��������
			$upload_info['err_exist'] = FALSE;
			$upload_info['upload_data'] = $this->upload->data();
			return $upload_info;
		}
	}
		
    public function do_resize($file_path, $upload_path, $file_name)
	{
		
		$file_name = substr($file_name, 0, -4);
		//��������� �� ����������������� ����� ���������
		$config['source_image'] = $file_path;
		$config['image_library'] = $this->config->item('image_library');
		$config['create_thumb'] = $this->config->item('create_thumb');
		$config['maintain_ratio'] = $this->config->item('maintain_ratio');
		$thumb = $this->config->item('thumb');
		//���������� ���������� ��������� �����������
		$this->load->library('image_lib'); 
		
		for ($i=1; $i<=$thumb; $i++ )
		{
			$config['width'] = $this->config->item("width_$i");
			$config['height'] = $this->config->item("height_$i");
		
			//���� ����� � ����������� �� ���������� ������� ��.
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