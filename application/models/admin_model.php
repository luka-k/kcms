<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Admin model class

class Admin_model extends CI_Model {

    function __construct()
	{
        parent::__construct();
		$this->load->database();
	}
	
	//Получение всех страниц
	public function get_pages($cat_id=false)
	{
		if($cat_id===false)
		{
			$query = $this->db->get('pages');
		}
		else
		{
			$this->db->where('cat_id', $cat_id);
			$query = $this->db->get('pages');
		}
		return $query->result_array();
	}
	
	//Получение страницы по id
	public function get_page($id)
	{
		$query = $this->db->get_where('pages', array('id' => $id));
		$data = $query->row_array();
		return $data;
	}
	
	//Удаление страницы
	public function delete_page($id)
	{
		$query = $this->db->delete('pages', array('id' => $id)); 
		return $query;
	}
	
	//Удаление категории (я думаю надо объеденить с предидущей функцией)
	public function delete_cat($cat_id)
	{
		$query = $this->db->delete('categories', array('id' => $cat_id)); 
		return $query;
	}
	
	//Редактирование страницы
	public function edit_page($page)
	{
		$sql = "UPDATE pages SET cat_id = ?, title = ? , meta_title=?, keywords=?, description=?, url = ?, full_text = ?, status=?, autor=?, publish_date=? WHERE id=?";
		$query = $this->db->query($sql, array($page['cat_id'], $page['title'], $page['meta_title'], $page['keywords'], $page['description'], $page['url'], $page['full_text'], $page['status'], $page['autor'], $page['publish_date'], $page['id']));	
	}
	
	//Добавление страницы
	public function add_page($page)
	{
		$data = array(
			'title' => $page['title'],
			'url' => $page['url'],
			'meta_title' => $page['meta_title'],
			'full_text' => $page['full_text']
		);
		$this->db->insert('pages', $data); 
	}
	
	public function get_cat()
	{
		$query = $this->db->get('categories');
		return $query->result_array();	
	}

	//Получение категории по id
	public function get_cat_info($cat_id)
	{
		$query = $this->db->get_where('categories', array('id' => $cat_id));
		$data = $query->row_array();
		return $data;
	}
	
	//Редактирование страницы
	public function edit_cat($cat_info)
	{
		$sql = "UPDATE categories SET title = ?, cat_desc = ?, url = ?, root=? WHERE id=?";
		$query = $this->db->query($sql, array($cat_info['title'], $cat_info['cat_desc'], $cat_info['url'], $cat_info['root'], $cat_info['id']));	
	}
	
	//Добавление страницы
	public function add_cat($cat_info)
	{
		$data = array(
			'title' => $cat_info['title'],
			'cat_desc' => $cat_info['cat_desc'],
			'url' => $cat_info['url'],
			'root' => $cat_info['root']
		);
		$this->db->insert('categories', $data); 
	}
	
	//Добавление картинки в базу
	public function edit_img($img_name, $id)
	{
		$sql = "UPDATE pages SET image = ? WHERE id=?";
		$query = $this->db->query($sql, array($img_name, $id));
	}
	
	//ФОрмирование пути к картинке
	function make_img_path($file_name, $upload_path)
	{
		//Преобразуем имя файла в массив каждый элемент которого содержит один символ имени.
		$updir_name = str_split($file_name);
		for($i=0; $i<2; $i++)
		{
			$upload_path = $upload_path. "/" .$updir_name[$i];
		}
		return $upload_path;	
	}
	
	//Проверка если у этой статьи картинка. Начинаю подозревать что как токова не нужна.	
	public function if_img($id = FALSE)
	{
		if ($id)
		{
			$this->db->select('image');
			$query = $this->db->get_where('pages', array('id' => $id));
			$res = $query->row_array();
			if(!empty($res['image']))
			{
				return TRUE;
			}
			else
			{
				return FALSE;
			}
		}
		else
		{
			return FALSE;
		}
	}
	
	public function get_set()
	{
		$query = $this->db->get_where('settings');
		$data = $query->row_array();
		return $data;		
	}
	
	public function edit_settings($settings)
	{
		$sql = "UPDATE settings SET main_page_type = ?, main_page_id = ?, main_page_cat = ?, site_title = ?, site_description = ?, site_keywords = ?, site_offline = ?, offline_text = ? WHERE id=?";
		$query = $this->db->query($sql, array($settings['main_page_type'], $settings['main_page_id'], $settings['main_page_cat'], $settings['site_title'], $settings['site_description'], $settings['site_keywords'], $settings['site_offline'], $settings['offline_text'],$settings['id']));	
	}
	
}

/* End of file admin_model.php */
/* Location: ./application/model/task_4/admin_model.php */