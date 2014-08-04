<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Admin class

class Admin extends CI_Controller 
{	
	public function __construct()
	{
		parent::__construct();

		$data = array(
			'title' => "Вход",
			'meta_title' => "Вход",
			'error' => " "
		);

		if (!$this->session->userdata('logged_in'))
		{
			$this->load->view('admin/enter.php', $data);	
		} 
	}
	
	public function index()
	{
		redirect(base_url().'admin/admin_main');
	}

	//Главная страница
	public function admin_main()
	{
		//Отбираем для главной последние три записи в блоге и в новостях
		$from_news = $this->news->get_count(array('is_active' => 1))-5;
		$from_blog = $this->blog->get_count(array('is_active' => 1))-5;
		if ($from_news < 0)
		{
			$from_news = 0;
		}
		
		if ($from_blog < 0)
		{
			$from_blog = 0;
		}	
		$menu = $this->menus->admin_menu;
		$menu = $this->menus->set_active($menu, 'main');
		$data = array(
			'title' => "CMS",
			'meta_title' => "CMS",
			'error' => "",
			'name' => $this->session->userdata('user_name'),
			'news' => array_reverse($this->news->get_list(array('is_active' => 1), $from_news, 5)),
			'blog' => array_reverse($this->blog->get_list(array('is_active' => 1), $from_blog, 5)),
			'menu' => $menu
		);
		$this->load->view('admin/admin.php', $data);
	}
	
	//Вывод разделов в админке. 
	public function parts($id = false)
	{
		$menu = $this->menus->admin_menu;
		$menu = $this->menus->set_active($menu, 'parts');
		$data = array(
			'title' => "Разделы",
			'meta_title' => "Разделы",
			'error' => "",
			'name' => $this->session->userdata('user_name'),
			'parts' => $this->parts->get_list(FALSE),
			'tree' => $this->parts->get_sub_tree(0, "parent"),
			'menu' => $menu
		);
		if ($id == false)
		{
			//Если id не указан выводим все разделы
			$this->load->view('admin/parts.php', $data);
		}
		else
		{
			//Если есть id выводим редактирование раздела.
			$data['editors'] = $this->parts->editors;
			$data['content'] = $this->parts->get_item_by(array('id' => $id));
			$this->load->view('admin/edit-part.php', $data);
		}		
	}
	
	//Внесение изменений в раздел
	public function edit_part()
	{
		$menu = $this->menus->admin_menu;
		$menu = $this->menus->set_active($menu, 'parts');
		$data = array(
			'title' => "Разделы",
			'meta_title' => "Разделы",
			'error' => "",
			'name' => $this->session->userdata('user_name'),
			'parts' => $this->parts->get_list(FALSE),
			'menu' => $menu
		);
		
		$editors = $this->parts->editors;
		$post = $this->input->post();
		
		$data['part'] = editors_post($editors, $post);
			
		//Валидация формы
		$this->form_validation->set_rules('title', 'Title', 'trim|xss_clean|required');
		
		if($this->form_validation->run() == FALSE)
		{
			//Если валидация не прошла выводим сообщение об ошибке
			$this->load->view('admin/edit-part.php', $data);			
		}
		else
		{
			if ($data['part']->id == NULL)
			{
				//Если id нет то оставлена место добавить код для добавления раздела
				$this->parts->insert($data['part']);
				redirect(base_url().'admin/parts');			
			}
			else
			{
				//Редактируем раздел по id
				$this->parts->update($data['part']->id, $data['part']);
				redirect(base_url().'admin/parts');
			}	
		}					
	}
	
	/*------------Редактирование страниц разделов------------*/

	//Вывод страниц раздела
	public function pages($part_id = false)
	{
		$menu = $this->menus->admin_menu;
		$menu = $this->menus->set_active($menu, 'parts');
		$data = array(
			'title' => "Страницы",
			'meta_title' => "Страницы",
			'error' => "",
			'name' => $this->session->userdata('user_name'),
			'tree' => $this->parts->get_sub_tree(0, "parent"),
			'parts' => $this->parts->get_list(FALSE),
			'menu' => $menu
		);
			
		$parts = $data['parts'];
		foreach ($parts as $part)
		{
			$base = $part->url;
			$part_pages[$base] = $this->$base->get_list(FALSE);
		}
			
		if ($part_id == NULL)
		{
			//Если id раздела не задан получаем все страницы
			foreach($part_pages as $part_url => $pages)
			{
				foreach ($pages as $page)
				{
					$page->part_url = $part_url;
					$data['pages'][] = $page;
				}
			}
		}
		else
		{
			//Если id указан выводим страницы данного раздела
			foreach ($parts as $part)
			{
				if ($part_id == $part->id)
				{
					$part_url = $part->url;
				}
			}
			
			foreach ($part_pages[$part_url] as $page)
			{
				$page->part_url = $part_url;
				$data['pages'][] = $page;
			}				
		}
		$this->load->view('admin/pages.php', $data);
	}
	
