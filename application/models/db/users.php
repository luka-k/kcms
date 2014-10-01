<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends MY_Model
{
	public $new_editors = array(
		'main' => array(
			'id' => array('id', 'hidden', 0),
			'secret' => array('secret', 'hidden', 0),
			'first_name' => array('First name', 'text', 1),
			'last_name' => array('Last name', 'text', 1),
			'email' => array('Email address', 'text', 1),
			'password' => array('Password', 'pass', 1),
			'conf_password' => array('Confirm password', 'pass', 1),
			'country' => array('Country', 'text', 1),
			'region' => array('Region', 'text', 0),
			'city' => array('Town/City', 'text', 1),
			'address_1' => array('Address line 1', 'text', 0),
			'address_2' => array('Address line 2', 'text', 0),
			'postal' => array('Postal/Zip code', 'text', 0),
			'phone' => array('Phone number', 'text', 1),
			'birth_date' => array('Date of birth', 'text', 0)
		)
	);
	
	public $editors = array(
		'main' => array(
			'id' => array('id', 'hidden', 0),
			'secret' => array('secret', 'hidden', 0),
			'first_name' => array('First name', 'text', 1),
			'last_name' => array('Last name', 'text', 1),
			'email' => array('Email address', 'text', 1),
			'password' => array('Password', 'pass', 1),
			'country' => array('Country', 'text', 1),
			'region' => array('Region', 'text', 0),
			'city' => array('Town/City', 'text', 1),
			'address_1' => array('Address line 1', 'text', 0),
			'address_2' => array('Address line 2', 'text', 0),
			'postal' => array('Postal/Zip code', 'text', 0),
			'phone' => array('Phone number', 'text', 1),
			'birth_date' => array('Date of birth', 'text', 0)
		)
	);
	
	function __construct()
	{
        parent::__construct();
		$this->load->database();
	}
	
	/*Авторизация*/
	public function login($email, $pass, $role)
	{	
		$authdata = array(
			'user_id' => " ",
			'user_name' => " ",
			'role' => " ",
			'logged_in' => 0
			);
	
		if($this->get_count(array('email' => $email, 'password' => $pass, 'role' => $role)) == 1)
		{
			$login = $this->get_item_by(array('email' => $email, 'password' => $pass, 'role' => $role));
			$authdata = array(
				'user_id' => $login->id,
				'user_name' => $login->first_name,
				'role' => $login->role,
				'logged_in' => TRUE
				);		
			$this->session->set_userdata($authdata);
		}
		return $authdata;	
	}
	
	/*Проверка на существование регистрации на такой email*/		
	public function get_user_email($email) 
	{
		//$sql = "SELECT email FROM users WHERE  email=?"; 
		//$query = $this->db->query($sql, $email);
		$email = $this->get_item_by(array('email' => $email));
		if ($email) 
		{
			return $email->email;
		} 
		else 
		{
			return FALSE;
		}
	}
	
	/*Изменение пароля*/	
	public function insert_new_pass($email, $new_password, $secret)
	{
		$query = $this->db->query("UPDATE users SET password = ".$this->db->escape($new_password)." WHERE email=".$this->db->escape($email)." AND secret=".$this->db->escape($secret)."");	
		return $query;
	}
}