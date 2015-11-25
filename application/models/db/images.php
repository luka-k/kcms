<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Images class
*
* @package		kcms
* @subpackage	Models
* @category	    Images
*/
class Images extends MY_Model
{
	/**
	* $editors = array(
	* 	"Наименование вкладки в админке" = array(
	*		"имя поля в базе" => array("Наименование поля для отображения", "наименования отображения", "условия для функции editors_post()", "условия для js валидации")
	*	)
	* )
	* 
	* "условия для функции editors_post" - функции php принимающие на вход один параметр + функции из библиотеки My_form_validation
	*
	* "условия для js валидации" - поддерживается три условия
	*	reqiure - обязателоно для заполнения
	*	email - коректный email
	*	matches[имя поля] - совпадение со значением поля имя которого указано
	* валидация функцией editors_post убрана полность. 
	* позднее расширю js валидацию.
	*/
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
		$this->config->load('upload');
	}
	
	/**
	* Загрузка изображения
	*
	* @param array $img
	* @param array $object_info
	* @return integer
	*/
	public function upload_image($img, $object_info)
	{
		//Подключаем настройки
		$upload_path = $this->config->item('images_upload_path');
		
		$img_info = $this->get_unique_info($img['name']);
	
		$img_path = trim(make_upload_path($img_info->name, $upload_path).$img_info->name);
		
		if(isset($img['type']))
		{
			//Загружаем оригинал
			if(!move_uploaded_file($img["tmp_name"], $img_path)) return FALSE;
		}
		else
		{
			if(!copy(trim($img["tmp_name"]), $img_path)) return FALSE;
		}
		
		$table = $object_info['object_type'];
		
		$thumbs = array();
		if(isset($this->$table->thumbs))
		{
			$thumbs = $this->$table->thumbs;
			$thumbs[] = 'admin';
		}
		
		//Создаем миниатюры
		if($this->generate_thumbs($img_path, $thumbs))
		{
			// запись в логи
		}		
		else
		{
			$object_info['url'] = $img_info->url;
			$name = explode(".", $img_info->name);
			$object_info['name'] = $name[0];
			$this->insert($object_info);
		}
		return TRUE;
	}

	/**
	* Генерация и загрузка миниатур изображений
	* 
	* @param string $img_path
	* @param string $thumb_config_name
	* @return bool
	*/
	public function generate_thumbs($img_path, $thumbs = array())
	{
		require_once FCPATH.'application/third_party/phpThumb/phpthumb.class.php';

		$upload_path = $this->config->item('images_upload_path');
		$thumb_config = $this->config->item('thumb_config');
		
		if(!empty($thumbs)) foreach ($thumb_config as $thumb_dir_name => $configs) 
		{
			if(!in_array($thumb_dir_name, $thumbs)) unset($thumb_config[$thumb_dir_name]);
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
	
	/**
	* Вставка информации об изображении в базу
	*
	* @param array
	* @return integer
	*/
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
	
	/**
	* Изменение размеров миниатюры
	* 23.07.15 metadiel: добавил переменные для выборочного ресайза
	*
	* @return bool
	*/
	public function resize_all($object_type = false, $thumb_type = false, $only_covers = false)
	{
		$check_array = FALSE;
		if ($object_type)
			$check_array['object_type'] = $object_type;
		if ($only_covers)
			$check_array['is_cover'] = 1;
			
		$images= $this->images->get_list($check_array);
		
		foreach ($images as $image)
		{
      file_put_contents('logs/log-resize_all.log', file_get_contents('logs/log-resize_all.log'). print_r($image, true)."\n"); 
			$upload_path = $this->config->item('images_upload_path');
			$thumb_config = $this->config->item('thumb_config');
			
			$thumbs = array();
			if(!$thumb_type)
			{
				$object_type = $image->object_type;
			
				if(isset($this->$object_type->thumbs))
				{
					$thumbs = $this->$object_type->thumbs;
					$thumbs[] = 'admin';
				}
			
				if(!empty($thumbs)) foreach ($thumb_config as $thumb_dir_name => $configs) 
				{
					if(!in_array($thumb_dir_name, $thumbs)) unset($thumb_config[$thumb_dir_name]);
				}
			}
			
			foreach($thumb_config as $path => $param)
			{
				if (!$thumb_type || $path == $thumb_type)
				{
					$file_path = $upload_path."/".$path.$image->url;
					if(is_file($file_path)) unlink($file_path);
				}
			}
			
			$thumb_type ? $this->generate_thumbs($upload_path . $image->url, array($thumb_type)) : $this->generate_thumbs($upload_path . $image->url, $thumbs);
		}
		return TRUE;
	}
		
	/**
	* Получение обложки элемента
	*
	* @param array $factors
	* @return object
	*/
	public function get_cover($factors = array())
	{
		if(!empty($factors))
		{	
			$factors['is_cover'] = "1";
			$image = $this->get_item_by($factors);
		}
		
		if(empty($image)) $image = $this->get_item_by(array("object_type" => "settings"));

		return $this->get_urls($image, $image->object_type);
	}
	
	/**
	* Получение url к изображению и миниатюрам
	*
	* @param object $image
	* @return object
	*/
	private function get_urls($image, $object_type)
	{
		if($image)
		{
			$thumb_config = $this->config->item('thumb_config');
			
			$thumbs = array();
			if(isset($this->$object_type->thumbs))
			{
				$thumbs = $this->$object_type->thumbs;
				$thumbs[] = 'admin';
			}
			
			if(!empty($thumbs)) foreach ($thumb_config as $thumb_dir_name => $configs) 
			{
				if(!in_array($thumb_dir_name, $thumbs)) unset($thumb_config[$thumb_dir_name]);
			}
			
			foreach($thumb_config as $path => $config)
			{
				
				$url_name = $path."_url";
				$image->$url_name = $this->make_full_url($image->url, $path);
			}
			//Путь к полному изображению
			$image->full_url = $this->make_full_url($image->url);
			return $image;
		}
	}
	
	/**
	*  Получение полного url изображения или миниатюры
	* 
	* @param string $url
	* @param string $path
	* @return string
	*/
	public function make_full_url($url, $path = FALSE)
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
	
	/**
	* Установка обложки элемента
	* 
	* @param array $object_info
	* @param integer $cover_id
	*/
	public function set_cover($object_info, $cover_id)
	{
		$this->db->set('is_cover', 0);
		$this->db->where($object_info);
		$this->db->update('images'); 
		
		$this->db->set('is_cover', 1);
		$this->db->where(array("id" => $cover_id));
		$this->db->update('images');
	}
	
	/**
	* Удаление изображения
	* 
	* @param array $object_info
	* @return integer
	*/
	public function delete_img($object_info)
	{
		$img = $this->get_item_by(array('object_type' => $object_info['object_type'], 'id' =>$object_info['id']));
		$this->delete($object_info['id']);
		
		$upload_path = $this->config->item('images_upload_path');
		$thumb_info = $this->config->item('thumb_config');
		foreach ($thumb_info as $path => $item)
		{
			$file_path = $upload_path."/".$path.$img->url;
			if(is_file($file_path)) unlink($file_path);
		}
		
		if(is_file($file_path)) unlink($upload_path.$img->url);
		
		if(($this->get_count(array("object_id" => $img->object_id)) > 0) && ($img->is_cover == 1))
		{
			$object_info = array(
				"object_type" => $object_info['object_type'],
				"object_id" => $img->object_id
			);
			$images = $this->get_list($object_info);

			if($images) $this->set_cover($object_info, $images[0]->id);
		}	
		return $img->object_id;
	}
	
	/**
	* 
	*
	* @param object $item
	* @return object
	*/
	function prepare($item)
	{
		if(!empty($item))
		{
			if(!is_object($item)) $item = (object)$item;
			$item = $this->get_urls($item, $item->object_type);
			return $item;
		}			
	}
}