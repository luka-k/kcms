<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Products class
*
* @package		kcms
* @subpackage	Models
* @category	    Products
*/
class Products extends MY_Model
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
			'name' => array('Заголовок', 'text', 'trim|htmlspecialchars|name', 'require'),
			'manufacturer_id' => array('Производитель', 'select'),
			'parent_id' => array('Категория', 'select_parent_id'),
			'collection_parent_id' => array('Коллекция', 'product2collection', 'fixing_2'),
			'manufacturer_id' => array('Производитель', 'select'),
			'is_active' => array('Активна', 'checkbox'),
			'is_new' => array('Новинка', 'checkbox'),
			'is_special' => array('Специальное предложение', 'checkbox'),
			'sku' => array('Артикул', 'text', 'trim|htmlspecialchars', 'require'),
			'price' => array('Цена', 'text', 'trim|htmlspecialchars', 'require'),
			'discount' => array('Скидка', 'text', 'trim|htmlspecialchars', 'max_length[2]'),
			'description' => array('Описание', 'tiny', 'trim')
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
		),
		'Характеристики' => array(
			'characteristics' => array('Редактировать характеристики', 'characteristics', 'ch')
		),
		'Рекомендованые товары' => array(
			'recommend' => array('Редактировать рекомендованые товары', 'recommend', 'recommend')
		)
	);
	
	function __construct()
	{
        parent::__construct();
	}
	
	public $admin_left_column = array(
		"items_tree" => "products_tree", //дерево для списка элементов
		"item_tree" => "products_tree", // дерево для страницы редактирования элемента
	);
	
	/**
	* Получение рекомендованных продуктов
	*
	* @param integer $id
	* @return object
	*/
	public function get_recommended($id)
	{
		$this->db->where('product1_id', $id);
		$this->db->or_where('product2_id', $id); 
		$query = $this->db->get("recommended_products");
		$result = $query->result();
		
		$products_id = array();
		foreach($result as $r)
		{
			$products_id[] = $r->product1_id == $id ? $r->product2_id : $r->product1_id;
		}
		
		$recommended_products = array();
		
		foreach($products_id as $id)
		{
			$recommended_products[] = $this->get_item($id); 
		}
		
		return $recommended_products;
	}
	
	/**
	* Удаление рекомендованных товаров по id товара 
	*
	* @param integer $id
	*/
	public function delete_recommended($id)
	{
		$this->db->where('product1_id', $id);
		$this->db->or_where('product2_id', $id); 
		$this->db->delete("recommended_products");
	}
	
	/**
	* Получение url продукта
	*
	* @param object $item
	* @return string
	*/
	public function get_url($item)
	{
		$item_full_url = $this->categories->make_full_url($item);
		
		$full_url = implode("/", array_reverse($item_full_url));
		$full_url = base_url().$full_url;
		return $full_url;		
	}
	
	/**
	* Получение цены со скидкой
	*
	* @param object $item
	* @return object
	*/
	public function set_sale_price($item)
	{
		/*if(!empty($item->discount))
		{
			$item->sale_price = $item->price*(100 - $item->discount)/100;
		}	*/
		$item->sale_price = $item->price*(100 - $item->discount)/100;
		return $item;
	}
	
	/**
	* 
	*
	* @param object $item
	* @return object
	*/
	function prepare($item, $cover = TRUE)
	{
		if(!empty($item))
		{
			if(!is_object($item)) $item = (object)$item;
			$item->full_url = $this->get_url($item);

			$object_info = array(
				"object_type" => 'products',
				"object_id" => $item->id
			);
			
			if($cover)
			{
				$item->img = $this->images->get_cover($object_info);
			}
			else
			{
				$item->images = $this->images->prepare_list($this->images->get_list($object_info));
			}
			
			$item = $this->set_sale_price($item);
			if(isset($item->description)) $item->description = htmlspecialchars_decode($item->description);
			if(isset($item->description)) $item->short_description = $this->string_edit->short_description($item->description);
			
			//временно костылик
			$item->location = "";
			return $item;
		}			
	}
}
