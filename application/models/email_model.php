<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Email_model extends CI_Model {

    function __construct()
	{
        parent::__construct();
		$this->load->library('email');
	}

	function send_mail($from, $who, $to, $subject, $message)
	{
		$config = array(
			'protocol' => "mail",
			'charset' => "iso-8859-1",
			'wordwrap' => TRUE
		);
		$this->email->initialize($config);
		$this->email->from($from, $who);
		$this->email->to($to);
		$this->email->subject($subject);
		$this->email->message($message);
		if(!$this->email->send())
		{
			return false;
		}
		else
		{
			return true;
		}

}

}

/* End of file upload.php */
/* Location: ./application/models/task_1/upload.php */