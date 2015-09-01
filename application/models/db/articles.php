<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Articles class
*
* @package		kcms
* @subpackage	Models
* @category	    Articles
*/
class Articles extends MY_Model
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
	* можно указывать сразу несколько условий разделяя их вертикальной чертой - |
	* валидация функцией editors_post убрана полность. 
	* позднее расширю js валидацию.
	*/
	public $editors = array(
		'Основное' => array(
			'id' => array('id', 'hidden'),
			'name' => array('Заголовок', 'text', 'trim|htmlspecialchars|name', 'require'),
			'date' => array('Дата', 'date', 'set_date'),
			'parent_id' => array('Родительская категория', 'select'),
			'sort' => array('Сортировка', 'text'),
			'description' => array('Описание', 'tiny')
		),
		'SEO' => array(
			'meta_title' => array('Meta title страницы', 'text', 'trim|htmlspecialchars'),
			'meta_keywords' => array('Ключевые слова страницы', 'text', 'trim|htmlspecialchars'),
			'meta_description' => array('Описание страницы', 'text', 'trim|htmlspecialchars'),
			'url' => array('url', 'text', 'trim|htmlspecialchars|substituted[name]'),
			'changefreq' => array('changefreq', 'text'),
			'priority' => array('priority', 'priority'),
			'lastmod' => array('lastmod', 'hidden')
		),
		'Изображение' => array(
			'upload_double_gallery' => array('Изображение по умолчанию', 'double_images', 'double_img', '', array("Первое изображение" => "first", "Второе изображение" => "second"))
		)
	);
	
	public $admin_left_column = array(
		"items_tree" => "articles_tree",
		"item_tree" => "articles_tree",
	);
	
	function __construct()
	{
        parent::__construct();
	}
	
	/**
	* Получение url статьи
	*
	* @param object $item
	* @return string
	*/
	public function get_url($item)
	{
		$item_url = $this->make_full_url($item);
		$full_url = implode("/", array_reverse($item_url));
		$full_url = base_url().$full_url;
		return $full_url;		
	}
	
	/**
	* Формирование полного url к статье
	*
	* @param object $item
	* @return array
	*/
	public function make_full_url($item)
	{
		$item_url = array();
		if(!empty($item)) 
		{
		
			$item_url[] = $item->url;
		
			while($item->parent_id <> 0)
			{
				$parent_id = $item->parent_id;
				$item = $this->get_item($parent_id);
				$item_url[] = $item->url;
			}
			$item_url[] = 'articles';
		}
		return $item_url;
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
			$item->full_url = $this->get_url($item);
			if(!empty($item->date))
			{
				$item_date = new DateTime($item->date);
				$item_date = date_format($item_date, 'd.m.Y');
				$item->date = $item_date;
			}
			if(isset($item->description)) $item->short_description = $this->string_edit->short_description($item->description);
			return $item;
		}
	}
}