<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Menu model class

class Menu_model extends CI_Model{

    function __construct()
	{
        parent::__construct();
		$this->load->database();
	}
	
	function get_cat()
	{
		//Выбираем данные из БД
		$result=mysql_query("SELECT * FROM  categories");

		//Если в базе данных есть записи, формируем массив
		if   (mysql_num_rows($result) > 0)
		{
			$cats = array();
			//В цикле формируем массив разделов, ключом будет id родительской категории, а также массив разделов, ключом будет id категории
			while($cat =  mysql_fetch_assoc($result))
			{

				$cats[$cat['root']][$cat['id']] =  $cat;
			}
			
		}
		return $cats;
	}
	
	function build_tree($cats, $parent_id)
	{
    if(is_array($cats) and isset($cats[$parent_id]))
	{
        $tree = '<ul>';
        foreach($cats[$parent_id] as $cat)
		{
            $tree .= '<li><a href="'.base_url().'admin/pages/'.$cat['id'].'">'.$cat['title'].'</a>';
			//if ($this->build_tree($cats,$cat['id'])<>NULL)
			//{
				//$tree .= '<span class="up"><i class="icon-sort-down"></i></span>';
			//}
            $tree .=  $this->build_tree($cats, $cat['id']);
            $tree .= '</li>';
        }
		$tree .= '</ul>';
    }
    else return null;
    return $tree;
	}
	
	/*Получение всех меню которые есть на сайте*/
	public function get_menus()
	{
		$query = $this->db->get('menus');
		return $query->result_array();	
	}
	
	/*ПОлучение информации о конкретном меню по ID*/
	public function get_menu($id)
	{
		$query = $this->db->get_where('menus', array('id' => $id));
		return $query->row_array();	
	}
	
	/*ПОлучить ссылки определенного меню*/
	public function get_links($id)
	{
		$query = $this->db->get_where('menus_data', array('menu_id' => $id));
		return $query->result_array();		
	}
	
	public function get_link($id)
	{
		$query = $this->db->get_where('menus_data', array('id' => $id));
		return $query->row_array();		
	}
	
	//Добавление страницы
	public function edit_menu($menu_data)
	{
		if ($menu_data['id']==0)
		{
			$data = array(
				'title' => $menu_data['title'],
				'name' => $menu_data['name'],
				'status' => $menu_data['status']
			);
			$this->db->insert('menus', $data); 
		}
		else
		{
			$sql = "UPDATE menus SET name = ?, title = ?, status=? WHERE id=?";
			$query = $this->db->query($sql, array($menu_data['name'], $menu_data['title'], $menu_data['status'], $menu_data['id']));	
		}
	}	
	
	
	public function delete_menu($id)
	{
		$query = $this->db->delete('menus', array('id' => $id)); 
		return $query;
	}
	
	public function edit_link($link)
	{
		if ($link['id']==0)
		{
			$this->db->insert('menus_data', $link);
		}
		else
		{
			$sql = "UPDATE menus_data SET item_type = ?, hidden = ? , title=?, url=? WHERE id=?";
			$query = $this->db->query($sql, array($link['item_type'], $link['hidden'], $link['title'], $link['url'], $link['id']));	
		}
	}
	
	public function get_url($id, $item_type)
	{
		if ($item_type == 1)
		{
			$table = "pages";
		}
		elseif ($item_type == 2)
		{
			$table = "categories";
		}
		$this->db->select('url');
		$query = $this->db->get_where($table, array('id' => $id));
		$url =  $query->row_array();
		return $url['url'];
	}
	
	public function view_menu($menu_name)
	{
		$this->db->select('id');
		$query = $this->db->get_where('menus', array('name' => $menu_name));
		$id = $query->row_array();
		$menu_id = $id['id'];
		$query = $this->db->get_where('menus_data', array('menu_id' => $menu_id));
		$menu = $query->result_array();
		
		foreach ($menu as $menu_item)
		{
			if ($menu_item['item_type'] == 1)
			{
				$url = base_url()."page/".$menu_item['url'];

			}
			else if ($menu_item['item_type'] == 2)
			{
				$url = base_url()."category/".$menu_item['url'];
			}
			$menu_info[$menu_item['id']] = array(
				'title' => $menu_item['title'],
				'url' => $url
			);
		}
		$data['menu'] = $menu_info;
		$this->load->view('client/menu', $data);
	}
	
	
	function menu($parent_id)
	{
		$cats = $this->get_cat();
		$tree = '<ul>';
		$tree .= '<li><a href="'.base_url().'admin/pages/0">Без категории</a></li>';
		$tree .= '</ul>';
		$tree .= $this->build_tree($cats, $parent_id);
		return $tree;
	}
}

/* End of file admin_model.php */
/* Location: ./application/model/task_4/admin*/