<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Images extends MY_Model
{
	public $editors = array(
		'Основное' => array(
			'id' => array('id', 'hidden'),
			'name' => array('Имя', 'hidden'),
			'object_type' => array('Тип страницы', 'hidden'),
			'object_id' => array('Id сраницы', 'hidden'),
			'url' => array('url', 'hidden')
		)
	);
	
	function __construct()
	{
        parent::__construct();
		$this->config->load('upload_config');
	}
	
	public function upload_image($img, $object_info)
	{
		//Подключаем настройки
		$upload_path = $this->config->item('upload_path');
		
		$img_info = $this->get_unique_info($img['name']);
		
		$img_path = trim(make_upload_path($img_info->name, $upload_path).$img_info->name);
			
		if(isset($img['type']))
		{
			//Загружаем оригинал
			if(!move_uploaded_file($img["tmp_name"], $img_path)) return FALSE;
		}else
		{
			if(!copy(trim($img["tmp_name"]), $img_path)) return FALSE;
		}

		//Создаем миниатюры
		if(!$this->generate_thumbs($img_path) == FALSE) return FALSE;
		
		$object_info['url'] = $img_info->url;
		$name = explode(".", $img_info->name);
		$object_info['name'] = $name[0];

		return $this->insert($object_info);
	}
	
	// function generate_thumb() - генерирует миниатюры для изображения
	// $img_path - путь к картинке
	public function generate_thumbs($img_path, $thumb_config_name = FALSE)
	{
		require_once FCPATH.'application/third_party/phpThumb/phpthumb.class.php';
		
		$upload_path = $this->config->item('upload_path');
		$thumb_config = $this->config->item('thumb_config');
		
		if($thumb_config_name) foreach ($thumb_config as $thumb_dir_name => $configs) 
		{
			if($thumb_dir_name <> $thumb_config_name) unset($thumb_config[$thumb_dir_name]);
		}
		
		$image_name = array_reverse(explode("/", $img_path));
		
		$thumb = new phpThumb();
		//Создаем миниатюры
		foreach ($thumb_config as $thumb_dir_name => $configs) 
		{
			$thumb->resetObject();
			
			//Задаем имя файла с которого делаем миниатюру.
			$thumb->setSourceFilename($img_path);
		
			//Устанавливаем параметры
			foreach($configs as $parameter => $value)
			{
				$thumb->setParameter($parameter, $value);
			}
			
			$output_filename = make_upload_path($image_name[0], $upload_path."/".$thumb_dir_name).$image_name[0];

			//Генерируем миниатюры
			if(!$thumb->GenerateThumbnail())
			{
				return FALSE;
			}
			else
			{
				//Загружаем миниатюры в соответствующую папку
				if(!$thumb->RenderToFile($output_filename))	return FALSE;
			}
		}
	}
	
	public function insert($data)
	{
		if ($data)
		{
			$images = $this->get_list(array("object_type" => $data['object_type'], "object_id" => $data['object_id']));
			$data['is_cover'] = !empty($images) ? 0 : 1;
			$this->db->set($data);
			
			$this->db->insert($this->_table);
			return $this->db->insert_id();
		}
	}
	
	public function resize_all()
	{
		$images= $this->images->get_list(FALSE);
		foreach ($images as $image)
		{
			$upload_path = $this->config->item('upload_path');
			$thumb_config = $this->config->item('thumb_config');
			
			foreach($thumb_config as $path => $param)
			{
				unlink($upload_path."/".$path.$image->url);
			}
			if(!$this->generate_thumbs($upload_path . $image->url) == FALSE) return FALSE;
		}
		return TRUE;
	}
	
	public function get_unique_info($img_name)
	{
		$image = explode(".", $img_name);
		//Чистим от лишних символов и транлитируем имя файла.
		$image[0] = $this->string_edit->slug($image[0]);
		$img_name = $image[0].".".$image[1];
		$url = make_upload_path($img_name, NULL).$img_name;
	
		$count = 1;
		while(!($this->is_unique(array("url" => $url))))
		{
			$img_name = $image[0]."[".$count."]".".".$image[1];
			$url = make_upload_path($img_name, NULL).$img_name;
			$count++;
		};
		$img_info = new stdClass();
		$img_info->name = $img_name;
		$img_info->url = $url;
		return $img_info;
	}
	
	public function get_list($factors = array())
	{
		$images = array();
		if(!empty($factors)) foreach($factors as $key => $value)
		{
			$this->db->where($key, $value);
		}
		
		$this->db->order_by("is_cover", "desc");
		$query = $this->db->get("images");
		
		$images = $query->result();
		
		if(!empty($images)) foreach($images as $key => $image)
		{
			$images[$key] = $this->_get_url($image);
		}
		
		return $images;
	}
	
	public function get_cover($factors = array())
	{
		if(!empty($factors))
		{		
			$factors['is_cover'] = "1";
			$image = $this->get_item_by($factors);
		}
		
		if(empty($image)) $image = $this->get_item_by(array("object_type" => "settings"));
		
		return $this->_get_url($image);
	}
	
	private function _get_url($image)
	{
		$thumb_config = $this->config->item('thumb_config');
		foreach($thumb_config as $path => $config)
		{
			$url_name = $path."_url";
			$image->$url_name = $this->get_url($image->url, $path);
		}
		//Путь к полному изображению
		$image->full_url = $this->get_url($image->url);
		return $image; 
	}
	
	public function get_url($url, $path = FALSE)
	{
		$item_url = array();
		$item_url[] = $url;
		if($path) $item_url[] = $path;
		$item_url[] = "images";
		$item_url[] = "download";
		$full_url = implode("/", array_reverse($item_url));
		$full_url = base_url().$full_url;
		return $full_url;	
	}
	
	public function set_cover($object_info, $cover_id)
	{
		$this->db->set('is_cover', 0);
		$this->db->where($object_info);
		$this->db->update('images'); 
		
		$this->db->set('is_cover', 1);
		$this->db->where(array("id" => $cover_id));
		$this->db->update('images');
	}
	
	public function delete_img($object_info)
	{
		$img = $this->get_item_by(array('object_type' => $object_info['object_type'], 'id' =>$object_info['id']));
		$this->delete($object_info['id']);
		
		$upload_path = $this->config->item('upload_path');
		$thumb_info = $this->config->item('thumb_config');
		foreach ($thumb_info as $path => $item)
		{
			unlink($upload_path."/".$path.$img->url);
		}
		unlink($upload_path.$img->url);
		
		if(($this->get_count(array("object_id" => $img->object_id)) > 0) && ($img->is_cover == 1))
		{
			$object_info = array(
				"object_type" => $object_info['object_type'],
				"object_id" => $img->object_id
			);
			$images = $this->get_images($object_info);

			if($images) $this->set_cover($object_info, $images[0]->id);
		}	
		return $img->object_id;
	}
}