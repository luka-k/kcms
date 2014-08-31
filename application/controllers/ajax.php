<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Ajax class

class Ajax extends CI_Controller {

	function index()
	{
		//$post = json_decode(file_get_contents('php://input'), true);
		$post = $this->input->post();
		//var_dump($post);
		$admin_email = $this->config->item('admin_email');
		$subject = 'Запрос на обратный звонок';
		$message = 'Клиент '.$post['name'].' заказал обратный звонок на номер - '.$post['phone'];
		($this->mail->send_mail($admin_email, $subject, $message));
	}
}