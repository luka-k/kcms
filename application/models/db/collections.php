<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Collections class
*
* @package		kcms
* @subpackage	Models
* @category	    Collections
*/
class Collections extends MY_Model
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
			'parent_id' => array('Родительская категория', 'select'),
			'manufacturer_id' => array('Производитель', 'select'),
			'is_collection' => array('Колекция', 'checkbox'),
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
		)
	);
	
	public $admin_left_column = array(
		'items_tree' => 'collections_tree',
		'item_tree' => 'collections_tree',
	);
	
	function __construct()
	{
        parent::__construct();
	}
	
	public function get_tree($ids = FALSE, $selected = array())
	{	
		$this->log->put_message('---COLLECTION_TREE organization START---');
		
		$tree = array();
		
		if(!$ids) $ids = $this->catalog->get_products_ids($this->products->get_list(FALSE));
		if(!isset($selected['manufacturers_checked'])) $selected['manufacturers_checked'] = array();//костыли костылики
		if(!isset($selected['collection_checked'])) $selected['collection_checked'] = array();//костыли костылики
		if(!isset($selected['subcollection_checked'])) $selected['subcollection_checked'] = array();//костыли костылики
		
		$this->db->where_in('child_id', $ids);
		$this->db->select('collection_parent_id');
		$this->db->select('is_main');
		$result = $this->db->get('product2collection')->result();
		
		if(empty($result)) return $tree;

		$subcol_ids = array();
		$col_ids = array();
		foreach($result as $r)
		{
			if($r->is_main)
			{
				$col_ids[] = $r->collection_parent_id;
				
			}
			else
			{
				$subcol_ids[] = $r->collection_parent_id;
			}
		}

		if(isset($selected['subcollection_checked'])) $subcol_ids = array_merge($subcol_ids, $selected['subcollection_checked']);	
		if(isset($selected['collection_checked'])) $col_ids = array_merge($col_ids, $selected['collection_checked']);

		if(!empty($subcol_ids))
		{
			$this->db->where_in('id', array_unique($subcol_ids));
			$this->db->order_by('name', 'asc');
			$subcollections = $this->db->get('collections')->result();
		
			if(empty($subcollections)) return $tree;
			
			$subcol_by_parent = array();
			foreach($subcollections as $sub_col)
			{
				$col_ids[] = $sub_col->parent_id;
				$subcol_by_parent[$sub_col->parent_id][] = $sub_col;
			}
		}
		
		if(empty($col_ids)) return $tree;
		
		$this->db->where_in('id', array_unique($col_ids));
		$this->db->order_by('name', 'asc');	
		$collections = $this->db->get('collections')->result();	

		if(empty($collections)) return $tree;
		
		$man_ids = array();
		$col_by_parent = array();
		foreach($collections as $col)
		{
			$man_ids[] = $col->manufacturer_id;
			$col_by_parent[$col->manufacturer_id][] = $col;
		}
		
		if(isset($selected['manufactureers_checked'])) $man_ids = array_merge($man_ids, $selected['manufactureers_checked']);
		
		$this->db->where_in('id', $man_ids);
		$this->db->order_by('name', 'asc');	
		$manufacturers = $this->db->get('manufacturers')->result();	

		if(empty($manufacturers)) return $tree;
		
		$this->db->where_in('product_id', $ids);
		$result = $this->db->get('empty_subcollections')->result();
		
		$has_empty_ids = array();
		if($result) foreach($result as $r)
		{
			$has_empty_ids[] = $r->parent_collection_id;
		}
		
		//Y7L1
		//my_dump($has_empty_ids);

		foreach($manufacturers as $m)
		{
			if(isset($col_by_parent[$m->id]))
			{
				$m_cols = $col_by_parent[$m->id];

				foreach($m_cols as $key => $m_c)
				{
					//$col = new stdClass();
					if(in_array($m_c->id, $has_empty_ids))
					{
						$col = clone $m_c;
						$col->name = 'не указано';
						//array_unshift($sub_tree, $col);
					}
					
					if(isset($subcol_by_parent[$m_c->id]))
					{
						$sub_tree = $subcol_by_parent[$m_c->id];
						if(!empty($col)) 
						{
							array_unshift($sub_tree, $col);
							unset($col);
						}
						$m_cols[$key]->childs = $sub_tree;
					}
					else
					{
						$m_cols[$key]->childs = array();
					}
				}
			
				$m->childs = $m_cols;
			
				$tree[] = $m;
			}
		}
		//my_dump($tree);		
		$this->log->put_message('---COLLECTION_TREE organization STOP---');
		return $tree;
	}
	
	private function _get_tree($parent_id, $filtred_ids, $selected)
	{
		if(!isset($selected['collection_checked'])) $selected['collection_checked'] = array();//костыли костылики
		
		$branches = $this->get_list(array('parent_id' => $parent_id), FALSE, FALSE, 'name', 'asc');
		
		$branches = $this->prepare_list($branches);

		if ($branches) foreach ($branches as $i => $b)
		{
			$sub_tree = $this->_get_tree($b->id, $filtred_ids, $selected);
			if(!empty($sub_tree) || in_array($b->id, $filtred_ids) || in_array($b->id, $selected['collection_checked']))
			{
				$branches[$i]->childs = $sub_tree;
			}
			else
			{
				unset($branches[$i]);
			}
		}		
		return $branches;
	}
	
	public function get_products_by_collection($collection_id, $from, $limit, $order, $direction)
	{
		$products = array();
		
		$products_ids = $this->table2table->get_parent_ids('product2collection', 'child_id', 'collection_parent_id', $collection_id);
		if(!empty($products_ids))
		{
			$this->db->where_in('id', $products_ids);
			if($limit) $this->db->limit($limit, $from);
			if($order) $this->db->order_by($order, $direction);
			$products = $this->db->get('products')->result();
		}
		
		return $products;
	}
                                                                                                                                                       
	function prepare($item)
	{
		return $item;
	}
}