<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//PAges model class

class Client_model extends CI_Model {

    function __construct()
	{
        parent::__construct();
		$this->load->database();
	}
	
	//Получение страниы
	public function get_page($url = FALSE)
	{
		//если url = false значит подгружаем главную
		if ($url === FALSE)
		{
			$query = $this->db->get('settings');
			$main_page = $query->row_array();
			$query = $this->db->get_where('pages', array('id' => $main_page['main_page_id']));
		}
		else
		{
			// если передан url то получаем соответствубщую статью.
			$query = $this->db->get_where('pages', array('url' => $url));
		}
		$data = $query->row_array();
		return $data;
	}
	
	//Формируем меню
	//Пока это meta_title но подозреваю это не лючшее решение
	public function get_menu()
	{
		$this->db->select('url, title');
		$query = $this->db->get_where('pages', array('status' => '1'));
		$menu = $query->result_array();
		return $menu;
	}
	
	public function get_category($url)
	{
		echo $url;
		$query = $this->db->get_where('categories', array('url' => $url));
		$cat_info = $query->row_array();
		
		echo $cat_info['id'];
		
		$query = $this->db->get_where('pages', array('cat_id' => $cat_info['id']));
		$pages = $query->result_array();
		$page = array(
			'id' => $cat_info['id'],
			'title' => $cat_info['title'],
			'cat_desc' => $cat_info['cat_desc'],
			'pages' => $pages
		);
		return $page;
	}
}
/* End of file pages_model.php */
/* Location: ./application/model/task_4/pages_model.php */