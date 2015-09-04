<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends Client_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$parent_article = $this->articles->get_item_by(array("url" => $this->uri->segment(2)));
		$left_menu = $this->articles->get_site_tree($parent_article->id, "parent_id");
		
		$data = array(
			'tree' => $left_menu,
			'url' => $this->uri->segment_array()
		);
		$data = array_merge($this->standart_data, $data);
		
		$page = $this->url->url_parse(2);
		
		if(isset($page->article) && $page->id != 2 && $page->id != 5)
		{
			$content = $page;
			if ($page->id == 4)
			{
				$partners = $this->partners->get_prepared_list($this->partners->get_list());
				$description = "";
				foreach ($partners as $p)
				{
					$url = 'www.'.str_replace('http://', '', str_replace('www.', '', $p->url));
					$description .= "<div style='width: 575px;'><a href='".$p->url."' target='_blank'><img style='float: left;margin-right: 20px;' src='/download/images/".$p->img->url."' /></a>".$p->description."<br><a class='acidYellow' href='".$p->url."' target='_blank'>".$url."</a></div><div style='clear: both;'></div>";
				}
				$content->article->description = $description;
			}
			$template = "client/article.php";

		}		
		elseif(isset($page->articles))
		{
			$content = $page;

			$content->articles = $this->articles->get_prepared_list($content->articles);
			$template = $page->id == 3 ? "client/news.php" : "client/articles.php";
		}
		elseif($page == FALSE)
		{
		
		}
		$data['title'] = $content->name;
		$data['meta_title'] = $content->meta_title;
		$data['meta_keywords'] = $content->meta_keywords;
		$data['meta_description'] = $content->meta_description;
		$data['breadcrumbs'] = $this->breadcrumbs->get();
		$data['content'] = $content;
		
		$this->load->view($template, $data);
	}
	
	// wishlist()
	// вывод вишлиста
	public function wishlist()
	{
		$left_menu = $this->dynamic_menus->get_menu(4);
		
		$wishlist = $this->wishlist->get();

		$data = array(
			'title' => "вишлист",
			'tree' => $this->categories->get_site_tree(0, "parent_id"),
			'left_menu' => $left_menu,
			'wishlist' => $wishlist
		);
		$data = array_merge($this->standart_data, $data);		

		$this->load->view('client/wishlist.php', $data);
	}
}