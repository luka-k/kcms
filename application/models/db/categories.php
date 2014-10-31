<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Categories extends MY_Model
{
	//Третий параметр параметры валидации и обработки для функции editors_post
	//Параметры валидации класса валидации codeignighter
	//+ можно указывать  функции php которые принимают один параметр
	//+ хочу расширить класс валмдации на две функции
	//url - автоматически подставлять значени поля в url если он пуст
	//и для обработки чекбоксов
	//вообще расширая класс валидации можно легко делать обработку любых данных
	//Параметр 'img' используется для обработки изображений
	public $editors = array(
		'Основное' => array(
			'id' => array('id', 'hidden', 'integer'),
			'name' => array('Заголовок', 'text', 'trim|required|htmlspecialchars'),
			'parent_id' => array('Родительская категория', 'select', 'integer'),
			'is_active' => array('Активен', 'checkbox', 'integer'),
			'sort' => array('Сортировка', 'text', 'integer'),
			'description' => array('Описание', 'tiny', '')
		),
		'SEO' => array(
			'meta_title' => array('Meta title страницы', 'text', 'trim|htmlspecialchars'),
			'meta_keywords' => array('Ключевые слова страницы', 'text', 'trim|htmlspecialchars'),
			'meta_description' => array('Описание страницы', 'text', 'trim|htmlspecialchars'),
			'url' => array('url', 'text', 'trim|htmlspecialchars|substituted[name]')
		),
		'Изображения' => array(
			'upload_image' => array('Загрузить изображение', 'image', 'img')
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
		if ($item->parent_id <> 0)
		{
			$item = $this->categories->get_item_by(array("id" => $item->parent_id));
			$this->make_full_url($item);
		}
		else
		{
			$this->full_url[] = 'catalog';
		}
	}	
	
	function prepare($item)
	{
		$item->img = $this->images->get_images(array('object_type' => 'categories', 'object_id' => $item->id), "1");
		if($item->img)
		{
			$item->img->url = $this->images->get_url($item->img->url, "catalog_mid");
		}
		$item->full_url = $this->get_url($item->url);
		return $item;
	}
}