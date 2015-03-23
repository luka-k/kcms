<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users_model extends MY_Model
{
	public $editors = array(
		'Основное' => array(
			'id' => array('id', 'hidden', ''),
			'secret' => array('secret', 'hidden', 'trim'),
			'name' => array('Имя', 'text', 'trim|required|htmlspecialchars|name'),
			'users_group_id' => array('Группа', 'u2u_g', 'users2users_groups'),
			'email' => array('Почта', 'text', 'trim|required|htmlspecialchars|valid_email'),
			'password' => array('Пароль', 'pass', 'trim|md5')
		)
	);
	
	function __construct()
	{
        parent::__construct();
	}
	
	/*Авторизация*/
	public function login($email, $password)
	{	
		$authdata = array(
			'user' => " ",
			'user_groups' => "",
			'logged_in' => 0
			);
	
		if($this->get_count(array('email' => $email, 'password' => $password)) == 1)
		{
			$user = $this->get_item_by(array('email' => $email, 'password' => $password));

			$authdata = array(
				'user' => $user,
				'logged_in' => TRUE
				);		
			$u2u_g = $this->users2users_groups->get_list(array("user_id" => $user->id));

			
			foreach($u2u_g as $g)
			{
				$group = $this->users_groups->get_item($g->users_group_id);
				$authdata['user_groups'][] = $group->name;
			}
			
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
	
	//Вывод списока пользователей по id группы 
	public function group_list($group_id)
	{
		$users_id = $this->users2users_groups->get_list(array("users_group_id" => $group_id));
		
		$users = array();
		foreach($users_id as $item)
		{
			$users[] = $this->get_item($item->user_id);
		}
		
		return $users;
	}
	
	//Проверка принадлежности пользователя к группе
	public function in_group($user_id, $group_id)
	{
		$user = $this->users2users_groups->get_item_by(array("users_group_id" => $group_id, "user_id" => $user_id));
		return $user ? TRUE : FALSE;
	}
}