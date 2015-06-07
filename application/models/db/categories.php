<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Categories class
*
* @package		kcms
* @subpackage	Models
* @category	    Categories
*/
class Categories extends MY_Model
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
			'category2category' => array('Родительская категория', 'category2category'),
			'is_active' => array('Активна', 'checkbox'),
			'sort' => array('Сортировка', 'text'),
			'description' => array('Описание', 'tiny')
		),
		'SEO' => array(
			'url' => array('url', 'text', 'trim|htmlspecialchars|substituted[name]'),
			'meta_title' => array('Meta title страницы', 'text', 'trim|htmlspecialchars'),
			'meta_keywords' => array('Ключевые слова страницы', 'text', 'trim|htmlspecialchars'),
			'meta_description' => array('Описание страницы', 'text', 'trim|htmlspecialchars'),
			'accusative_name' => array('В винительном падеже. Купить...', 'text', 'trim|htmlspecialchars'),
			'genitive_name' => array('В родительном падеже. Каталог...', 'text', 'trim|htmlspecialchars'),
			'seo_text' => array('seo_text', 'tiny-2'),
			'changefreq' => array('changefreq', 'text'),
			'priority' => array('priority', 'priority'),
			'lastmod' => array('lastmod', 'hidden')
		),
		'Изображения' => array(
			'upload_image' => array('Загрузить изображение', 'image', 'img')
		)
	);
	
	public $admin_left_column = array(
		"items_tree" => "categories_tree", //дерево для списка элементов
		"item_tree" => "categories_tree", //дерево для страницы редактирования элемента
	);
	
	function __construct()
	{
        parent::__construct();
	}
	
	public function get_tree($products = FALSE, $selected = array(), $type = "site")
	{
		if(!$products) $products = $this->products->get_list(FALSE);
		$filtred_ids = array();
		
		if($products) foreach($products as $p)
		{
			$filtred_ids[] = $p->parent_id;
		}
		
		$tree = $this->_get_tree(0, "category_parent_id", $filtred_ids, $selected);
		
		if($type == "site")foreach($tree as $i => $t)
		{
			if(empty($t->childs)) unset($tree[$i]);
		}
		
		return $tree;
	}
	
	public function _get_tree($parent_id, $parent_id_field, $filtred_ids, $selected = array())
	{
		if(!isset($selected['categories_checked'])) $selected['categories_checked'] = array();//костыли костылики
		
		$items = $this->db->get_where('category2category', array($parent_id_field => $parent_id))->result(); 

		$branches = array();
		if (!empty($items)) foreach($items as $item)
		{
			if($parent_id <> 0)
			{
				$branch = $this->get_item_by(array("id" => $item->child_id));
				if(in_array($item->child_id, $filtred_ids) || in_array($branch->id, $selected['categories_checked'])) $branches[] = $branch;
			}
			else
			{
				$branches[] = $this->get_item_by(array("id" => $item->child_id));
			}
		}
		
		$name = array();
		if (!empty($branches)) 
		{
			foreach($branches as $i => $b)
			{
				$names[$i] = $b->name;
				$branches[$i]->childs = $this->_get_tree($b->id, $parent_id_field, $filtred_ids, $selected);
			}
			array_multisort($names, SORT_ASC, $branches);
		}
		return $branches;	
	}
	
	/**
	* Удаление категории
	* 
	* @param integer $id
	* @return bool
	*/
	public function delete($id)
	{
		$this->db->where("id", $id);
		$this->db->delete($this->_table);
		
		$this->db->where("parent_id", $id);
		$this->db->delete("products");
		
		$this->db->where("category_parent_id", $id);
		$sub_categories = $this->db->get("category2category")->result();
		if($sub_categories) foreach($sub_categories as $item)
		{
			$this->delete($item->child_id);
		}
		
		$this->db->where("category_parent_id", $id);
		$this->db->or_where("child_id", $id);
		$this->db->delete("category2category");
	}
	
	/**
	* Получение url категории
	*
	* @param object $item
	* @return string
	*/
	public function get_url($item)
	{
		$item_full_url = $this->make_full_url($item);
		$full_url = implode("/", array_reverse($item_full_url));
		$full_url = base_url().$full_url;
		return $full_url;		
	}
	
	/**
	* Формирование полного url к категории
	*
	* @param object $item
	* @return array
	*/
	/*public function make_full_url($item)
	{
		$item_url = array();
		$item_url[] = $item->url;
		while($item->parent_id <> 0)
		{
			$parent_id = $item->parent_id;
			$item = $this->get_item($parent_id);
			$item_url[] = $item->url;
		}
		$item_url[] = 'catalog';
		return $item_url;
	}	*/
	
	public function make_full_url($item)
	{
		$item_url = array();
		$item_url[] = $item->url;
		
		$item = $this->categories->get_item_by(array("id" => $item->parent_id));
		$item_url[]  = $item->url;
		$query = $this->db->get_where('category2category', array("child_id" => $item->id)); 
		$c2c = $query->row();
		$item = $this->categories->get_item_by(array("id" => $c2c->category_parent_id));
		$item_url[]  = $item->url;
		$item_url[] = 'catalog';
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
			$item->img = $this->images->get_cover(array('object_type' => 'categories', 'object_id' => $item->id));
			$item->full_url = $this->get_url($item);
			return $item;
		}
	}
}