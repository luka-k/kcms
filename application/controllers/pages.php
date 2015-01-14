<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends Client_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$settings = $this->settings->get_item_by(array("id" => 1));

		$page = $this->menus_items->url_parse(2);
		$this->uri->segment(2) ? $select_item = $this->uri->segment(2) : $select_item = "";
		$data = array(
			'user' => $this->users->get_item_by(array("id" => $this->user_id)),
			'tree' => $this->categories->get_site_tree(0, "parent_id"),
			'top_menu' => $this->top_menu->items,
			'select_item' => $select_item,
			'settings' => $this->settings->get_item_by(array('id' => 1)),
			'filials' => $this->filials->get_list(FALSE)
		);

		
		$url = $this->uri->segment(2);
		$root = $this->menus_items->get_item_by(array("url" => $url));
		if($root)
		{
			$level_2->items = $this->menus_items->menu_tree(1, $root->id);
			$level_2->active = $this->uri->segment(3);
			$data['level_2'] = $level_2;
		}
		
		$sub_level = $this->menus_items->get_item_by(array("url" => $this->uri->segment(3)));
				
		if($sub_level)
		{	
			$level_3->items = $this->menus_items->menu_tree(1, $sub_level->id);
			$level_3->active = $this->uri->segment(4);
			$data['level_3'] = $level_3;
		}

		$data['content'] = $page;

		if($page == "404")
		{
			$data['title'] = "Страница не найдена";
			$data['meta_title'] = $settings->site_title;
			$data['meta_keywords'] = $settings->site_keywords;
			$data['meta_description'] = $settings->site_description;
			$template="client/404.php";
		}
		else
		{
			if($sub_level->url == "novosti")
			{
			
				if($this->uri->segment(5))
				{
					$sub_template = "single-news";
				}
				else
				{
					$sub_template = "news";
					
					$select_date = $this->input->get('date');
					//var_dump(empty($select_date));
				
					foreach ($data['content']->articles as $key => $row) 
					{
						$date = new DateTime($row->date);
						$date->format('Y-m-d H:i:s');
						$volume[$key]  = $date;
						
						$desc = strip_tags($row->description);
						$desc_arr = explode(' ', $desc);
						$desc = '';
						for ($i = 0; $i < 20 && $i < count($desc_arr); $i++)
						{
							$desc .= $desc_arr[$i].' ';
						}
						if ($i >= 19) $desc .= '...';
						$row->description = $desc;
					}
					array_multisort($volume, SORT_DESC, $data['content']->articles);
					
					if(!empty($select_date))
					{
						$selected_news = array();
						foreach ($data['content']->articles as $item)
						{
							if($item->date == $select_date) $selected_news[] = $item;
						}
						
						$data['content']->articles = $selected_news;
					}
				}
			}
			else
			{
				$sub_template = "page";
			}
			
			isset($page->name) ? $data['title'] = $page->name : $data['title'] = $settings->site_title;
			isset($page->meta_title) ? $data['meta_title'] = $page->meta_title : $data['meta_title'] = $settings->site_title;
			isset($page->meta_keywords) ? $data['meta_keywords'] = $page->meta_keywords : $data['meta_keywords'] = $settings->site_keywords;
			isset($page->meta_description) ? $data['meta_description'] = $page->meta_description : $data['meta_description'] = $settings->site_description;

			$data['breadcrumbs'] = $this->breadcrumbs->get();
			$data['sub_template'] = $sub_template;
			$template="client/articles.php";
		}
		$this->load->view($template, $data);
	}
	
	public function dealers()
	{
		$this->uri->segment(2) ? $select_item = $this->uri->segment(2) : $select_item = "";
		
		$this->breadcrumbs->Add("articles/gde-kupit", "Где купить");
		$this->breadcrumbs->Add("dealers", "Как стать дилером");
		$data = array(
			'title' => "Дилеры",
			'meta_title' => "",
			'meta_keywords' => "",
			'meta_description' => "",
			'user' => $this->users->get_item_by(array("id" => $this->user_id)),
			'breadcrumbs' => $this->breadcrumbs->get(),
			'top_menu' => $this->top_menu->items,
			'select_item' => $select_item,
			'filials' => $this->filials->get_list(FALSE)
		);
		
		$root = $this->menus_items->get_item_by(array("url" => $this->uri->segment(2)));
		if($root) 
		{
			$level_2->items = $this->menus_items->menu_tree(1, $root->id);
			$level_2->active = "dealers";
			$data['level_2'] = $level_2;
		}
		
		$this->load->view("client/dealers", $data);
	}
	
	public function contacts()
	{
		$this->breadcrumbs->Add("articles/kontakty", "Контакты");
		$data = array(
			'title' => "Контакты",
			'meta_title' => "",
			'meta_keywords' => "",
			'meta_description' => "",
			'user' => $this->users->get_item_by(array("id" => $this->user_id)),
			'breadcrumbs' => $this->breadcrumbs->get(),
			'top_menu' => $this->top_menu->items,
			'select_item' => "articles/kontakty",
			'settings' => $this->settings->get_item_by(array("id" => 1)),
			'filials' => $this->filials->get_list(FALSE)
		);
		
		$this->load->view("client/contacts", $data);
	}

	// wishlist()
	// вывод вишлиста
	public function wishlist()
	{
		$left_menu = $this->dynamic_menus->get_menu(4);
		
		$wishlist = $this->wishlist->get();

		$data = array(
			'title' => "вишлист",
			'meta_title' => "",
			'meta_keywords' => "",
			'meta_description' => "",
			'user' => $this->users->get_item_by(array("id" => $this->user_id)),
			'tree' => $this->categories->get_site_tree(0, "parent_id"),
			'cart_items' => $this->cart_items,
			'total_price' => $this->total_price,
			'total_qty' => $this->total_qty,
			'product_word' => end_maker("товар", $this->total_qty),
			'top_menu' => $this->menus->set_active($this->top_menu, 'wishlist'),
			'left_menu' => $left_menu,
			'wishlist' => $wishlist
		);

		$this->load->view('client/wishlist.php', $data);
	}
}