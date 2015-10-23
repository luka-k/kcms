<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//main page controller

class Popup_gallery extends Client_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	
	private function generateLinkList($image, $isProduct = false, $isGallery = false)
	{
		$html = '';
		$qty = 0;
		
		if (!$isProduct)
		{
			$product = $this->products->prepare($this->products->get_item($image->object_id));
			$item = '<li class=gallery-menu__item><a href='.$product->full_url.'#'.$image->id.' class=gallery-menu__href>'.$product->name.'</a></li>';
			$html .= $item;
			$qty++;
		}
		
		$categoriesIds = $this->images2categories->get_list(array("child_id" => $image->id));
		foreach ($categoriesIds as $cid)
		{
			if ($_GET['category_id'] == $cid->category_parent_id)
				continue;
			$category = $this->categories->prepare($this->categories->get_item($cid->category_parent_id));
			if (!$category->name)
				continue;
			$item = '<li class=gallery-menu__item><a href='.$category->full_url.'#'.$image->id.' class=gallery-menu__href>'.$category->name.'</a></li>';
			$html .= $item;
			$qty++;
		}
		
		if (!$isGallery && $image->is_main)
		{
			$item = '<li class=gallery-menu__item><a href=/#'.$image->id.' class=gallery-menu__href>Галерея</a></li>';
			$html .= $item;
			$qty++;
		}
		
		if ($qty < 2)
			return '';
		return str_replace('"', '', str_replace("'", '', str_replace('http://brightberry.ru', '', $html)));
	}
	
	private function generateLinkTitle($image, $isProduct = false, $isGallery = false)
	{
		$product = $this->products->prepare($this->products->get_item($image->object_id));
	
		if (!$isProduct)
			return array($product->full_url.'#'.$image->id, $product->name);
			
		$categoriesIds = $this->images2categories->get_list(array("child_id" => $image->id));
		foreach ($categoriesIds as $cid)
		{
			$category = $this->categories->prepare($this->categories->get_item($cid->category_parent_id));
			if ($category->name)
				break;
		}
		if ($category)
			return array($category->full_url.'#'.$image->id, $category->name);
		
		if (!$isGallery && $image->is_main)
		{
			return array('/#'.$image->id, 'Галерея');
		}
		
	}
	
	public function view()
	{		
		$action = $this->input->get("action");

		if($action == "main")
		{
			$first_img = $this->input->get("first_img");
		
			$images = $this->images->get_list(array("is_main" => 1), $from = FALSE, $limit = FALSE, "sort", "asc");
			
			srand($_GET['rand']); 
			shuffle($images);
			$gallery = array();
			foreach ($images as $el)
			{
				if ($el->object_type == 'products')
				{
					$object = $this->products->get_item($el->object_id);
					$el->links = $this->generateLinkList($el, false, true);
					$titlelink = $this->generateLinkTitle($el, false, true);
					$el->titlelink = $titlelink[0];
					$el->titlelinkname = $titlelink[1];
				} else {
					$object = $this->articles->prepare($this->articles->get_item($el->object_id));
					$el->titlelinkname = $object->name;
					$el->titlelink = $object->full_url;
				}
				$el->name = $object->name;
				$gallery[] = $el;
			}
			$gallery_title = "Галерея (the best)";
		}
		elseif($action == "category")
		{
			$category_id = $this->input->get("category_id");
			$category = $this->categories->get_item_by(array("id" => $category_id));
			
			$this->db->select('child_id');
			$img_ids = $this->images2categories->get_list(array("category_parent_id" => $category_id));
					
			$sub_category = $this->categories->get_list(array("parent_id" => $category_id));
			if($sub_category) foreach($sub_category as $s_c)
			{
				$this->db->select('child_id');
				$img_ids = array_merge($img_ids, $this->images2categories->get_list(array("category_parent_id" => $s_c->id)));
			}
					
					
			$gallery = array();
				
			foreach($img_ids as $i)
			{
				$img = $this->images->get_item_by(array("id" => $i->child_id));
				if ($img->object_type == 'products')
				{
					$object = $this->products->get_item($img->object_id);
					$img->links = $this->generateLinkList($img);
					$titlelink = $this->generateLinkTitle($img);
					$img->titlelink = $titlelink[0];
					$img->titlelinkname = $titlelink[1];
				} else {
					$object = $this->articles->prepare($this->articles->get_item($img->object_id));
					$img->titlelinkname = $object->name;
					$img->titlelink = $object->full_url;
				}
				$img->name = $object->name;

				$gallery[] = $img;
			}
			
			$gallery_title = $category->name;
		}
		elseif($action == "product")
		{
			$product_id = $this->input->get("product_id");
			$product = $this->products->get_item_by(array("id" => $product_id));
			
			$product = $this->products->prepare($product);
			
			
			$gallery = array();
			$images = $this->images->get_list(array("object_type" => "products", "object_id" => $product_id), FALSE, FALSE, "name", "asc");
			
			
			if ($_GET['my_parent'])
			{
				$images = array();
				$gallery = array();
				$products = $this->products->get_list(array("parent_id" => $_GET['my_parent']), 0, 0, 'sort', 'asc'); 
				
				foreach ($products as $product)
				{
					$product = $this->products->prepare($product);
					$_images = $this->images->get_list(array("object_type" => "products", "object_id" => $product->id), FALSE, FALSE, "name", "asc");
					foreach ($_images as $i => $im)
					{
						if ($i)
							$images[] = $im;
					}
				}
				if ($_GET['first_img'] == -1)
					$_GET['first_img'] = 0;
			} 
			$_GET['first_img']++;
			if ($_GET['first_img'] == count($images))
				$_GET['first_img'] = 0;
			foreach ($images as $i => $im)
			{
				if ($_GET['type'] == 'catalog' && $i == 0 && !$_GET['my_parent']) continue;
				$im->name = $product->name;
				$im->links = $this->generateLinkList($im, true);
				$titlelink = $this->generateLinkTitle($im, true);
				$im->titlelink = $titlelink[0];
				$im->titlelinkname = $titlelink[1];
				$gallery[] = $im;
			}
			$gallery_title = $product->name;
		}
		elseif($action == "news")
		{
			$product_id = $this->input->get("product_id");
			if(!$product_id) return FALSE; //Это костыль. Я пока та к и не понял почему на каких то страницах новостей вызывается автоматом галлереяя а на каких то нет(((
			
			$object_type = 'articles';
			if($this->input->get("object_type"))
				$object_type = $this->input->get("object_type");
				
			$product = $this->$object_type->get_item_by(array("id" => $product_id));
			
			$gallery = array();
			$images = $this->images->get_list(array("object_type" => $object_type, "object_id" => $product_id), FALSE, FALSE, "name", "asc");
			$_GET['first_img']++;
			if ($_GET['first_img'] == count($images))
				$_GET['first_img'] = 0;
			foreach ($images as $i => $im)
			{
				$im->name = $product->name;
				$im->links = $this->generateLinkList($im, true);
				$titlelink = $this->generateLinkTitle($im, true);
				$im->titlelink = $titlelink[0];
				$im->titlelinkname = $titlelink[1];
				$gallery[] = $im;
			}
			$gallery_title = $product->name;
		}

		foreach($gallery as $key => $img)
		{
			if(!empty($img))
			{
				$gallery[$key] = $this->images->_get_urls($img);
			
				$type = $img->object_type;
				$id = $img->object_id;
			
				$gallery[$key]->info = $this->$type->get_item_by(array("id" => $id));
			}
			else
			{
				unset($gallery[$key]);
			}
		}
		
		$display_caption = 'none';
		$url = explode('/', $product->full_url);
		if ($url[3] == 'catalog')
			$display_caption = 'block';
		$data = array(
			'tree' => $this->categories->get_site_tree($this->config->item('works_id'), "parent_id"),
			"gallery" => $gallery,
			"display_caption" => $display_caption,
			"gallery_title" => $gallery_title
		);
		$this->load->view('client/popup_gallery', $data);
	}	
}