	//Вывод информации о странице
	public function page($part_url = FALSE, $id = FALSE)
	{
		$menu = $this->menus->admin_menu;
		$menu = $this->menus->set_active($menu, 'parts');
		$data = array(
			'title' => "Редактировать страницу",
			'meta_title' => "Редактировать страницу",
			'error' => "",
			'name' => $this->session->userdata('user_name'),
			'tree' => $this->parts->get_sub_tree(0, "parent"),
			'menu' => $menu
		);
		
		//Если url раздела и id страниццы не существуют то выводим всплывающее окно для выбора в какой раздел добавить страницу
		if ($part_url == FALSE and $id == FALSE)
		{
			$part_url = $this->input->post('url');
			$data['editors'] = $this->$part_url->editors;
			$page = new stdClass();
			foreach ($data['editors'] as $tabs)
			{
				foreach ($tabs as $item => $value)
				{
					$page->$item = "";
				}
			}
			$page->is_active = "1";
			$data['content'] = $page;			
		}
		else
		//Если url категории и id страницы не пуст выводим инфу страницы из базы
		{
			$data['editors'] = $this->$part_url->editors;
			$data['content'] = $this->$part_url->get_item_by(array('id' => $id));
		}
		$data['content']->part_url = $part_url;
		$this->load->view('admin/edit-page.php', $data);
	}

	//Редактирование страницы разделов
	public function edit_page($cat_url)
	{
		$menu = $this->menus->admin_menu;
		$menu = $this->menus->set_active($menu, 'parts');
		$data = array(
			'meta_title' => "Редактировать страницу",
			'error' => " ",
			'name' => $this->session->userdata('user_name'),
			'tree' => $this->parts->get_sub_tree(0, "parent"),	
			'menu' => $this->menu
		);
					
		$editors = $this->$cat_url->editors;
		$post = $this->input->post();
		
		$data['page'] = editors_post($editors, $post);
			
		$data['page']->url = translit_url($data['page']->title);
		$data['page']->date = date("d.m.Y");
		//Валидация формы
		$this->form_validation->set_rules('title', 'Title', 'trim|xss_clean|required');
		
		if($this->form_validation->run() == FALSE)
		{
			//Если валидация не прошла выводим сообщение об ошибке
			$this->load->view('admin/edit-page.php', $data);			
		}
		else
		{
			//Если валидация прошла успешно проверяем переменную id
			if($data['page']->id==NULL)
			{
				//Если id пустая создаем новую страницу в базе
				$fields = array(
					'title' => $data['page']->title
				);
					
				if($this->$cat_url->non_requrrent($fields))
				{
					$this->$cat_url->insert($data['page']);
					redirect(base_url().'admin/pages');
				}
				else
				{
					$data['error'] = "Страница с таким именем в этой категории уже ссуществует.";
					$this->load->view('admin/edit-page.php', $data);
				}
			}
			else
			{
				//Если id не пустая вносим изменения.
				$this->$cat_url->update($data['page']->id, $data['page']);
				redirect(base_url().'admin/pages');
			}
		}
	}

	//Удаление страницы
	public function delete_page($part_url, $id)
	{
		if($this->$part_url->delete($id))
		{
			redirect(base_url().'admin/pages');
		}
	}	
	
	/*------------Редактирование каталога------------*/
	
	//Вывод списка категорий
	public function categories()
	{
		$menu = $this->menus->admin_menu;
		$menu = $this->menus->set_active($menu, 'catalog');
		$data = array(
			'title' => "CMS",
			'meta_title' => "CMS",
			'error' => "",
			'name' => $this->session->userdata('user_name'),
			'cat' => $this->categories->get_list(FALSE),
			'tree' => $this->categories->get_sub_tree(0, "parent"),
			'menu' => $menu
		);
		$this->load->view('admin/categories.php', $data);
	}
	
