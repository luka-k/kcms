<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Categories extends MY_Model
{
	//Третий параметр указывает как обрабатывать это поле функции editors_post при сохранении 
	//если параметр не указан то htmlspecialchars()
	//если null то присваевается значение 0;
	//если url то значение этого поля при не заполненом url генерится в url
	//	в данном случае это поле name. так можно в настройках указывать поле которое генерится в url без привязок в коде
	//	да и вообще редкатирую editors_post так можно указывать разные полезные ништяки.
	// 	например можно добавить 'no_empty' - поле должно быть заполненым
	//	'no_requerent' - поле должно иметь уникальное имя
	public $editors = array(
		'Основное' => array(
			'id' => array('id', 'hidden'),
			'name' => array('Заголовок', 'text', 'url'),
			'url' => array('url', 'text'),
			'is_active' => array('Активен', 'checkbox'),
			'parent_id' => array('Категория', 'select', 'category2category')
		),
		'Изображения' => array(
			'upload_image' => array('Загрузить изображение', 'upload_2_image'),
			'view_image' => array('Изображение', 'view_image')
		)		
	);
	
	public $full_url = array();
	
	function __construct()
	{
        parent::__construct();
		$this->load->database();
	}
	
	public function get_url($url)
	{
		$this->full_url = NULL;
		$item = $this->categories->get_item_by(array("url" => $url));
		$this->make_full_url($item);
		$this->full_url[] = base_url();
		$full_url = implode("/", array_reverse($this->full_url));
		return $full_url;		
	}
	
	public function make_full_url($item)
	{
		$this->full_url[] = $item->url;
		$item = $this->categories->get_item_by(array("id" => $item->parent_id));
		$this->full_url[] = $item->url;
		$query = $this->db->get_where('category2category', array("child_id" => $item->id)); 
		$c2c = $query->row();
		$item = $this->categories->get_item_by(array("id" => $c2c->parent_id));
		$this->full_url[] = $item->url;
		$this->full_url[] = 'shop';	
	}	
	
	public function get_urls($info)
	{
		foreach($info as $item)
		{
			$item->full_url = $this->get_url($item->url);
		}
		return $info;
	}
}