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