	//Вывод информации категории по id
	public function category($cat_id = false)
	{
		$menu = $this->menus->admin_menu;
		$menu = $this->menus->set_active($menu, 'catalog');
		$data = array(
			'title' => "Редактировать категорию",
			'error' => "",
			'name' => $this->session->userdata('user_name'),
			'selects' => array(
				'parent' =>$this->categories->get_list(FALSE)
			),
			'tree' => $this->categories->get_sub_tree(0, "parent"),
			'menu' => $menu,
			'editors' => $this->categories->editors
		);
		
		if ($cat_id===false)
		{
			$cat = new stdClass();
			foreach ($data['editors'] as $tabs)
			{
				foreach ($tabs as $item => $value)
				{
					$cat->$item = "";
				}
			}
			$cat->is_active = "1";
			$data['content'] = $cat;
		}
		else
		{
			$data['content'] = $this->categories->get_item_by(array('id' => $cat_id));
		}	
		$this->load->view('admin/edit-category.php', $data);
	}

	//Редактирование категории
	public function edit_category()
	{
		$menu = $this->menus->admin_menu;
		$menu = $this->menus->set_active($menu, 'catalog');
		$data = array(
			'meta_title' => "Редактировать категорию",
			'name' => $this->session->userdata('user_name'),
			'error' => " ",
			'cat' => $this->categories->get_list(FALSE),
			'menu' => $menu,
			'tree' => $this->categories->get_sub_tree(0, "parent")				
		);
		
		$editors = $this->categories->editors;
		$post = $this->input->post();
		
		$data['cat_info'] = editors_post($editors, $post);
			
		$data['cat_info']->url = translit_url($data['cat_info']->title);

		//Валидация формы
		$this->form_validation->set_rules('title', 'Title', 'trim|xss_clean|required');
		
		if($this->form_validation->run() == FALSE)
		{
			//Если валидация не прошла выводим сообщение об ошибке
			$this->load->view('admin/edit-category.php', $data);			
		}
		else
		{
			//Если валидация прошла успешно проверяем переменную id
			if($data['cat_info']->id==NULL)
			{
				//Если id пустая создаем новую страницу в базе
				$this->categories->insert($data['cat_info']);
			}
			else
			{
				//Если id не пустая вносим изменения.
				$this->categories->update($data['cat_info']->id, $data['cat_info']);
			}			
		}
		redirect(base_url().'admin/categories');
	}	
		
	//Удаление категории
	public function delete_cat($cat_id)
	{
		if($this->categories->delete($cat_id))
		{
			redirect(base_url().'admin/categories');
		}
	}

	/*------------Редактирование страниц каталога------------*/

	//Вывод страниц категорий
	public function cat_pages($cat_id = false)
	{
		$menu = $this->menus->admin_menu;
		$menu = $this->menus->set_active($menu, 'catalog');
		$data = array(
			'title' => "Страницы",
			'meta_title' => "Страницы",
			'error' => "",
			'name' => $this->session->userdata('user_name'),
			'tree' => $this->categories->get_sub_tree(0, "parent"),
			'menu' => $menu,
			'cats' => $this->categories->get_list(FALSE)
		);
			
		if ($cat_id == NULL)
		{
			//Если id категории не задан получаем все страницы
			$data['pages'] = $this->cat_pages->get_list(FALSE);
		}
		else
		{
			//Если id указан выводим страницы данного раздела
			$data['pages'] = $this->cat_pages->get_list(array('cat_id' => $cat_id));
		}
		$this->load->view('admin/cat-pages.php', $data);
	}
	
	//Вывод информации о странице каталога
	public function cat_page($id = FALSE)
	{
		$menu = $this->menus->admin_menu;
		$menu = $this->menus->set_active($menu, 'catalog');
		$data = array(
			'title' => "Редактировать страницу каталога",
			'error' => "",
			'name' => $this->session->userdata('user_name'),
			'selects' => array(
				'cat_id' =>$this->categories->get_list(FALSE)
			),
			'tree' => $this->categories->get_sub_tree(0, "parent"),
			'menu' => $menu,
			'editors' => $this->cat_pages->editors
		);
		
		if ($id===false)
		{
			$page = new stdClass();
			foreach ($data['editors'] as $tabs)
			{
				foreach ($tabs as $item => $value)
				{
					$page->$item = "";
				}
			}
			$page->is_active = "1";
			$data['content'] = $page;
		}
		else
		{
			$data['content'] = $this->cat_pages->get_item_by(array('id' => $id));
		}	

		$this->load->view('admin/edit-cat-page.php', $data);
	}
	
