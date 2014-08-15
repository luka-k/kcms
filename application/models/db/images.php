<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Images extends MY_Model
{
	public $editors = array(
		'Основное' => array(
			'id' => array('id', 'hidden'),
			'object_type' => array('Тип страницы', 'hidden'),
			'object_id' => array('Id сраницы', 'hidden'),
			'url' => array('url', 'hidden')
		)
	);
	
	function __construct()
	{
        parent::__construct();
		$this->load->database();
		
		$this->config->load('upload_config');
		require_once FCPATH.'application/third_party/phpThumb/phpthumb.class.php';
	}
	
	public function upload_image($img, $object_info)
	{
		//Подключаем настройки
		$upload_path = $this->config->item('upload_path');
		//$thumb_sizes = $this->config->item('thumb_size');
		$thumb_config = $this->config->item('thumb_config');
		
		//$img_name = explode(".", $img['name']);
		//Чистим от лишних символов и транлитируем имя файла.
		//$img_name[0] = slug($img_name[0]);
		
		$img_info = $this->non_requrrent_info($img['name']);
		
		//$img_name = $img_name[0].".".$img_name[1];
		//Формируем путь для загрузки оригинала изображения
		$temp_path = make_upload_path($img_info->name, $upload_path).$img_info->name;
	
		//Загружаем оригинал
		if(!move_uploaded_file($img["tmp_name"], $temp_path))
		{
			return FALSE;
		}
				
		$thumb = new phpThumb();
		//Создаем миниатюры
		foreach ($thumb_config as $thumb_dir_name => $configs) 
		{
			$thumb->resetObject();
			
			//Задаем имя файла с которого делаем миниатюру.
			$thumb->setSourceFilename($temp_path);
		
			//Устанавливаем параметры
			foreach($configs as $parameter => $config)
			{
				$thumb->setParameter($parameter, $config);
			}
			
			$upload_thumb_path = $upload_path."/".$thumb_dir_name;
			
			$output_filename = make_upload_path($img_info->name, $upload_thumb_path).$img_info->name;

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
		//$data['title'] = $img_name[0];
		$data['url'] = $img_info->url;
		if($this->get_images($object_info) == FALSE)
		{
			$data['is_cover'] = 1;
		}
		else
		{
			$data['is_cover'] = 0;
		}
		if(!$this->images->insert($data))
		{
			return FALSE;
		}
		return TRUE;
	}
	
	public function non_requrrent_info($img_name)
	{
		$image = explode(".", $img_name);
		//Чистим от лишних символов и транлитируем имя файла.
		$image[0] = slug($image[0]);
		$img_name = $image[0].".".$image[1];
		$url = make_upload_path($img_name, NULL).$img_name;
		//var_dump($img_name);
		$count = 1;
		while(!($this->non_requrrent(array("url" => $url))))
		{
			$img_name = $image[0]."[".$count."]".".".$image[1];
			$url = make_upload_path($img_name, NULL).$img_name;
			$count++;
			//var_dump($img_name);
		};
		$img_info = new stdClass();
		$img_info->name = $img_name;
		$img_info->url = $url;
		return $img_info;
	}
	
	public function get_images($object_info, $is_cover = FALSE)
	{
		if ($is_cover == FALSE)
		{
			$img = $this->images->get_list(array('object_id' => $object_info['object_id'], 'object_type' => $object_info['object_type']));
		}
		else
		{
			$img = $this->images->get_item_by(array('object_id' => $object_info['object_id'], 'object_type' => $object_info['object_type'], 'is_cover' =>$is_cover));
		}
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
			$info[$key]->img = $this->images->get_images($object_info, '1');
		}
		return $info;
	}
	
	public function set_cover($object_info, $cover_id)
	{
		$this->db->set('is_cover', 0);
		$this->db->where($object_info);
		$this->db->update('images'); 
		$this->db->set('is_cover', 1);
		$this->db->where(array("object_type" => $object_info['object_type'], "id" => $cover_id));
		if($this->db->update('images'))
		{
			return TRUE;
		}
	}
	
	public function delete_img($object_info)
	{
		$img = $this->images->get_item_by(array('object_type' => $object_info['object_type'], 'id' =>$object_info['id']));
		$this->images->delete($object_info['id']);
		
		$upload_path = $this->config->item('upload_path');
		$size_info = $this->config->item('thumb_size');
		foreach ($size_info as $path => $item)
		{
			unlink($upload_path."/".$path.$img->url);
		}
		unlink($upload_path.$img->url);
		
		if(($this->images->get_count(array("object_id" => $img->object_id))>0) and ($img->is_cover == 1))
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