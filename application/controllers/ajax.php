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
			"user_name" => $post->name,
			"user_phone" => $post->phone
		);
		
		if($this->emails->send_system_mail($settings->admin_email, 6, $message_info))
		{
			$log = "Отправлено письмо на адрес - ".$settings->admin_email." от пользователя - ".$post->name; 
			add_log("callback", $log);
			$data = array(
				'title' => 'Спасибо за оставленную заявку!',
				'message' => '<p>Наш менеджер свяжется <br />с вами в ближайшее время.</p>'
			);
		}
		else
		{
			add_log("callback", "Отправка не удалась");
			$data = array(
				'title' => 'Что то пошло не так!',
				'message' => '<p>Повторите попытку попозже.<br />Приносим извенения за не удобства.</p>'
			);
		}
	
		echo json_encode($data);
	}
	
		
	function autocomplete()
	{
		$info = $this->input->post();
		
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
	
	public function more_products()
	{
		$info = $this->input->post();

		if(!empty($info->parent_id))
		{
			$products = $this->products->prepare_list($this->catalog->get_products($info['parent_id'], 'name', 'asc', $info['ajax_from'], 3));
		}
		else
		{
			$products = $this->products->prepare_list($this->characteristics->get_products_by_filter($info, 'name', 'asc', $info['ajax_from'], 3));
		}
		
		$content = '';
		if($products) foreach($products as $item)
		{
			$product = array('item' => $item);
			$content .= $this->load->view('client/include/product_item', $product, TRUE);
		}

		$ajax_from = $info['ajax_from'] + 3;
		
		$data = array(
			'content' => $content,
			'parent_id' => $info['parent_id'],
			'ajax_from' => $ajax_from
		);

		echo json_encode($data);
	}
}