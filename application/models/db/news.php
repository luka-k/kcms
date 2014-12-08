<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News extends MY_Model
{
	public $editors = array(
		'Основное' => array(
			'id' => array('id', 'hidden', ''),
			'name' => array('Заголовок', 'text', 'trim|required|htmlspecialchars|name'),
			'article_parent_id' => array('Раздел', 'n2a', 'news2article'),
			'sort' => array('Сортировка', 'text', ''),
			'description' => array('Описание', 'tiny', '')
		),
		'SEO' => array(
			'meta_title' => array('Meta title страницы', 'text', 'trim|htmlspecialchars'),
			'meta_keywords' => array('Ключевые слова страницы', 'text', 'trim|htmlspecialchars'),
			'meta_description' => array('Описание страницы', 'text', 'trim|htmlspecialchars'),
			'url' => array('url', 'text', 'trim|htmlspecialchars|substituted[name]')
		),
		'Изображение' => array(
			'upload_image' => array('Добавить изображение к новости', 'image', 'img')
		)
	);
	
	function __construct()
	{
        parent::__construct();
	}
	
	function get_news($url)
	{
		$article = $this->articles->get_item_by(array("url" => $url));
		$news_id = $this->news2article->get_list(array("article_parent_id" => $article->id));
		
		$news = array();
		foreach($news_id as $item)
		{
			$news[] = $this->news->get_item_by(array("id" => $item->child_id));
		}
		
		return $news;
	}
	
	function prepare($item)
	{
		//var_dump($item);
		//$item->full_url = $this->get_url($item->url);
		$item->img = $this->images->get_images(array("object_type" => "news", "object_id" => $item->id), "news", 1);
		return $item;
	}
}