<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Catalog extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url', 'translit', 'upload'));
	}
	
	public function index()
	{
		$count = $this->uri->total_segments();
		//echo $count;
		//echo '<br />';
		$segs = $this->uri->segment_array();
		foreach ($segs as $segment)
		{
			//echo $segment;
			//echo '<br />';
		}
		
		//echo $this->uri->segment($count);
		
		
		
		if ($count == 1)
		{
			$settings = $this->settings->get_item_by(array('id' => 1));
			$cat = $this->categories->get_list(array("parent" => 0));
			$data = array(
				'title' => $settings->site_title,
				'meta_title' => $settings->site_title,
				'keywords' => $settings->site_keywords,
				'description' => $settings->site_description,
				'tree' => $this->categories->get_sub_tree(0, "parent"),
				'content' => $cat
			);
			$this->load->view('client/categories.php', $data);
		}
		else
		{
			$url = $this->uri->segment($count);
			
			$category = $this->categories->get_item_by(array("url" => $url));
			
			//var_dump($category);
			
			$cat = $this->categories->get_list(array("parent" => $category->id));
			$data = array(
				'title' => $category->title,
				'meta_title' => $category->meta_title,
				'keywords' => $category->keywords,
				'description' => $category->description,
				'tree' => $this->categories->get_sub_tree(0, "parent"),
				'content' => $cat
			);
			
			$this->load->view('client/categories.php', $data);
			//echo $this->uri->segment($count);
		}
		
		//var_dump($cat);
		
	}
}

/* End of file catalog.php */
/* Location: ./application/controllers/catalog.php */