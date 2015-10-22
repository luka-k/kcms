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
		$tree = array();
		
		if(!$ids) $ids = $this->catalog->get_products_ids($this->products->get_list(FALSE));
		if(!isset($selected['collection_checked'])) $selected['collection_checked'] = array();//костыли костылики
		if(!isset($selected['subcollection_checked'])) $selected['subcollection_checked'] = array();//костыли костылики
		//my_dump($selected['collection_checked']);
		$filtred_ids = array();
		
		$this->db->where_in('child_id', $ids);
		$result = $this->db->get('product2collection')->result();
		foreach($result as $r)
		{
			$filtred_ids[] = $r->collection_parent_id;
		}
		
		$this->benchmark->mark('time_start'); // code start

		$tree = $this->manufacturers->get_list(FALSE, FALSE, FALSE, 'name', 'asc');

		foreach($tree as $i => $branches)
		{
			$collections = $this->collections->get_list(array('manufacturer_id' => $branches->id, 'parent_id' => 0), FALSE, FALSE, 'name', 'asc');
			
			if(empty($collections))
			{
				unset($tree[$i]);
			}
			else
			{
				foreach($collections as $j => $collection)
				{
					$sub_tree = $this->collections->get_list(array('manufacturer_id' => $branches->id, 'parent_id' => $collection->id), FALSE, FALSE, 'name', 'asc');
										
					if($sub_tree) foreach($sub_tree as $k => $b)
					{
						if(!in_array($b->id, $filtred_ids) && !in_array($b->id, $selected['collection_checked'])) unset($sub_tree[$k]);
					}
					
					if(!empty($sub_tree))
					{
						$has_empty = $this->product2collection->get_count(array('collection_parent_id' => $collection->id, 'sub_empty' => 1));
						if($has_empty > 0) 
						{
							$col = clone $collection;
							$col->name = 'не указано';
							array_unshift($sub_tree, $col);
						}
 					}
					
					if(in_array($collection->id, $filtred_ids) || in_array($collection->id, $selected['collection_checked']))
					{
						$collections[$j]->childs = $sub_tree;
					}
					else
					{
						unset($collections[$j]);
					}
				}
				
				if(!empty($collections))
				{
					$tree[$i]->childs = $collections;
				}
				else
				{
					unset($tree[$i]);
				}
			}
		}
		
		$this->benchmark->mark('time_end');
		$code_time = $this->benchmark->elapsed_time('time_start', 'time_end');
		$this->log->put_elapsed_time('общее время веток коллекций', $code_time); //логирование sql
		
		//my_dump($tree);
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