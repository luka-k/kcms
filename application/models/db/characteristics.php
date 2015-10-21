<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Characteristics class
*
* @package		kcms
* @subpackage	Models
* @category	    Characteristics
*/
class Characteristics extends MY_Model
{
	function __construct()
	{
        parent::__construct();
	}
	
	/**
	* Получение продуктов по фильтру
	*
	* @param array $filter
	* @param string $order
	* @param string $direction
	* @param integer $limit
	* @param integer $from
	* @return array
	*/
	function get_products_by_filter($filter, $order, $direction, $limit = FALSE, $from = FALSE, $null_to_end = FALSE)
	{
		$values = array();
		$id = array();
		$counter = 0;
		$filters_type = $this->characteristics_type->get_list(FALSE);
		
		// Вот тут появилась мысль что весь этот кусок полная херня
		// и можно все решить в 10 раз меньшим количеством строк
		// если в shortdesc и shortname брать не value, а id фильтра.
		// value наверно было разумным вариантом если бы у нас был get запрос
		
		// а анализ логов показал что тут вообщем вообще лажа творится
		
		$pids_by_shortdesc = array();
		$pids_by_shortdesc_1 = array();
		$pids_by_shortdesc_2 = array();
		if(isset($filter['shortdesc']))
		{
			foreach($filter['shortdesc'] as $shortdesc)
			{
				$sd = explode ('//', $shortdesc, 2);
	 			
				$this->benchmark->mark('code_start'); // code start
				
				$this->db->where('type', 'shortname');
				$this->db->where('value', $sd[0]);
				$results = $this->db->get('characteristics')->result();
				
				$this->benchmark->mark('code_end');
				$code_time = $this->benchmark->elapsed_time('code_start', 'code_end');
				$this->log->sql_log('получение id shortname', $code_time); //логирование sql

				$parent_ids = array();
				if(!empty($results)) foreach($results as $r)
				{
					$parent_ids[] = $r->id;
				}
				
				$this->benchmark->mark('code_start'); // code start

				$this->db->where('type', 'shortdesc');
				$this->db->where('value', $sd[1]);
				if($parent_ids) $this->db->where_in('parent_id', $parent_ids);
				$result = $this->db->get('characteristics')->result();
				
				$this->benchmark->mark('code_end');
				$code_time = $this->benchmark->elapsed_time('code_start', 'code_end');
				$this->log->sql_log('получение id shortdesc', $code_time); //логирование sql
				
				$ch_ids = array();
				if(!empty($result))foreach($result as $r)
				{
					$ch_ids[] = $r->id;
				}
				
				if(!empty($ch_ids))
				{
					$this->benchmark->mark('code_start'); // code start
					
					$this->db->where_in('characteristic_id', $ch_ids);
					$result = $this->db->get('characteristic2product')->result();
					
					$this->benchmark->mark('code_end');
					$code_time = $this->benchmark->elapsed_time('code_start', 'code_end');
					$this->log->sql_log('получение id НП по shortname', $code_time); //логирование sql
					
					if(!empty($result))foreach($result as $r)
					{
						$pids_by_shortdesc_1[] = $r->product_id;
					}
				}
				
				
				if(!empty($parent_ids))
				{
					$this->benchmark->mark('code_start'); // code start
					
					$this->db->where_in('characteristic_id', $parent_ids);
					$result = $this->db->get('characteristic2product')->result();
					
					$this->benchmark->mark('code_end');
					$code_time = $this->benchmark->elapsed_time('code_start', 'code_end');
					$this->log->sql_log('получение id НП по shortdesc', $code_time); //логирование sql
					
					if(!empty($result))foreach($result as $r)
					{
						$pids_by_shortdesc_2[] = $r->product_id;
					}
				}
				
				if(!empty($pids_by_shortdesc_1) && !empty($pids_by_shortdesc_2)) $pids_by_shortdesc = $values = array_intersect($pids_by_shortdesc_2, $pids_by_shortdesc_1);
			}
			++$counter;
		}

		if(isset($filter['shortname']))
		{
			$this->benchmark->mark('code_start'); // code start
			
			$this->db->where('type', 'shortname');
			$this->db->where_in('value', $filter['shortname']);
			
			$result = $this->db->get('characteristics')->result();
			
			$this->benchmark->mark('code_end');
			$code_time = $this->benchmark->elapsed_time('code_start', 'code_end');
			$this->log->sql_log('получение id shortname', $code_time); //логирование sql
			
			$ch_ids = array();
			if($result) foreach($result as $r)
			{
				$ch_ids[] = $r->id;
			}
			
			if(!empty($ch_ids))
			{
				$this->benchmark->mark('code_start'); // code start
				
				$this->db->where_in('characteristic_id', $ch_ids);
				$result = $this->db->get('characteristic2product')->result();
				
				$this->benchmark->mark('code_end');
				$code_time = $this->benchmark->elapsed_time('code_start', 'code_end');
				$this->log->sql_log('получение id НП по shortname', $code_time); //логирование sql	
				
				if($result) foreach($result as $r)
				{
					if(!in_array($r->product_id, $pids_by_shortdesc))$values[] = $r->product_id;
				}
			}
			++$counter;
		}
		
		// Конец куска который полная херня!!!!---------------->
		
		// Может и здесь стоит на id фильтра перейти
		foreach($filters_type as $f)
		{
			if($f->url <> 'shortname' && $f->url <> 'shortdesc')
			{
				if(isset($filter[$f->url]))
				{
					$this->benchmark->mark('code_start'); // code start
					
					$this->db->distinct();
					$this->db->where('type', $f->url);
					$this->db->where_in('value', $filter[$f->url]);
					$values = $this->_update_values($values);
					
					$this->benchmark->mark('code_end');
					$code_time = $this->benchmark->elapsed_time('code_start', 'code_end');
					$this->log->sql_log('получение id НП по filters', $code_time); //логирование sql	
				
					++$counter;
				}
			}
		}
		
		// --------------------------->

		if($counter > 1)
		{
			$values = array_count_values($values);
			foreach($values as $key => $counter_value)
			{
				if($counter_value == $counter) $id[] = $key;
			}
		}
		else
		{
			$id = $values;
		}
		
		$this->benchmark->mark('code_start'); // code start

		if(!empty($id) || (empty($id) && $counter == 0))
		{
			$query = "SELECT * FROM products ";
			
			if(!empty($id) || isset($filter['discontinued']) || isset($filter['on_request']) || isset($filter['stock_spb']) || isset($filter['is_sale']) || isset($filter['collection_checked']) || isset($filter['subcollection_checked']) || isset($filter['categories_checked']) || isset($filter['manufacturer_checked']) || isset($filter['sku_checked']) || isset($filter['name']) || isset($filter['width_from']) || isset($filter['height_from']) || isset($filter['depth_from']) || isset($filter['price_from']))
					$query .= "WHERE ";
			
			//my_dump($filter);
			if(!(isset($filter['on_request']) && isset($filter['stock_spb'])))
			{
				if(!isset($filter['on_request']) && !isset($filter['stock_spb'])) return array();
				
				if(isset($filter['on_request']) && $filter['on_request'] == '1')
				{
					$query .= "qty = 0 ";
					if(!empty($id) || isset($filter['discontinued']) || isset($filter['stock_spb']) || isset($filter['is_sale']) || isset($filter['collection_checked']) || isset($filter['subcollection_checked']) || isset($filter['categories_checked']) || isset($filter['manufacturer_checked']) || isset($filter['sku_checked']) || isset($filter['name']) || isset($filter['width_from']) || isset($filter['height_from']) || isset($filter['depth_from']) || isset($filter['price_from']))
						$query .= "AND ";
				}
			
				if(isset($filter['stock_spb']) && $filter['stock_spb'] == '1')
				{
					$query .= "qty != 0 ";
					if(!empty($id) || isset($filter['discontinued']) || isset($filter['collection_checked']) || isset($filter['subcollection_checked']) ||  isset($filter['is_sale']) || isset($filter['categories_checked']) || isset($filter['manufacturer_checked']) || isset($filter['sku_checked']) || isset($filter['name']) || isset($filter['width_from']) || isset($filter['height_from']) || isset($filter['depth_from']) || isset($filter['price_from']))
						$query .= "AND ";
				}
			}
					
			if(isset($filter['is_sale']) && $filter['is_sale'] == '1')
			{
				$query .= "sale = 1 ";
				if(!empty($id) || isset($filter['discontinued']) || isset($filter['collection_checked']) || isset($filter['subcollection_checked']) || isset($filter['categories_checked']) || isset($filter['manufacturer_checked']) || isset($filter['sku_checked']) || isset($filter['name']) || isset($filter['width_from']) || isset($filter['height_from']) || isset($filter['depth_from']) || isset($filter['price_from']))
					$query .= "AND ";
			}
			
			if(isset($filter['discontinued']) && $filter['discontinued'] == '1')
			{
				$query .= "discontinued != '' ";
				if(!empty($id) || isset($filter['collection_checked']) || isset($filter['subcollection_checked']) ||  isset($filter['categories_checked']) || isset($filter['manufacturer_checked']) || isset($filter['sku_checked']) || isset($filter['name']) || isset($filter['width_from']) || isset($filter['height_from']) || isset($filter['depth_from']) || isset($filter['price_from']))
					$query .= "AND ";
			}
			
			if(isset($filter['collection_checked']) && isset($filter['subcollection_checked']))
			{
				$this->db->where_in('collection_parent_id', $filter['collection_checked']);
				$this->db->or_where_in('collection_parent_id', $filter['subcollection_checked']);
				$this->db->select('child_id');
				$ids = $this->db->get('product2collection')->result();
				
				$ids_by_collection = array();
				foreach($ids as $item)
				{
					$ids_by_collection[] = $item->child_id;
				}

				$query .= $this->_set_where_in('id', $ids_by_collection);
				
				if(!empty($id) || isset($filter['categories_checked']) || isset($filter['manufacturer_checked']) || isset($filter['sku_checked']) || isset($filter['name']) || isset($filter['width_from']) || isset($filter['height_from']) || isset($filter['depth_from']) || isset($filter['price_from']))
					$query .= "AND ";
			}
			else
			{
				if(isset($filter['collection_checked']))
				{
					$this->db->where_in('collection_parent_id', $filter['collection_checked']);
					$this->db->where('is_main', 1);
					$this->db->select('child_id');
					$ids = $this->db->get('product2collection')->result();
				
					$ids_by_collection = array();
					foreach($ids as $item)
					{
						$ids_by_collection[] = $item->child_id;
					}

					$query .= $this->_set_where_in('id', $ids_by_collection);
				
					if(!empty($id) || isset($filter['subcollection_checked']) || isset($filter['categories_checked']) || isset($filter['manufacturer_checked']) || isset($filter['sku_checked']) || isset($filter['name']) || isset($filter['width_from']) || isset($filter['height_from']) || isset($filter['depth_from']) || isset($filter['price_from']))
						$query .= "AND ";
				}
			
				if(isset($filter['subcollection_checked']))
				{
					$this->db->where_in('collection_parent_id', $filter['subcollection_checked']);
					$this->db->where('sub_empty', 1);
					$has_empty = $this->db->get('product2collection')->result();
					$has_empty_ids = array();
					if(!empty($has_empty)) foreach($has_empty as $h_e)
					{
						$has_empty_ids = $h_e->collection_parent_id;
					}
					
					$this->db->where_in('collection_parent_id', $filter['subcollection_checked']);
					$this->db->where('is_main', 0);
					if(!empty($has_empty_ids))
					{					
						$this->db->or_where_in('collection_parent_id', $has_empty_ids);
						$this->db->where('sub_empty', 1);
					}
					$this->db->select('child_id');
					$ids = $this->db->get('product2collection')->result();
				
					$ids_by_collection = array();
					foreach($ids as $item)
					{
						$ids_by_collection[] = $item->child_id;
					}

					$query .= $this->_set_where_in('id', $ids_by_collection);
				
					if(!empty($id) || isset($filter['categories_checked']) || isset($filter['manufacturer_checked']) || isset($filter['sku_checked']) || isset($filter['name']) || isset($filter['width_from']) || isset($filter['height_from']) || isset($filter['depth_from']) || isset($filter['price_from']))
						$query .= "AND ";
				}
			
			}
			
			if(!empty($id))
			{
				$query .= $this->_set_where_in('id', $id);
				
				if(isset($filter['categories_checked']) || isset($filter['manufacturer_checked']) || isset($filter['sku_checked']) || isset($filter['name']) || isset($filter['width_from']) || isset($filter['height_from']) || isset($filter['depth_from']) || isset($filter['price_from']))
					$query .= "AND ";
			}
			
			if(isset($filter['categories_checked']) && $filter['categories_checked'])
			{
				$query .= $this->_set_where_in('parent_id', $filter['categories_checked']);
				
				if(isset($filter['manufacturer_checked']) || isset($filter['sku_checked']) || isset($filter['name']) || isset($filter['width_from']) || isset($filter['height_from']) || isset($filter['depth_from']) || isset($filter['price_from']))
					$query .= "AND ";
			}
			
			if(isset($filter['manufacturer_checked']))
			{
				$query .= $this->_set_where_in('manufacturer_id', $filter['manufacturer_checked']);
				
				if(isset($filter['sku_checked']) || isset($filter['name']) || isset($filter['width_from']) || isset($filter['height_from']) || isset($filter['depth_from']) || isset($filter['price_from']))
					$query .= "AND ";
			}
			
			if(isset($filter['sku_checked']))
			{
				$query .= $this->_set_where_in('sku', $filter['sku_checked']);

				if(isset($filter['name']) || isset($filter['width_from']) || isset($filter['height_from']) || isset($filter['depth_from']) || isset($filter['price_from']))
					$query .= "AND ";
			}
			
			if(isset($filter['name']))
			{
				$query .= "name LIKE '%{$filter['name']}%' ";
				
				if(isset($filter['width_from']) || isset($filter['height_from']) || isset($filter['depth_from']) || isset($filter['price_from']))
					$query .= "AND ";
			}
			
			if(isset($filter['width_from']))
			{
				$query .= $this->_set_range('width', $filter['width_from'], $filter['width_to']);
				
				if(isset($filter['height_from']) || isset($filter['depth_from']) || isset($filter['price_from']))
					$query .= "AND ";
			}
			
			if(isset($filter['height_from']))
			{
				$query .= $this->_set_range('height', $filter['height_from'], $filter['height_to']);

				if(isset($filter['depth_from']) || isset($filter['price_from']))
					$query .= "AND ";
			}
			
			if(isset($filter['depth_from']))
			{
				$query .= $this->_set_range('depth', $filter['depth_from'], $filter['depth_to']);
				if(isset($filter['price_from']))
					$query .= "AND ";
			}
			
			if(isset($filter['price_from']))
				$query .= $this->_set_range('sale_price', $filter['price_from'], $filter['price_to']);

			if($order == "price")
			{
				$query .= "ORDER BY CASE WHEN sale_price = '0' THEN '99999999999' END, sale_price {$direction} ";			
			}
			else
			{
				$query .= "ORDER BY {$order} {$direction} ";
			}
			
			if($limit <> FALSE) $query .= "LIMIT {$from}, {$limit}";
			
			// следующая строчка фиксит баг который возникал при апдэйте кэша когда есть пустая ГТ1 
			if (!strstr($query, 'WHERE ORDER'))
				$result = $this->db->query($query)->result();
			
			$this->benchmark->mark('code_end');
			$code_time = $this->benchmark->elapsed_time('code_start', 'code_end');
			$this->log->sql_log('получение НП по фильтрам', $code_time); //логирование sql	
			
			if(!empty($result)) return $result;
		}
	
		return array();
	}
	
