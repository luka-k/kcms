<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Documents class
*
* @package		kcms
* @subpackage	Models
* @category	    Documents
*/
class Documents extends MY_Model
{
	public $editors = array(
		'Основное' => array(
			'id' => array('id', 'hidden'),
			'name' => array('Заголовок', 'text', 'trim|htmlspecialchars|name', 'require'),
			'is_active' => array('выключен', 'checkbox'),
			'sort' => array('Сортировка', 'text'),
			'description' => array('Описание', 'tiny', 'trim')
		),
		'Файл' => array(
			'url' => array('ссылка', 'text', ''),
			'upload_document' =>  array('Загрузка файла', 'upload_document'),
		),
		'Изображения' => array(
			'upload_image' => array('Загрузить изображение', 'image_gallery', 'img')
		),
	);
	
	public $admin_left_column = array(
		"items_tree" => "documents_tree", //дерево для списка элементов
		"item_tree" => "documents_tree", //дерево для страницы редактирования элемента
	);
	
	function __construct()
	{
        parent::__construct();
	}
	
	public function upload($file, $doc_id)
	{
		$upload_path = $this->config->item('files_upload_path');
		
		$file_info = $this->images->get_unique_info($file['name']);
		$file_path = trim(make_upload_path($file_info->name, $upload_path).$file_info->name);
					
		if(!move_uploaded_file($file["tmp_name"], $file_path)) return FALSE;
		
		if($doc_id)
		{
			$document = $this->get_item($doc_id);
			if(!empty($document->url))
			{
				if(file_exists($upload_path.$document->url)) unlink($upload_path.$document->url);
			}
		}
		
		return $file_info->url;
	}
	
	function prepare($item)
	{
		return $item;
	}
}