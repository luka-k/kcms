<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Emails class
*
* @package		kcms
* @subpackage	Models
* @category	    Emails
*/
class Emails extends MY_Model
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
			'type' => array('type', 'hidden'),
			'name' => array('Наименование', 'text',  'trim|name', 'require'),
			'subject' => array('Тема письма', 'text'),
			'description' => array('Текст письма', 'tiny')
		)
	);
	
	function __construct()
	{
        parent::__construct();
		$this->config->load('emails');
	}
	
	/*
	* Отсылка системного письма
	*
	* @param string $to
	* @param integer $template_id
	* @param array $parse_info
	* @param string $template
	* @return bool
	*/
	public function send_system_mail($to, $template_id, $parse_info, $template = 'standart_mail')
	{
		$config = $this->config->item('config');
		$settings = $this->settings->get_item(1);
		
		$info = new stdCLass();
		
		$info->to = $to;
		$info->from_name = $settings->admin_name;
		$info->from_email = 'info@brightberry.ru';
		
		$template_info = $this->get_item($template_id);
		
		$info->subject = $template_info->subject;
		$info->message = $template_info->description;
		
		return $this->mailouts->send_mail($info, $parse_info, $template);
	}	
}

/* End of file emails.php */
/* Location: ./application/models/db/emails.php */