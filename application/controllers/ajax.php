<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Ajax class

class Ajax extends CI_Controller {

	function index()
	{
		//$post = json_decode(file_get_contents('php://input'), true);
		$post = $this->input->post();
		$admin_email = $this->config->item('admin_email');
		$subject = 'Запрос на обратный звонок';
		$message = 'Клиент '.$post['name'].' заказал обратный звонок на номер - '.$post['phone'];
		if(isset($post['time']))
		{
			$message .= '<br/> Удобное время для звонка - '.$post['time'];
		}
		
		if(isset($post['comment']))
		{
			$message .= '<br/> клиент оставил коментарий:<br/>'.$post['comment'];
		}
		($this->mail->send_mail($admin_email, $subject, $message));
	}
}