<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reg_model extends CI_Model {

    function __construct()
	{
        parent::__construct();

	}
	
	/*Авторизация*/
	public function login($e_email, $e_pass)
	{	
		$authdata = array(
			'user_id' => " ",
			'user_name' => " ",
			'logged_in' => 0
			);
			
		$sql = "SELECT * FROM users WHERE email=? AND password=?"; 
		$query = $this->db->query($sql, array($e_email, $e_pass));		
		
		if ($query->num_rows() == 1) 
		{
			$authdata = array(
				'user_id' => $query->row()->id,
				'user_name' => $query->row()->name,
				'logged_in' => TRUE
				);
				
			$this->session->set_userdata($authdata);
			//setcookie("auth[id]", $authdata["user_id"]);
			//setcookie("auth[name]", $authdata["user_name"]);
			//setcookie("auth[logged]", $authdata["logged_in"]);
		}
		return $authdata;		
	}
		
	/*создание пользователя*/	
    function create_user($username, $password, $email) 
	{
		$data = array(
			'name' => $username,
			'password' => $password,
			'email' => $email
            );
		/*Судя по туториалам конструкция является безопасной*/
        $this->db->insert('users', $data);
	}
		
	/*Проверка уникальности имени пользователя*/
	function check_username($username)
	{
		$sql = "SELECT * FROM users WHERE name=?"; 
		$query = $this->db->query($sql, $username);		
		$result = $query->result_array();
		if ($query->num_rows()>0)
		{
			return FALSE;
		} 
		else 
		{
			return TRUE;
		}
	}
	
	/*Проверка уникальности почты пользователя*/
	function check_email($email)
	{
		$sql = "SELECT * FROM users WHERE email=?"; 
		$query = $this->db->query($sql, $email);	
		$result = $query->result_array();
		if ($query->num_rows()>0)
		{
			return FALSE;
		} 
		else 
		{
			return TRUE;
		}
	}
		
	/*Проверка на существование регистрации на такой email*/		
	public function get_user_email($email) 
	{
		$sql = "SELECT email FROM users WHERE  email=?"; 
		$query = $this->db->query($sql, $email);
		if ($query->num_rows()> 0) 
		{
			return $query->first_row('array');
		} 
		else 
		{
			echo "This email not found";
		}
	}
		
	/*Изменение пароля*/	
	public function insert_new_pass($email, $new_password, $secret)
	{
		$query = $this->db->query("UPDATE users SET password = ".$this->db->escape($new_password)." WHERE email=".$this->db->escape($email)." AND secret=".$this->db->escape($secret)."");	
		$query = $this->db->query("UPDATE users SET secret = NULL WHERE email=".$this->db->escape($email)." AND secret=".$this->db->escape($secret)."");
		return $query;
	}
}
	
/* End of file reg_model.php */
/* Location: ./application/model/task_3/reg_model.php */