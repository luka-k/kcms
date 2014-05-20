<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//PAges model class

class Pages_model extends CI_Model {

    function __construct()
	{
        parent::__construct();
		$this->load->database();
	}
	
	//Получение страниы
	public function get_page($url = FALSE)
	{
		//если url = false значит подгружаем главную
		//пока сделал что главная автоматом страница с id = 1, но наверно это не совсем верно. 
		//как вариант вижу еще колонку в таблице типа main и у главной true
		//но если есть лучшее решение хочу услышать от тебя
		if ($url === FALSE)
		{
			$query = $this->db->get_where('pages', array('id' => '1'));
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
		$this->db->select('url, meta_title');
		$query = $this->db->get('pages');
		$menu = $query->result_array();
		return $menu;
	}

	
}
/* End of file pages_model.php */
/* Location: ./application/model/task_4/pages_model.php */