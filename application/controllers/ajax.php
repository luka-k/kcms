<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Ajax class
*
* @package		kcms
* @subpackage	Controllers
* @category	    Ajax
*/
class Ajax extends CI_Controller{

	public function __construct()
	{
		parent::__construct();
	}

	/**
	* Отправка формы обратной связи
	*/
	function callback()
	{
		$post = json_decode(file_get_contents('php://input', true));
	
		$settings = $this->settings->get_item_by(array("id" => 1));
		
		$message_info = array(
			"USER_NAME" => $post->name,
			"USER_PHONE" => $post->phone
		);
		
		if($this->emails->send_system_mail($settings->admin_email, 6, $message_info))
		{
			$log = "Отправлено письмо на адрес - ".$settings->admin_email." от пользователя - ".$post->name; 
			add_log("callback", $log);
		}
		else
		{
			add_log("ajax", "Отправка не удалась");
		}
		
		$data['message'] = "ok";
		echo json_encode($data);
	}
	
		
	function autocomplete()
	{
		$products = $this->products->get_list(FALSE);
		
		foreach($products as $p)
		{
			$available_tags[] = $p->name;
		}
		$answer['available_tags'] = $available_tags;
		
		echo json_encode($answer);
	}
	
	/**
	* Добавление товара в wishlist
	*/
	public function add_to_wishlist()
	{
		$info = json_decode(file_get_contents('php://input', true));
		
		if(!isset($info->id)) add_log("wishlist", "Не задан id элемента вишлиста для обновления.");

		$this->wishlist->insert($info->id);
		
		$data['message'] = "Ok";
		echo json_encode($data);
	}
	
	/**
	* Удаление из wishlist
	*/	
	public function delete_from_wishlist()
	{
		$info = json_decode(file_get_contents('php://input', true));
		
		if(!isset($info->id)) add_log("wishlist", "Не задан id элемента вишлиста для обновления.");
		
		$this->wishlist->delete($info->id);
		$data['message'] = "Ok";
		echo json_encode($data);
	}
	
	/**
	* Возвращает даты новостей для отметки в календаре
	*/
	public function selected_days()
	{
		$news = $this->articles->get_list(array("parent_id" => 3));
		$selected_dates = array();
		foreach($news as $item)
		{
			$item_date = new DateTime($item->date);
			$item_date = date_format($item_date, 'm/d/Y');
			if(!in_array ( $item->date , $selected_dates)) $selected_dates[] = $item_date;

		}
		$selected_dates[] = date('m/d/Y'); 
	
		$data = $selected_dates;
		
		echo json_encode($data);
	}
}