<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends MY_Model
{
	public $editors = array(
		'Основное' => array(
			'id' => array('id', 'hidden'),
			'secret' => array('secret', 'hidden'),
			//'status' => array('Статус', 'select'),
			'name' => array('Имя', 'text'),
			'email' => array('Почта', 'text')
			//'password' => array('Пароль', 'pass')
		)
	);
	
	public $new_editors = array(
		'Основное' => array(
			'id' => array('id', 'hidden'),
			'secret' => array('secret', 'hidden'),
			'name' => array('Имя', 'text'),
			'email' => array('Почта', 'text'),
			'phone' => array('Телефон', 'text'),
			'address' => array('Адрес', 'text'),
			'password' => array('Пароль', 'pass'),
			'conf_password' => array('Повторите пароль', 'pass')
		)
	);
	
	function __construct()
	{
        parent::__construct();
		$this->load->database();
	}
	
	/*Авторизация*/
	public function login($e_email, $e_pass)
	{	
		$authdata = array(
			'user_id' => " ",
			'user_name' => " ",
			'role' => " ",
			'logged_in' => 0
			);
	
		if($this->get_count(array('email' => $e_email, 'password' => $e_pass)) == 1)
		{
			$login = $this->get_item_by(array('email' => $e_email, 'password' => $e_pass));
			$authdata = array(
				'user_id' => $login->id,
				'user_name' => $login->name,
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