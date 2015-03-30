<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Mailouts class
*
* @package		kcms
* @subpackage	Models
* @category	    Mailouts
*/
class Mailouts extends MY_Model
{
	/**
	* $editors = array(
	* 	"Наименование вкладки в админке" = array(
	*		"имя поля в базе" => array("Наименование поля для отображения", "наименования отображения", "условия для функции editors_post()", "условия для js валидации")
	*	)
	* )
	* 
	* "условия для функции editors_post" - функции php принимающие на вход один параметр + функции из библиотеки My_form_validation
	*
	* "условия для js валидации" - поддерживается три условия
	*	reqiure - обязателоно для заполнения
	*	email - коректный email
	*	matches[имя поля] - совпадение со значением поля имя которого указано
	* валидация функцией editors_post убрана полность. 
	* позднее расширю js валидацию.
	*/
	public $editors = array(
		'Основное' => array(
			'id' => array('id', 'hidden'),
			'template_id' => array('template_id', 'hidden'),
			'users_ids' => array('Группы подписчиков', 'text',  'trim|name', 'require'),
			'mailouts_date' => array('Дата', 'text', 'set_date')
		)
	);
	
	function __construct()
	{
        parent::__construct();
	}
	
	/**
	* Отправка письма
	*
	* @param array $send_info
	* @param array $data
	* @param string $template
	* @return bool
	*/
	public function send_mail($send_info, $data, $template = 'standart_mail')
	{
		$config = $this->config->item('config');
		$subject = $send_info->subject;
		$message = $send_info->message;

		if(isset($data))
		{
			foreach($data as $key => $info)
			{
				$subject = str_replace("%".$key."%", $info, $subject);
				$message = str_replace("%".$key."%", $info, $message);
			}
		}
		
		$data['subject'] = $subject;
		$data['message'] = $message;
		$template_message = $this->load->view('admin/email/'.$template.'.php', $data, TRUE);

		$this->email->initialize($config);
		$this->email->from($send_info->from_email, $send_info->from_name);
		$this->email->to($send_info->to);
		$this->email->subject($subject);
		$this->email->message($template_message);
		
		return !$this->email->send() ? FALSE : TRUE; 
	}
	
	/**
	* 
	*
	* @param object $item
	* @return object
	*/
	public function prepare($item)
	{
		$groups = explode("/", $item->users_ids);
		foreach($groups as $g)
		{
			$group = $this->users_groups->get_item($g);
			$item->users_groups[] = $group->name;
		}
		
		$template = $this->emails->get_item($item->template_id);
		$item->template = $template->name;
		return $item;
	}
}