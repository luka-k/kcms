<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Articles extends MY_Model
{
	public $editors = array(
		'Основное' => array(
			'id' => array('id', 'hidden', ''),
			'name' => array('Заголовок', 'text', 'trim|required|htmlspecialchars|name'),
			'menu_name' => array('Заголовок в меню', 'text', 'trim|htmlspecialchars|autocomplete[name]'),
			'date' => array('Дата', 'date', 'set_date'),
			'parent_id' => array('Родительская категория', 'select', ''),
			'sort' => array('Сортировка', 'text', ''),
			'file' => array('Файл для Скачать документы', 'file', ''),
			'description' => array('Описание', 'tiny', '')
		),
		'Для контактов' => array(
			'map' => array('Код карты', 'text', 'trim|htmlspecialchars'),
			'map2' => array('Код статичной карты', 'text', 'trim|htmlspecialchars'),
			'map_center' => array('Координаты на карте', 'text', ''),
			'object_id' => array('Id объекта', 'text', '')
		),
		'Изображения' => array(
			'upload_image' => array('Загрузить изображение', 'product_image_gallery', 'img')
		),
		'SEO' => array(
			'meta_title' => array('Meta title страницы', 'text', 'trim|htmlspecialchars'),
			'meta_keywords' => array('Ключевые слова страницы', 'text', 'trim|htmlspecialchars'),
			'meta_description' => array('Описание страницы', 'text', 'trim|htmlspecialchars'),
			'url' => array('url', 'text', 'trim|htmlspecialchars|substituted[name]')
		)
	);
	
	public $admin_left_column = array(
		"items_tree" => "articles_tree",
		"item_tree" => "articles_tree",
	);
	
	function __construct()
	{
        parent::__construct();
	}
	
	public function get_url($item)
	{
		$item_url = $this->make_full_url($item);
		$full_url = implode("/", array_reverse($item_url));
		$full_url = base_url().$full_url;
		return $full_url;		
	}
	
	public function make_full_url($item)
	{
		$item_url = array();
		if(!empty($item)) 
		{
			
			$item_url[] = $item->url;
		
			while($item->parent_id <> 0)
			{
				$parent_id = $item->parent_id;
				$item = $this->get_item_by(array("id" => $parent_id));
				$item_url[] = $item->url;
			}
			$item_url[] = 'articles';
		}
		return $item_url;
	}	
	
	function prepare($item)
	{
		if(!empty($item))
		{
			if(!is_object($item)) $item = (object)$item;
			$item->full_url = $this->get_url($item);
			$item->img = $this->images->get_images(array('object_type' => 'articles', 'object_id' => $item->id));
			$imgs = $this->images->get_images(array('object_type' => 'articles', 'object_id' => $item->id));
			
			if ($imgs)
			{
				if ($imgs[0]->is_cover)
				{
					$item->img[0] = $imgs[0];
					$item->img[1] = $imgs[1];
				} else {
					$item->img[1] = $imgs[0];
					$item->img[0] = $imgs[1];
				}
				$item->has_img = TRUE;
			} else {
				$item->img[0] = new stdClass();
				$item->img[1] = new stdClass();
				
				$item->img[0]->categories_url = '/download/images/i/i/ii.png';
				$item->img[1]->categories2_url = '/download/images/i/i/ii-hover.png';
			}
			
			
			if(!empty($item->date))
			{
				$item_date = new DateTime($item->date);
				$item_date = date_format($item_date, 'd.m.Y');
				$item->date = $item_date;
			}
			
			$this->load->config('articles');
			if($item->parent_id = $this->config->item('news_id'))
			{
				$imgs = $this->parse_description($item->description, $item->full_url);
				if($imgs)
				{
					$item->img = array_merge($imgs, $item->img);
					$item->has_img = TRUE;
				}
			}
			
			if(!empty($item->img))
			{
				foreach($item->img as $img)
				{
					if(isset($img->caption) && (string) strpos($img->caption, 'youtube:') == '0')
					{
						$item->has_video = TRUE;
						break;
					}
				}
			}
			
			return $item;
		}
	}
	
	protected function parse_description($description, $item_full_url)
	{
		if(!empty($description))
		{

			$dom = new DOMDocument;
			$dom->loadHTML($description);
		
			$imgs = array();
			foreach ($dom->getElementsByTagName('a') as $node) 
			{
				$href = $node->getAttribute('href');
				if($item_full_url != $href)
				{
					$href = str_replace('http://brightberry.ru/', '', $href);
						
					$element_images = $this->url->get_imgs_by_href($href);
				
					if(!empty($element_images)) $imgs = array_merge($imgs, $element_images);
				}
			}
			return $imgs;
		}
	}
}