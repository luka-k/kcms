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
			'sort' => array('Сортировка', 'hidden'),
			'short_description' => array('Краткое описание', 'tiny'),
			'description' => array('Описание', 'tiny'),
			'price' => array('Таблица цен', 'tiny'),
			'faq' => array('faq', 'tiny'),
			'bottom_text' => array('Текст внизу', 'tiny')
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
		'Изображения' => array(
			'upload_image' => array('Загрузить изображение', 'image_gallery', 'img')
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
			
			$object_info = array(
				"object_type" => 'articles',
				"object_id" => $item->id
			);
			
			$item->img = $this->images->get_cover($object_info);
			
			if(!empty($item->faq)) $item->faq = $this->prepare_faq($item->faq);
			
			return $item;
		}
	}
	
	protected function prepare_faq($faq)
	{
		$faq = str_replace("<p>[Q:]", "[Q:]", $faq);
		$faq = str_replace("[/Q]</p>", "[/Q]", $faq);
		$faq = str_replace("<p>[A:]", "[A:]", $faq);
		$faq = str_replace("[/A]</p>", "[/A]", $faq);
		$faq = str_replace("</div>", "</div></div>", $faq);
		$faq = preg_replace("!\[Q:\](.*?)\[/Q\]!si", "<h2>\\1</h2>", $faq);
		$faq = preg_replace("!\[A:\](.*?)\[/A\]!si", "<div class='block'>\\1 </div>", $faq);
		$faq = str_replace("<h2>", "<div class='spoiler close'><h2>", $faq);
		$faq = str_replace("</div>", "</div></div>", $faq);

		return $faq;
	}
}