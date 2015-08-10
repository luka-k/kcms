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
		
		$filtred_ids = array_unique($filtred_ids);
		
		$tree = $this->_get_tree(0, 'category_parent_id', $filtred_ids, $selected);
		
		if($type == 'site')foreach($tree as $i => $t)
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
				$branch = $this->get_item_by(array('id' => $item->child_id));
				if(!empty($branch))
				{
					if(in_array($branch->id, $filtred_ids) || in_array($branch->id, $selected['categories_checked'])) $branches[] = $branch;
				}
			}
			else
			{
				$branches[] = $this->get_item_by(array('id' => $item->child_id));
			}
		}
		
		$name = array();
		if (!empty($branches)) 
		{
			foreach($branches as $i => $b)
			{
				$names[$i] = $b->name;
				$branches[$i]->img = $this->images->get_cover(array('object_type' => 'categories', 'object_id' => $b->id));
				$branches[$i]->childs = $this->_get_tree($b->id, $parent_id_field, $filtred_ids, $selected);
			}
			array_multisort($names, SORT_ASC, $branches);
		}
		return $branches;	
	}
	
	public function get_admin_tree($parent_id)
	{
		$items = $this->db->get_where('category2category', array('category_parent_id' => $parent_id))->result(); 
		
		$branches = array();
		
		if (!empty($items)) foreach($items as $item)
		{
			$branch = $this->get_item_by(array('id' => $item->child_id));
			if(!empty($branch)) $branches[] = $branch;
		}
		
		$name = array();
		if (!empty($branches)) 
		{
			foreach($branches as $i => $b)
			{
				$names[$i] = $b->name;
				$branches[$i]->childs = $this->get_admin_tree($b->id);
			}
			array_multisort($names, SORT_ASC, $branches);
		}
		return $branches;
	}
	
	public function get_another_tree($type = 'catalog')
	{
		$categories_tree = array();
		
		if($type == 'vendor')
		{
			$table = 'manufacturer2categorygoods';
			$field = 'goods_category_id';
		}
		else
		{
			$table = 'manufacturer2category';
			$field = 'category_id';
		}
		
		$categories_ids = array();
		
		$result = $this->db->get($table)->result();
		if($result) foreach($result as $r)
		{
			$categories_ids[] = $r->$field;
		}

		if(!empty($categories_ids))
		{
			$result = $this->db->get_where("category2category", array("category_parent_id" => 0))->result();
			
			if($result)foreach($result as $i => $r)
			{				
				$categories_tree[$i] = $this->categories->get_item($r->child_id);
				
				if (!$categories_tree[$i]->is_active) {unset($categories_tree[$i]);continue;}
				
				$categories_tree[$i]->childs = array();
				
				$this->db->where_in("child_id", $categories_ids);
				$sub_result = $this->db->get_where("category2category", array("category_parent_id" => $r->child_id))->result();
				
				if($sub_result)foreach($sub_result as $j => $s_r)
				{
					$categories_tree[$i]->childs[$j] = $this->prepare($this->get_item($s_r->child_id));
					$categories_tree[$i]->childs[$j]->parent_category_url = $categories_tree[$i]->url;
				}
				
				$volume = array();
				foreach($categories_tree[$i]->childs as $j => $branch)
				{
					$volume[$j]  = $branch->name;
				}

				array_multisort($volume, SORT_ASC, $categories_tree[$i]->childs);
			}
		}
		
		$categories_tree = $this->categories->prepare_list($categories_tree);

		$volume = array();
		foreach($categories_tree as $i => $branch)
		{
			$volume[$i]  = $branch->name;
			$categories_tree[$i] = $this->prepare($branch);
		}

		array_multisort($volume, SORT_ASC, $categories_tree);

		return $categories_tree;
	}
	
	/**
	* Удаление категории
	* 
	* @param integer $id
	* @return bool
	*/
	public function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete($this->_table);
		
		$this->db->where('parent_id', $id);
		$this->db->delete('products');
		
		$this->db->where('category_parent_id', $id);
		$sub_categories = $this->db->get('category2category')->result();
		if($sub_categories) foreach($sub_categories as $item)
		{
			$this->delete($item->child_id);
		}
		
		$this->db->where('category_parent_id', $id);
		$this->db->or_where('child_id', $id);
		$this->db->delete('category2category');
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
	
	public function make_full_url($item)
	{
		$item_url = array();
		
		$item_url[]  = $item->url;
		$query = $this->db->get_where('category2category', array('child_id' => $item->id)); 
		$c2c = $query->row();
		if($c2c) $item = $this->categories->get_item_by(array('id' => $c2c->category_parent_id));
		if($item) $item_url[]  = $item->url;
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