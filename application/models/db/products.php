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
			'product2collection' => array('Коллекция', 'product2collection'),
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
		'Аналогичные' => array(
			'recommended' => array('Редактировать рекомендованые товары', 'anchor', 'recommended')
		),
		'Комплектующие' => array(
			'components' => array('Редактировать компоненты', 'anchor', 'components')
		),
		'Запчасти' => array(
			'accessories' => array('Редактировать запчасти', 'anchor', 'accessories')
		)
	);
	
	function __construct()
	{
        parent::__construct();
	}
	
	public $admin_left_column = array(
		'items_tree' => 'products_tree', //дерево для списка элементов
		'item_tree' => 'products_tree', // дерево для страницы редактирования элемента
	);
	
	/**
	* Получение рекомендованных продуктов
	*
	* @param integer $id
	* @return object
	*/
	public function get_anchor($id, $base)
	{
		$anchor_products = array();
	
		$this->db->where('product1_id', $id);
		//$this->db->or_where('product2_id', $id); //Если надо сделать привязку только в одну сторону убрать эту строку
		$query = $this->db->get($base.'_products');
		$result = $query->result();
		
		$products_id = array();
		foreach($result as $r)
		{
			$products_id[] = $r->product1_id == $id ? $r->product2_id : $r->product1_id;
		}
		
		foreach($products_id as $id)
		{
			$anchor_products[] = $this->get_item($id); 
		}
		
		return $anchor_products;
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
		$this->db->delete('recommended_products');
	}
	
	/**
	* Получение url продукта
	*
	* @param object $item0
	* @return string
	*/
	public function get_url($item)
	{
		$item_full_url[] = $item->url;
		
		$item = $this->categories->get_item_by(array('id' => $item->parent_id));
		
		$item_full_url = array_merge($item_full_url, $this->categories->make_full_url($item));
		
		$full_url = implode('/', array_reverse($item_full_url));
		$full_url = base_url().$full_url;
		return $full_url;		
	}
	
	public function set_ranging($product)
	{
		$rang = 0;
		
		$img_count = $this->images->get_count(array('object_type' => 'products', 'object_id' => $product->id));
		if($img_count > 0) $rang = $rang + 10000;

		$manufacturer = $this->manufacturers->get_item($product->manufacturer_id);
		if($manufacturer->is_ranging) $rang = $rang + 10000;
		
		$rang = $rang + rand(0, 1000);
		
		return $rang;
	}
	
	/**
	* Получение цены со скидкой
	*
	* @param object $item
	* @return object
	*/
	public function set_sale_price($item)
	{
		if(isset($item->discount))
		{
			$item->sale_price = $item->price*(100 - $item->discount)/100;
		}

		return $item;
	}
	
	/**
	* 
	*
	* @param object $item
	* @return object
	*/
	function prepare($item, $cover)
	{
		if(!empty($item))
		{
			$item->full_url = $this->get_url($item);
			
			$item->price = round($item->price, -1);
			if(isset($item->sale_price))
			{		
				$item->sale_price = round($item->sale_price, -1);
				if($item->price <> 0) $item->discount = round(($item->price - $item->sale_price) * 100 / $item->price);
			}
			
			if($cover)
			{
				$item->img = $this->images->get_cover(array('object_type' => 'products', 'object_id' => $item->id));
			}
			else
			{
				$item->images = $this->images->prepare_list($this->images->get_list(array('object_type' => 'products', 'object_id' => $item->id), 0, 0, 'is_cover', 'desc'));
			}
			
			if(isset($item->description)) $item->description = htmlspecialchars_decode($item->description);
			if(isset($item->description)) $item->short_description = $this->string_edit->short_description($item->description);
			
			$item = $this->characteristics->get_product_characteristics($item);
			
			if(isset($item->manufacturer_id)) $item->manufacturer_name = $this->manufacturers->get_item($item->manufacturer_id)->name;

			$item->collection_name = array();
			
			$result = $this->db->get_where("product2collection", array('child_id' => $item->id))->result();
			$main_collection = '';
			$sub_collections = array();
			$main_series = '';
			$sub_series = array();
			
			if($result) foreach($result as $r)
			{
				if($r->is_collection)
				{
					if ($r->is_main)
						$main_collection = $this->collections->get_item($r->collection_parent_id)->name;
					else 
						$sub_collections[] = $this->collections->get_item($r->collection_parent_id)->name;
				}
				else
				{
					if ($r->is_main)
						$main_series[] = $this->collections->get_item($r->collection_parent_id)->name;
					else 
						$sub_series[] = $this->collections->get_item($r->collection_parent_id)->name;
				}
			}
			$item->collection_name = $main_collection;
			
			if($main_series) 
				$item->serie_name = implode(' ', $main_series);
				
			if ($sub_collections)
				$item->sub_collections = implode(' ', $sub_collections);

			if ($sub_series)
				$item->sub_series = implode(' ', $sub_series);
		/*	my_dump($item->collection_name);
			my_dump($item->sub_collections);
			my_dump($item->serie_name);
			my_dump($item->sub_series);*/
			$sizes = array();
			if (isset($item->width) && $item->width)
				$sizes[] = $item->width;
			if (isset($item->height) && $item->height)
				$sizes[] = 'h'.$item->height;
			if (isset($item->depth) && $item->depth)
				$sizes[] = $item->depth;
			$item->sizes_string = implode('x',$sizes);
	
			$item->location = '';
			return $item;
		}			
	}
}
