<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Ajax class

class Ajax extends CI_Controller {

	function send_mail()
	{
		$post = json_decode(file_get_contents('php://input'), true);

		//var_dump($post);
		$admin_email = $this->config->item('admin_email');
		$subject = 'Запрос на обратный звонок';
		$message = 'Клиент '.$post['name'].' заказал обратный звонок на номер - '.$post['phone'];
		if($this->mail->send_mail($admin_email, $subject, $message))
		{
			echo "Оки-токи письмо отправлено!";
		}

	}
}