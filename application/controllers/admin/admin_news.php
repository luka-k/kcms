<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Base admin class

class Admin_news extends Admin_Controller 
{

	public function __construct()
	{
		parent::__construct();
	}
	
	function items($id = FALSE)
	{
		$this->menu = $this->menus->set_active($this->menu, 'news');
		
		$name = editors_field_exists('name', $this->news->editors);
		
		$data = array(
			'title' => "Новости",
			'error' => "",
			'user_name' => $this->user_name,
			'user_id' => $this->user_id,
			'menu' => $this->menu,
			'name' => $name,
			'tree' => $this->articles->get_tree(0, "parent_id"),
			'selects' => array(
				'news_parent_id' => $this->categories->get_tree(0, "category_parent_id")
			),
		);	
		
		if ($this->db->field_exists('sort', $type))
		{
			$order = "sort";
			$direction = "asc";
		}
		else
		{
			$order = FALSE;
			$direction = FALSE;
		}
		
		if($id == FALSE)
		{
			$data['content'] = $this->news->get_list(FALSE, $from = FALSE, $limit = FALSE, $order, $direction);
		}
		else
		{
			
			$data['content'] = $this->news->get_list(array("parent_id" => $id), $from = FALSE, $limit = FALSE, $order, $direction);
			$data['sortable'] = TRUE;
		}
		
		
		$this->load->view('admin/items.php', $data);
	}
}