	//Редактирование страницы разделов
	public function edit_cat_page()
	{	
		$menu = $this->menus->admin_menu;
		$menu = $this->menus->set_active($menu, 'parts');
		$data = array(
			'title' => "Редактировать страницу каталога",
			'error' => "",
			'name' => $this->session->userdata('user_name'),
			'selects' => array(
				'cat_id' =>$this->categories->get_list(FALSE)
			),
			'tree' => $this->categories->get_sub_tree(0, "parent"),
			'menu' => $menu,
			'editors' => $this->cat_pages->editors		
		);
					
		$editors = $this->cat_pages->editors;
		$post = $this->input->post();
		
		$pic = $_FILES['pic'];
		$this->images_model->upload_image($pic);
		//var_dump($_FILES['pic']);
		
		$data['page'] = editors_post($editors, $post);
		$data['page']->url = translit_url($data['page']->title);
			
		//Валидация формы
		$this->form_validation->set_rules('title', 'Title', 'trim|xss_clean|required');
		
		if($this->form_validation->run() == FALSE)
		{
			//Если валидация не прошла выводим сообщение об ошибке
			$this->load->view('admin/edit-cat-page.php', $data);			
		}
		else
		{
			//Если валидация прошла успешно проверяем переменную id
			if($data['page']->id==NULL)
			{
				//Если id пустая создаем новую страницу в базе
				$fields = array(
					'title' => $data['page']->title,
				);
					
				if($this->cat_pages->non_requrrent($fields))
				{
					$this->cat_pages->insert($data['page']);
					redirect(base_url().'admin/cat_pages');
				}
				else
				{
					$data['error'] = "Страница с таким именем в каталоге уже ссуществует.";
					$this->load->view('admin/edit-cat-page.php', $data);
				}
			}
			else
			{
				//Если id не пустая вносим изменения.
				$this->cat_pages->update($data['page']->id, $data['page']);
				redirect(base_url().'admin/cat_pages');
			}
		}
	}
	
	//Удаление страницы
	public function delete_cat_page($id)
	{
		if($this->cat_pages->delete($id))
		{
			redirect(base_url().'admin/cat_pages');
		}
	}	
		
	/*------------Редактирование настроек------------*/
	public function settings()
	{
		$menu = $this->menus->admin_menu;
		$menu = $this->menus->set_active($menu, 'settings');
		$data = array(
			'title' => "Настройки сайта",
			'meta_title' => "Настройки сайта",
			'error' => "",
			'name' => $this->session->userdata('user_name'),
			'cat' => $this->categories->get_list(FALSE),
			'tree' => $this->categories->get_sub_tree(0, "parent"),
			'settings' => $this->settings->get_item_by(array('id' => 1)),
			'menu' => $menu,
			'editors' => $this->settings->editors
		);
		$this->load->view('admin/settings.php', $data);	
	}
	
	public function edit_settings()
	{
		$menu = $this->menus->admin_menu;
		$menu = $this->menus->set_active($menu, 'settings');
		$data = array(
			'title' => "Редактировать настройки",
			'meta_title' => "Редактировать настройки",
			'error' => " ",
			'name' => $this->session->userdata('user_name'),
			'cat' => $this->categories->get_list(FALSE),
			'menu' => $menu,
			'tree' => $this->categories->get_sub_tree(0, "parent")	
		);
		
		$editors = $this->settings->editors;
		$post = $this->input->post();
		
		$data['settings'] = editors_post($editors, $post);

		//Валидация формы
		$this->form_validation->set_rules('trim|xss_clean|required');
		
		if($this->form_validation->run() == FALSE)
		{
			//Если валидация не прошла выводим сообщение об ошибке
			$this->load->view('admin/settings.php', $data);						
		}
		else
		{
			$this->settings->update(1, $data['settings']);
		}
		redirect(base_url().'admin/settings');
	}
}