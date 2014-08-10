<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//Модель работы с изображениями
class Images_model extends MY_Model 
{
    function __construct()
	{
        parent::__construct();
		$this->config->load('upload_config');
		require_once FCPATH.'application/third_party/phpThumb/phpthumb.class.php';
	}
	
	public function upload_image($pic, $object_info)
	{
		//Подключаем настройки
		
		$upload_path = $this->config->item('upload_path');
		$thumbnail_widths = $this->config->item('thumb_size');
		
		$pic_name = explode(".", $pic['name']);
		//Чистим от лишних и транлитируем имя файла.
		$pic_name[0] = slug($pic_name[0]);
		$pic_name = $pic_name[0].".".$pic_name[1];
		//Формируем путь для загрузки оригинала изображения
		$temp_path = make_upload_path($pic_name, $upload_path).$pic_name;
	
		//Загружаем оригинал
		if(!move_uploaded_file($pic["tmp_name"], $temp_path))
		{
			return FALSE;
		}
				
		$thumb = new phpThumb();
		//Создаем миниатюры
		foreach ($thumbnail_widths as $thumb_dir_name => $thumbnail_width) 
		{
			$thumb->resetObject();
			
			//Задаем имя файла с которого делаем миниатюру.
			$thumb->setSourceFilename($temp_path);
		
			//Заносим параметры в масив
			$parameters = array(
				'w' => $thumbnail_width, //ширина изображения
				'config_output_format' => 'jpeg' //формат изображения
			);
			
			//Устанавливаем параметры
			foreach($parameters as $key => $value)
			{
				$thumb->setParameter($key, $value);
			}
			
			$upload_thumb_path = $upload_path."/".$thumb_dir_name;
			
			$output_filename = make_upload_path($pic_name, $upload_thumb_path).$pic_name;

			//Генерируем миниатюры
			if(!$thumb->GenerateThumbnail())
			{
				return FALSE;
			}
			else
			{
				//Загружаем миниатюры в соответствующую папку
				if(!$thumb->RenderToFile($output_filename))
				{
					return FALSE;
				}
			}
		}
		//Добавляем информацию о загруженой картинке в базу
		foreach ($object_info as $field => $info)
		{
			$data[$field] = $info;
		}
		$data['url'] = make_upload_path($pic_name, null).$pic_name;
		if($this->get_images($object_info) == FALSE)
		{
			$data['cover'] = 1;
		}
		else
		{
			$data['cover'] = 0;
		}
		$this->images->insert($data);
		return TRUE;
	}
	
	public function get_images($object_info, $cover = FALSE)
	{
		if ($cover == FALSE)
		{
			$img = $this->images->get_list(array('object_id' => $object_info['object_id'], 'object_type' => $object_info['object_type']));
		}
		else
		{
			$img = $this->images->get_item_by(array('object_id' => $object_info['object_id'], 'object_type' => $object_info['object_type'], 'cover' =>$cover));
		}
		//var_dump($img);
		return $img;
	}
	
	public function get_img_list($info, $object_type)
	{
		foreach($info as $key => $item)
		{
			$object_info =array (
				"object_type" => $object_type,
				"object_id" => $info[$key]->id
			);
			$info[$key]->img = $this->images_model->get_images($object_info, '1');
		}
		return $info;
	}
	
	public function set_cover($object_info, $cover)
	{
		$img = $this->images->get_item_by(array('object_id' => $object_info['object_id'], 'cover' => 1));
		if(isset($img))
		{
			$this->db->set('cover', 1);
			$this->db->where(array("object_type" => $object_info['object_type'], "id" => $cover));
			if($this->db->update('images'))
			{
				return TRUE;
			}
		}
		elseif($img->id <> $cover)
		{
			$this->db->set('cover', 0);
			$this->db->where($object_info);
			$this->db->update('images'); 
			$this->db->set('cover', 1);
			$this->db->where(array("object_type" => $object_info['object_type'], "id" => $cover));
			if($this->db->update('images'))
			{
				return TRUE;
			}
		}
		
	}
	
	public function delete_img($object_info)
	{
		//var_dump($object_info);
		$img = $this->images->get_item_by(array('object_type' => $object_info['object_type'], 'id' =>$object_info['id']));
		//var_dump ($img);
		$this->images->delete($object_info['id']);
		
		$upload_path = $this->config->item('upload_path');
		$size_info = $this->config->item('thumb_size');
		foreach ($size_info as $path => $item)
		{
			unlink($upload_path."/".$path.$img->url);
		}
		unlink($upload_path.$img->url);
		
		if(($this->images->get_count(array("object_id" => $img->object_id))>0) and ($img->cover == 1))
		{
			$object_info = array(
				"object_type" => $object_info['object_type'],
				"object_id" => $img->object_id
			);
			$images = $this->get_images($object_info);
			$this->set_cover($object_info, $images[0]->id);
		}	
		return $img->object_id;
	}
	
}