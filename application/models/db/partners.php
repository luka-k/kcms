<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Partners extends MY_Model
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
			'id' => array('id', 'hidden', ''),
			'name' => array('Заголовок', 'text', 'trim|required|htmlspecialchars|name'),
			'is_active' => array('Активен', 'checkbox', 'integer'),
			'sort' => array('Сортировка', 'text', ''),
			'url' => array('url', 'text', 'trim|htmlspecialchars|substituted[name]'),
			'description' => array('Описание', 'tiny', '')
		),
		'Изображения' => array(
			'upload_image' => array('Загрузить изображение', 'image_gallery', 'img')
		)
	);
	
	
	function __construct()
	{
        parent::__construct();
	}
	
	function prepare($item)
	{
		if(!empty($item))
		{
			$imgs = $this->images->get_images(array('object_type' => 'partners', 'object_id' => $item->id));
			$item->img = $imgs[0];
			return $item;
		}
	}
}