	/**
	* Фильтр по условию и обновление списка id продуктов соответствующих фильтрации
	*
	* @param array $values
	* @return array
	*/
	protected function _update_values($values)
	{
		$results = $this->db->get('characteristics')->result();
	
		$ch_ids = array();
		if($results) foreach($results as $r)
		{
			$ch_ids[] = $r->id;
		}
			
		if(!empty($ch_ids))
		{
			$this->db->where_in('characteristic_id', $ch_ids);
			$results = $this->db->get('characteristic2product')->result();
			if($results) foreach($results as $r)
			{
				$values[] = $r->product_id;
			}
		}
		
		return $values;
	}
	
	protected function _set_where_in($field, $values)
	{
		$value_string = "(";
		$i = 1;
		foreach($values as $v)
		{
			$value_string = $value_string."'".$v."'";
			if($i <> count($values)) $value_string .= ", ";
			$i++;
		}
		$value_string .= ")";

		$query_string = "{$field} IN {$value_string} ";
		
		return $query_string;
	}
	
	protected function _set_range($type, $from, $to)
	{
		$from = preg_replace('/[^0-9]/', '', $from);
		$to = preg_replace('/[^0-9]/', '', $to);
				
		$querry_string = "{$type} BETWEEN {$from} AND {$to} ";
		return $querry_string;
	}
	
	public function get_product_characteristics($item)
	{
		$this->db->select('characteristic_id');
		$this->db->where('product_id', $item->id);
		$result = $this->db->get('characteristic2product')->result();
		
		$ch_ids = array();
		if($result) foreach($result as $r)
		{
			$ch_ids[] = $r->characteristic_id;
		}
		
		$this->_set_param($ch_ids, 'color');
		$item->color = $this->db->get('characteristics')->result();
	
		
		$this->_set_param($ch_ids, 'material');
		$item->material = $this->db->get('characteristics')->result();
		
		$this->_set_param($ch_ids, 'shortname');
		$item->shortname = $this->db->get('characteristics')->row();
		
		$this->_set_param($ch_ids, 'shortdesc');
		$item->shortdesc =  $this->db->get('characteristics')->result();
		
		$this->_set_param($ch_ids, 'finishing');
		$item->finishing = $this->db->get('characteristics')->result();
		
		$this->_set_param($ch_ids, 'turn');
		$item->turn = $this->db->get('characteristics')->result();
		
		return $item;
	}
	
	protected function _set_param($ch_ids, $param)
	{
		$this->db->select('value');
		$this->db->where('type', $param);
		if($ch_ids) $this->db->where_in('id', $ch_ids);
	}
}