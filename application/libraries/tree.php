<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Tree{

	public function __construct()
	{
		$this->CI =& get_instance();
	}
	

	function get_cat()
	{
		/*//Выбираем данные из БД
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
			
		}*/
		return $cats;
	}
	
	function build_tree($parent_id)
	{
	$cat = $this->CI->categories->get_list(FALSE);
	foreach ($cat as $item)
	{
		$cats[$item->root][$item->id]['id'] = $item->id;
		$cats[$item->root][$item->id]['title'] = $item->title;
	}
	/*var_dump($cats);*/
	$data['cats'] = $cats;
	$data['pid'] = $parent_id;
	
	$this->CI->load->view('admin/tree.php', $data);
	
    /*if(is_array($cats) and isset($cats[$parent_id]))
	{
        $tree = '<ul>';
        foreach($cats[$parent_id] as $cat)
		{
            $tree .= '<li><a href="'.base_url().'admin/pages/'.$cat->id.'">'.$cat->title.'</a>';
			
			//if ($this->build_tree($cats,$cat['id'])<>NULL)
			//{
				//$tree .= '<span class="up"><i class="icon-sort-down"></i></span>';
			//}
            $tree .=  $this->build_tree($cat->id);
           $tree .= '</li>';
        }
		$tree .= '</ul>';
    }
    else return null;
    return $tree;*/
	}
	
	/*function menu($parent_id)
	{
		$cats = $this->get_cat();
		$tree = '<ul>';
		$tree .= '<li><a href="'.base_url().'admin/pages/0">Без категории</a></li>';
		$tree .= '</ul>';
		$tree .= $this->build_tree($cats, $parent_id);
		return $tree;
	}	*/
}