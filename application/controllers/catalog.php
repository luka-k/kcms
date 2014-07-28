<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Catalog extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	
	public function index($url = FALSE, $pagin = FALSE)
	{
		if ($url == FALSE)
		{
			//Если $url не задан выводим все родительские подкатегории каталога
			$breadcrumbs = array(
				'Главная' => base_url(),
				'Каталог' => base_url()."/catalog",
			);
			
			$settings = $this->settings->get_item_by(array('id' => 1));
			$cat = $this->categories->get_list(array("parent" => 0));
			
			$data = array(
				'title' => $settings->site_title,
				'meta_title' => $settings->site_title,
				'keywords' => $settings->site_keywords,
				'description' => $settings->site_description,
				'tree' => $this->categories->get_sub_tree(0, "parent"),
				'content' => $cat,
				'breadcrumbs' => $breadcrumbs
			);
			$this->load->view('client/categories.php', $data);			
		}
		else
		{				
			$category = $this->categories->get_item_by(array("url" => $url));
				
			if ($category == NULL)
			{
				$page = $this->cat_pages->get_item_by(array("url" => $url));
				$breadcrumbs = $this->breadcrumbs_model->bread($url);
				$data = array(
					'title' => $page->title,
					'meta_title' => $page->meta_title,
					'keywords' => $page->keywords,
					'description' => $page->description,
					'tree' => $this->categories->get_sub_tree(0, "parent"),
					'content' => $page,
					'breadcrumbs' => $breadcrumbs
				);
		
				$this->load->view('client/page.php', $data);				
			}
			else
			{
				$breadcrumbs = $this->breadcrumbs_model->bread($url);
		
				$cat = $this->categories->get_list(array("parent" => $category->id));
		
				if($cat==NULL)
				{
					$config['base_url'] = base_url()."catalog/".$this->uri->segment(2);
					$config['total_rows'] = count($this->cat_pages->get_list(array('cat_id' => $category->id)));
					$config['per_page'] = 3;
					$this->pagination->initialize($config);	
					$pagination = $this->pagination->create_links();
					if ($pagin == null)
					{
						$pagin = 0;
					}

					$pages = $this->cat_pages->get_list(array('cat_id' => $category->id), $pagin, $config['per_page']);
					$data = array(
						'title' => $category->title,
						'meta_title' => $category->meta_title,
						'keywords' => $category->keywords,
						'description' => $category->description,
						'tree' => $this->categories->get_sub_tree(0, "parent"),
						'content' => $pages,
						'breadcrumbs' => $breadcrumbs,
						'pagination' => $pagination
						
					);							
					
					$this->load->view('client/pages.php', $data);				
				}
				else
				{
					$data = array(
						'title' => $category->title,
						'meta_title' => $category->meta_title,
						'keywords' => $category->keywords,
						'description' => $category->description,
						'tree' => $this->categories->get_sub_tree(0, "parent"),
						'content' => $cat,
						'breadcrumbs' => $breadcrumbs
					);
			
					$this->load->view('client/categories.php', $data);
				}
			}
		}
	}
	
	/*public function index()
	{
		//Получаем количество сегментов URI
		$count = $this->uri->total_segments();

		$segs = $this->uri->segment_array();
		
		if ($count == 1)
		{
			//Если сегиент один выводим все родительские подкатегории каталога
			$breadcrumbs = array(
				'Главная' => base_url(),
				'Каталог' => base_url()."/catalog",
			);
			
			$settings = $this->settings->get_item_by(array('id' => 1));
			$cat = $this->categories->get_list(array("parent" => 0));
			
			$cat = full_url($cat);
			
			$data = array(
				'title' => $settings->site_title,
				'meta_title' => $settings->site_title,
				'keywords' => $settings->site_keywords,
				'description' => $settings->site_description,
				'tree' => $this->categories->get_sub_tree(0, "parent"),
				'content' => $cat,
				'breadcrumbs' => $breadcrumbs
			);
			$this->load->view('client/categories.php', $data);
		}
		else
		{	
			$url = $this->uri->segment($count);
			
			$category = $this->categories->get_item_by(array("url" => $url));
			
			if ($category == NULL)
			{
				$page = $this->cat_pages->get_item_by(array("url" => $url));
		
				$breadcrumbs = $this->breadcrumbs_model->category_bread($count);
		
				$data = array(
					'title' => $page->title,
					'meta_title' => $page->meta_title,
					'keywords' => $page->keywords,
					'description' => $page->description,
					'tree' => $this->categories->get_sub_tree(0, "parent"),
					'content' => $page,
					'breadcrumbs' => $breadcrumbs
				);
			
				$this->load->view('client/page.php', $data);				
			}
			else
			{
				$breadcrumbs = $this->breadcrumbs_model->category_bread($count);
			
				$cat = $this->categories->get_list(array("parent" => $category->id));
			
				if($cat==NULL)
				{
				
					$pages = $this->cat_pages->get_list(array('cat_id' => $category->id));
				
					$pages = full_url($pages);
					
					$data = array(
						'title' => $category->title,
						'meta_title' => $category->meta_title,
						'keywords' => $category->keywords,
						'description' => $category->description,
						'tree' => $this->categories->get_sub_tree(0, "parent"),
						'content' => $pages,
						'breadcrumbs' => $breadcrumbs
					);		

					//$config['base_url'] = base_url().uri_string();
					//$config['total_rows'] = count($data['content']);
					//$config['per_page'] = 3;
					//$this->pagination->initialize($config);	
					//$data['pagination'] = $this->pagination->create_links();
					
					$this->load->view('client/pages.php', $data);				
				}
				else
				{
					$cat = full_url($cat);
					
					$data = array(
						'title' => $category->title,
						'meta_title' => $category->meta_title,
						'keywords' => $category->keywords,
						'description' => $category->description,
						'tree' => $this->categories->get_sub_tree(0, "parent"),
						'content' => $cat,
						'breadcrumbs' => $breadcrumbs
					);
			
					$this->load->view('client/categories.php', $data);
				}
			}
		}		
	}*/

	public function product($url)
	{
				$page = $this->cat_pages->get_item_by(array("url" => $url));
		
				$breadcrumbs = $this->breadcrumbs_model->bread($url);
		
				$data = array(
					'title' => $page->title,
					'meta_title' => $page->meta_title,
					'keywords' => $page->keywords,
					'description' => $page->description,
					'tree' => $this->categories->get_sub_tree(0, "parent"),
					'content' => $page,
					'breadcrumbs' => $breadcrumbs
				);
			
				$this->load->view('client/page.php', $data);	
	}
	
}

/* End of file catalog.php */
/* Location: ./application/controllers/catalog.php */