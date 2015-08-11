<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends MY_Model
{
	public $editors = array(
		'Основное' => array(
			'id' => array('id', 'hidden', ''),
			'secret' => array('secret', 'hidden', 'trim'),
			'name' => array('Имя', 'text', 'trim|required|htmlspecialchars|name'),
			'email' => array('Почта', 'text', 'trim|required|htmlspecialchars|valid_email')
		)
	);
	
	public $new_editors = array(
		'Основное' => array(
			'id' => array('id', 'hidden', ''),
			'secret' => array('secret', 'hidden', 'trim'),
			'name' => array('Имя', 'text', 'trim|required|htmlspecialchars'),
			'email' => array('Почта', 'text', 'trim|required|htmlspecialchars|valid_email'),
			'password' => array('Пароль', 'pass', 'trim|required|matches[conf_password]|md5'),
			'conf_password' => array('Повторите пароль', 'pass', 'trim|required|min_length[3]|md5')
		)
	);
	
	function __construct()
	{
        parent::__construct();
		//$this->load->database();
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
	
		$user = $this->get_item_by(array('email' => $email));
		return !empty($user) ? $user->email : FALSE;
	}
	
	/*Изменение пароля*/	
	public function insert_new_pass($email, $new_password, $secret)
	{		
		$this->db->where(array("email" => $email, "secret" => $secret));
		$this->db->update('users', array("password" => $new_password));
	}
}