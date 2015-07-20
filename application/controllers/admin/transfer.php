<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Transfer class
*
* @package		kcms
* @subpackage	Controllers
* @category	    transfer
*/
class Transfer extends Admin_Controller 
{
	private $old_db_connection;
	private $_manufacturers;
	private $_categories;
	private $_docs;
	
	public function __construct()
	{
		parent::__construct();
		$this->old_db_connection = mysql_connect('localhost', 'admin_bb', 'aHhCsEyUFR');
		mysql_select_db('admin_bb', $this->old_db_connection);
		mysql_set_charset('utf8', $this->old_db_connection);
		ini_set('display_errors', 1);
		error_reporting(E_ALL);
	}
	
	public function load_manufacturers()
	{
		if (!$this->_categories)
			die('you must load categories first!');
		$q = mysql_query('SELECT * FROM vkr_product ORDER BY name ASC', $this->old_db_connection);
		while ($manufacturer = mysql_fetch_assoc($q))
		{
			$my_categories = array();
			$q_b2p = mysql_query('SELECT * FROM vkr_branch2product WHERE product_id='.$manufacturer['id'], $this->old_db_connection);
			while ($parent = mysql_fetch_assoc($q_b2p))
			{
				if (isset($this->_categories[$parent['branch_id']]) && !$this->_categories[$parent['branch_id']]['is_parent'])
					$my_categories[] = array(
						'id' => $parent['branch_id'],
						'name' => $this->_categories[$parent['branch_id']]['name']
					);
			}
			$images = unserialize($manufacturer['images']);
			$this->_manufacturers[$manufacturer['id']] = array(
				'name' => $manufacturer['name'],
				'url' => $manufacturer['url'],
				'country' => $manufacturer['country'],
				'link' => $manufacturer['link'],
				'email' => $manufacturer['email'],
				'image' => $images[0]['filename'],
				'phone' => $manufacturer['phone'],
				'city' => $manufacturer['city'],
				'categories' => $my_categories
			);
		}
	}
	
	public function transfer_manufacturers()
	{
		foreach ($this->_manufacturers as $manufacturer)
		{
			
			$m = $this->manufacturers->get_item_by(array('name' => strtoupper($manufacturer['name'])));
			if ($m)
			{
				$this->manufacturers->update($m->id, array(
					'url' => $manufacturer['url'],
					'country' => $manufacturer['country'],
					'link' => $manufacturer['link'],
					'email' => $manufacturer['email'],
					'phone' => $manufacturer['phone'],
					'city' => $manufacturer['city']
				));
			} else {
				$this->manufacturers->insert(array(
					'name' => $manufacturer['name'],
					'url' => $manufacturer['url'],
					'country' => $manufacturer['country'],
					'link' => $manufacturer['link'],
					'email' => $manufacturer['email'],
					'phone' => $manufacturer['phone'],
					'city' => $manufacturer['city']
				));
			}
		}
	}
	
	public function transfer_manufacturers_images()
	{
		foreach ($this->_manufacturers as $manufacturer)
		{
			
			$m = $this->manufacturers->get_item_by(array('name' => strtoupper($manufacturer['name'])));
			if ($m)
			{
				/*$this->images->insert(array(
					'object_type' => 'manufacturers',
					'object_id' => $m->id,
					'is_cover' => 1,
					'url' => '/logos/'.$manufacturer['image'],
					'name' => $manufacturer['image']
				));*/
				file_put_contents('/home/admin/web/shop.brightbuild.ru/public_html/download/images/logos/'.$manufacturer['image'],
				file_get_contents('/home/admin/web/test.brightbuild.ru/public_html/upload/cache/'.str_replace('.', '-162x72.', $manufacturer['image'])));
			}
		}
	}
	
	public function transfer_categories()
	{
		foreach ($this->_categories as $category)
		{
			
			$c = $this->categories->get_item_by(array('name' => ($category['name'])));
			if ($c)
			{
				$this->categories->update($c->id, array(
					'name' => $category['name'],
					'url' => $category['url'],
					'accusative_name' => $category['accusative_name'],
					'genitive_name' => $category['genitive_name']
				));
			} else {
				$this->categories->insert(array(
					'name' => $category['name'],
					'url' => $category['url'],
					'accusative_name' => $category['accusative_name'],
					'genitive_name' => $category['genitive_name']
				));
				if ($category['is_parent'])
				{
					$this->db->query('insert into category2category(category_parent_id, child_id) values(0,'.$this->db->insert_id().')');
				}
			}
		}
	}
	
	public function transfer_services()
	{
		foreach ($this->_services as $service)
		{
			
			$c = $this->services->get_item_by(array('name' => ($service['name'])));
			if ($c)
			{
				$this->services->update($c->id, array(
					'name' => $service['name'],
					'url' => $service['url']
				));
			} else {
				$this->services->insert(array(
					'name' => $service['name'],
					'url' => $service['url']
				));
			}
		}
	}
	
