<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Catalog extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	
	public function index($url = FALSE, $pagin = FALSE)
	{
		$menu = $this->menus->top_menu;
		$menu = $this->menus->set_active($menu, 'catalog');
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
				'meta_keywords' => $settings->site_keywords,
				'meta_description' => $settings->site_description,
				'tree' => $this->categories->get_sub_tree(0, "parent"),
				'content' => $cat,
				'breadcrumbs' => $breadcrumbs,
				'menu' => $menu
			);
			$data['content'] = $this->images->get_img_list($data['content'], 'categories');
			$this->load->view('client/categories.php', $data);			
		}
		else
		{				
			$category = $this->categories->get_item_by(array("url" => $url));
				
			if ($category == NULL) //Выпилить к дребеням
			{
				$page = $this->products->get_item_by(array("url" => $url));
				$breadcrumbs = $this->breadcrumbs_model->bread($url);
				$data = array(
					'title' => $page->title,
					'meta_title' => $page->meta_title,
					'meta_keywords' => $page->keywords,
					'meta_description' => $page->description,
					'tree' => $this->categories->get_sub_tree(0, "parent"),
					'content' => $page,
					'breadcrumbs' => $breadcrumbs,
					'menu' => $menu
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
					$config['total_rows'] = count($this->products->get_list(array('category_id' => $category->id)));
					$config['per_page'] = 3;
					$config['uri_segment'] = 2;
					$config['num_links'] = 4;
					$this->pagination->initialize($config);	
					$pagination = $this->pagination->create_links();
					if ($pagin == null)
					{
						$pagin = 0;
					}

					$pages = $this->products->get_list(array('category_id' => $category->id), $pagin, $config['per_page']);
					$data = array(
						'title' => $category->title,
						'meta_title' => $category->meta_title,
						'meta_keywords' => $category->meta_keywords,
						'meta_description' => $category->meta_description,
						'tree' => $this->categories->get_sub_tree(0, "parent"),
						'content' => $pages,
						'breadcrumbs' => $breadcrumbs,
						'pagination' => $pagination,
						'menu' => $menu
						
					);							
					$data['content'] = $this->images->get_img_list($data['content'], 'product'); 
					$this->load->view('client/pages.php', $data);				
				}
				else
				{
					$data = array(
						'title' => $category->title,
						'meta_title' => $category->meta_title,
						'meta_keywords' => $category->meta_keywords,
						'meta_description' => $category->meta_description,
						'tree' => $this->categories->get_sub_tree(0, "parent"),
						'content' => $cat,
						'breadcrumbs' => $breadcrumbs,
						'menu' =>$menu
					);
					$data['content'] = $this->images->get_img_list($data['content'], 'category'); 
					$this->load->view('client/categories.php', $data);
				}
			}
		}
	}

	public function product($url)
	{
		$menu = $this->menus->top_menu;
		$menu = $this->menus->set_active($menu, 'catalog');
		
		$page = $this->products->get_item_by(array("url" => $url));
		
		$breadcrumbs = $this->breadcrumbs_model->bread($url);
		
		$data = array(
			'title' => $page->title,
			'meta_title' => $page->meta_title,
			'meta_keywords' => $page->meta_keywords,
			'meta_description' => $page->meta_description,
			'tree' => $this->categories->get_sub_tree(0, "parent"),
			'content' => $page,
			'breadcrumbs' => $breadcrumbs,
			'menu' => $menu
		);

		$data['content']->img = $this->images->get_images(array("object_type" => "products", "object_id" => $data['content']->id)); 
			
		$this->load->view('client/page.php', $data);	
	}
	
}

/* End of file catalog.php */
/* Location: ./application/controllers/catalog.php */