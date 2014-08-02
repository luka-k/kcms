<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Catalog extends CI_Controller {

	public $menu = array();

	public function __construct()
	{
		parent::__construct();
		$this->menu = array(
			"0" => array("Главная", base_url(), "0"),
			"1" => array("Новости", base_url()."pages/news", "0"),
			"2" => array("Каталог", base_url()."catalog", "0"),
			"3" => array("Блог", base_url()."pages/blog", "0"),
		);
	}
	
	public function index($url = FALSE, $pagin = FALSE)
	{
		$this->menu[2][2] = 1;
		//var_dump($menu);
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
				'breadcrumbs' => $breadcrumbs,
				'menu' => $this->menu
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
					'breadcrumbs' => $breadcrumbs,
					'menu' => $this->menu
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
					$config['uri_segment'] = 2;
					$config['num_links'] = 4;
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
						'pagination' => $pagination,
						'menu' => $this->menu
						
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
						'breadcrumbs' => $breadcrumbs,
						'menu' =>$this->menu
					);
			
					$this->load->view('client/categories.php', $data);
				}
			}
		}
	}

	public function product($url)
	{
		$this->menu[2][2] = 1;
		
		$page = $this->cat_pages->get_item_by(array("url" => $url));
		
		$breadcrumbs = $this->breadcrumbs_model->bread($url);
		
		$data = array(
			'title' => $page->title,
			'meta_title' => $page->meta_title,
			'keywords' => $page->keywords,
			'description' => $page->description,
			'tree' => $this->categories->get_sub_tree(0, "parent"),
			'content' => $page,
			'breadcrumbs' => $breadcrumbs,
			'menu' => $this->menu
		);
			
		$this->load->view('client/page.php', $data);	
	}
	
}

/* End of file catalog.php */
/* Location: ./application/controllers/catalog.php */