	public function transfer_c2c()
	{
		foreach ($this->_categories as $category)
		{
			
			$c = $this->categories->get_item_by(array('name' => ($category['name'])));
			if ($category['parent_id'])
			{
				$c_parent = $this->categories->get_item_by(array('name' => ($this->_categories[$category['parent_id']]['name'])));
				if (!$c_parent)
				{
					echo 'ERROR';var_dump($category);
				} else {
					$q =  $this->db->get_where('category2category', array('category_parent_id' => $c_parent->id, 'child_id' => $c->id));
					if (!$q->result_array)
					{
						$this->db->insert('category2category', array('category_parent_id' => $c_parent->id, 'child_id' => $c->id));
						echo '+';
					} else {
					}
				}
			} 
		}
	}
	
	public function transfer_s2s()
	{
		foreach ($this->_services as $service)
		{
			
			$c = $this->services->get_item_by(array('name' => ($service['name'])));
			if ($service['parent_id'])
			{
				$c_parent = $this->services->get_item_by(array('name' => ($this->_services[$service['parent_id']]['name'])));
				if (!$c_parent)
				{
					echo 'ERROR';var_dump($service);
				} else {
					$this->services->update($c->id, array('parent_id' => $c_parent->id));
				}
			} 
		}
	}
	
	public function load_categories()
	{
		$q = mysql_query('SELECT * FROM vkr_branch ORDER BY level ASC', $this->old_db_connection);
		while ($category = mysql_fetch_assoc($q))
		{
			$q_b2b = mysql_query('SELECT * FROM vkr_branch2branch WHERE child_id='.$category['id'], $this->old_db_connection);
			$parent = mysql_fetch_assoc($q_b2b);
			
			$this->_categories[$category['id']] = array(
				'name' => $category['name'],
				'url' => $category['url'],
				'accusative_name' => $category['name_mn'],
				'genitive_name' => $category['name_rp'],
				'is_parent' => !$category['level'],
				'parent_id' => $parent ? $parent['parent_id'] : false
			);
			
		}
		
	}
	
	public function transfer_m2c()
	{
		$q = mysql_query('SELECT * FROM vkr_branch2product', $this->old_db_connection);
		while ($m2c = mysql_fetch_assoc($q))
		{
			$_c = $this->_categories[$m2c['branch_id']];
			$_m = $this->_manufacturers[$m2c['product_id']];
			$c = $this->categories->get_item_by(array('name' => $_c['name']));
			$m = $this->manufacturers->get_item_by(array('name' => $_m['name']));
			if ($c && $m)
				$this->db->query('insert into manufacturer2category (manufacturer_id, category_id) values ('.$m->id.','.$c->id.')');
		}
		
	}
	public function transfer_m2cg()
	{
		$q = mysql_query('SELECT * FROM vkr_branchv2product', $this->old_db_connection);
		while ($m2c = mysql_fetch_assoc($q))
		{
			$_c = $this->_categories[$m2c['branch_id']];
			$_m = $this->_manufacturers[$m2c['product_id']];
			$c = $this->categories->get_item_by(array('name' => $_c['name']));
			$m = $this->manufacturers->get_item_by(array('name' => $_m['name']));
			if ($c && $m)
				$this->db->query('insert into manufacturer2categorygoods (manufacturer_id, goods_category_id) values ('.$m->id.','.$c->id.')');
		}
		
	}
	
	public function transfer_m2s()
	{
		$q = mysql_query('SELECT * FROM vkr_branchu2product', $this->old_db_connection);
		while ($m2c = mysql_fetch_assoc($q))
		{
			$_c = $this->_services[$m2c['branch_id']];
			$_m = $this->_manufacturers[$m2c['product_id']];
			$c = $this->services->get_item_by(array('name' => $_c['name']));
			$m = $this->manufacturers->get_item_by(array('name' => $_m['name']));
			if ($c && $m)
				$this->db->query('insert into manufacturer2service (manufacturer_id, service_id) values ('.$m->id.','.$c->id.')');
		}
		
	}
	
	public function transfer_m2m()
	{
		$q = mysql_query('SELECT * FROM vkr_saler2product', $this->old_db_connection);
		while ($m2c = mysql_fetch_assoc($q))
		{
			$_c = $this->_manufacturers[$m2c['saler_id']];
			$_m = $this->_manufacturers[$m2c['product_id']];
			$c = $this->manufacturers->get_item_by(array('name' => $_c['name']));
			$m = $this->manufacturers->get_item_by(array('name' => $_m['name']));
			if ($c && $m)
				$this->db->query('insert into manufacturer2manufacturer (distributor, distributor_2) values ('.$m->id.','.$c->id.')');
		}
		
	}
	
