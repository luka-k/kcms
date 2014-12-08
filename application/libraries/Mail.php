<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mail {

    function __construct()
	{
		$this->CI =& get_instance();
		$this->CI->load->library('email');	
		$this->CI->config->load('upload_config');
	}

	function send_mail($to, $subject, $message)
	{
		$config = array(
			'protocol' => "mail",
			'mailtype' => "html",
			'charset' => "utf-8",
			'wordwrap' => TRUE
		);
		$from = 'admin@admin.com';
		$who = 'Admin';

		$this->CI->email->initialize($config);
		$this->CI->email->from($from, $who);
		$this->CI->email->to($to);
		$this->CI->email->subject($subject);
		$this->CI->email->message($message);
		if(!$this->CI->email->send())
		{
			return false;
		}
		else
		{
			return true;
		}

	}

}

/* End of file mail.php */
/* Location: ./application/libraries/mail.php */