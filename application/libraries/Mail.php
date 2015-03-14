<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mail {

    function __construct()
	{
		$this->CI =& get_instance();
		$this->CI->load->library('email');	
		$this->CI->config->load('emails_config');
	}

	function send_mail($to, $subject, $message)
	{
		$config = $this->CI->config->item('config');
		$settings = $this->CI->settings->get_item(1);

		$this->CI->email->initialize($config);
		$this->CI->email->from($settings->admin_email, $settings->admin_name);
		$this->CI->email->to($to);
		$this->CI->email->subject($subject);
		$this->CI->email->message($message);
		
		return !$this->CI->email->send() ? FALSE : TRUE;
	}

}

/* End of file mail.php */
/* Location: ./application/libraries/mail.php */