	public function transfer_docs()
	{
		$q = mysql_query('SELECT * FROM vkr_document', $this->old_db_connection);
		while ($doc = mysql_fetch_assoc($q))
		{
			$_m = $this->_manufacturers[$doc['manufacturer_id']];
			$m = $this->manufacturers->get_item_by(array('name' => $_m['name']));
			if ($m)
			{
				$this->documents->insert(array(
					'name' => $doc['name'],
					'description' => $doc['description'],
					'doc_type' => $doc['type_id'],
					'manufacturer_id' => $m->id,
					'url' => $doc['link']
				));
				$d = $this->db->insert_id();
				$_q = mysql_query('SELECT * FROM vkr_branch2document WHERE document_id='.$doc['id'], $this->old_db_connection);
				
				while ($b = mysql_fetch_assoc($_q))
				{
					$_c = $this->_categories[$b['branch_id']];
					$c = $this->categories->get_item_by(array('name' => $_c['name']));
					$this->db->insert('document2category', array('document_id' => $d, 'category_id' => $c->id));
				}
				
			}
		}
	}
	
	public function transfer_docs_images()
	{
		$c = 0;
		foreach ($this->documents->get_list(false) as $doc)
		{
			$r = mysql_fetch_assoc(mysql_query('SELECT * FROM vkr_document WHERE link = "'. $doc->url.'"', $this->old_db_connection));
			if (!$r && $doc->id == 468)
				$r =  mysql_fetch_assoc(mysql_query('SELECT * FROM vkr_document WHERE id = 187'));
			if ($r)
			{
				$images = unserialize($r['images']);
				$object_info = array(
					"object_type" => 'documents',
					"object_id" => $doc->id
				);
				if ($this->images->get_item_by($object_info))
				{
					echo '+'; 
					continue;
				}
				foreach($images as $im)
				{
					$c++;
					$img = array('name' => $im['filename'],
								 'tmp_name' => '/home/admin/web/test.brightbuild.ru/public_html/upload/'.$im['filename']);
					if($im['filename'])
						$this->images->upload_image($img, $object_info);
				}
					//file_put_contents('/home/admin/web/shop.brightbuild.ru/public_html/download/images/docs/'.$im['filename'],
				//file_get_contents('/home/admin/web/test.brightbuild.ru/public_html/upload/cache/'.str_replace('.', '-162x72.', $manufacturer['image'])));
			} else echo 'ERROR in '.$doc->id.'<br>'."\n";
			
		}
		echo 'TOTAL: '.$c.'<br>'."\n";
	}
	
	public function transfer_docs_sorts()
	{
		$c = 0;
		foreach ($this->documents->get_list(false) as $doc)
		{
			$r = mysql_fetch_assoc(mysql_query('SELECT * FROM vkr_document WHERE link = "'. $doc->url.'"', $this->old_db_connection));
			if (!$r && $doc->id == 468)
				$r =  mysql_fetch_assoc(mysql_query('SELECT * FROM vkr_document WHERE id = 187'));
			if ($r)
			{
				$this->documents->update($doc->id, array('sort' => $r['sort']));
				echo $r['sort'].' in '.$doc->id.'<br>'."\n";
			} else echo 'ERROR in '.$doc->id.'<br>'."\n";
			
		}
		echo 'TOTAL: '.$c.'<br>'."\n";
	}
	
	public function load_services()
	{
		$q = mysql_query('SELECT * FROM vkr_branchu ORDER BY level ASC', $this->old_db_connection);
		while ($category = mysql_fetch_assoc($q))
		{
			$q_b2b = mysql_query('SELECT * FROM vkr_branchu2branchu WHERE child_id='.$category['id'], $this->old_db_connection);
			$parent = mysql_fetch_assoc($q_b2b);
			
			$this->_services[$category['id']] = array(
				'name' => $category['name'],
				'url' => $category['url'],
				'is_parent' => !$category['level'],
				'parent_id' => $parent ? $parent['parent_id'] : false
			);
			
		}
		
	}
	
	public function test($data)
	{
		echo '<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head><body><pre>';
		$this->load_categories();
		$this->load_manufacturers();
		$this->load_services();
		
		switch ($data)
		{
			case 'docsort':
				$this->transfer_docs_sorts();
				break;
			case 'images':
				$this->transfer_docs_images();
				break;
			case 'manufacturers':
				print_r($this->_manufacturers);
				//$this->transfer_manufacturers();
				break;
			case 'categories':
				print_r($this->_categories);
				$this->transfer_categories();
				
				break;
			case 'services':
				print_r($this->_services);
				$this->transfer_services();
				$this->transfer_s2s();
				break;
			case 'documents':
				$this->transfer_docs();
				break;
		}
		echo "\n\nDONE";
	}
}