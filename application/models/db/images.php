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
		$upload_path = $this->config->item('upload_path');
		
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

		//Создаем миниатюры
		if($this->generate_thumbs($img_path)) return FALSE;
		
		$object_info['url'] = $img_info->url;
		$name = explode(".", $img_info->name);
		$object_info['name'] = $name[0];

		return $this->insert($object_info);
	}

	/**
	* Генерация и загрузка миниатур изображений
	* 
	* @param string $img_path
	* @param string $thumb_config_name
	* @return bool
	*/
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
	* Изменение размеров миниатюру
	*
	* @return bool
	*/
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
	
	/**
	* Получение уникальной информации для загрузки изображения
	*
	* @param string $img_name
	*/
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
		
		return $this->get_urls($image);
	}
	
	/**
	* Получение url к изображению и миниатюрам
	*
	* @param object $image
	* @return object
	*/
	private function get_urls($image)
	{
		if($image)
		{
			$thumb_config = $this->config->item('thumb_config');
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
			$item = $this->get_urls($item);
			return $item;
		}			
	}
}