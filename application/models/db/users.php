<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Users class
*
* @package		kcms
* @subpackage	Models
* @category	    Users
*/
class Users extends MY_Model
{
	/**
	* $editors = array(
	* 	"Наименование вкладки в админке" = array(
	*		"имя поля в базе" => array("Наименование поля для отображения", "наименования отображения", "условия для функции editors_post()", "условия для js валидации")
	*	)
	* )
	* 
	* "условия для функции editors_post" - функции php принимающие на вход один параметр + функции из библиотеки My_form_validation
	*
	* "условия для js валидации" - поддерживается три условия
	*	reqiure - обязателоно для заполнения
	*	email - коректный email
	*	matches[имя поля] - совпадение со значением поля имя которого указано
	* валидация функцией editors_post убрана полность. 
	* позднее расширю js валидацию.
	*/
	public $editors = array(
		'Основное' => array(
			'id' => array('id', 'hidden', ''),
			'secret' => array('secret', 'hidden', 'trim'),
			'name' => array('Имя', 'text', 'trim|htmlspecialchars|name', 'require'),
			'users_group_id' => array('Группа', 'u2u_g', 'users2users_groups'),
			'email' => array('Почта', 'text', 'trim|htmlspecialchars', 'require|email'),
			'password' => array('Пароль', 'pass', 'trim|md5')
		)
	);
	
	function __construct()
	{
        parent::__construct();
	}
	
	/**
	* Авторизация пользователя
	*
	* @param string $email
	* @param string $password
	* @return array
	*/
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
	
	/**
	* Проверка уникальности email
	*
	* @param string $email
	* @return string/bool
	*/
	public function get_user_email($email) 
	{
	
		$user = $this->get_item_by(array('email' => $email));
		return !empty($user) ? $user->email : FALSE;
	}
	
	/**
	* Изменение пароля
	*
	* @param string $email
	* @param string $new_password
	* @param string $secret
	*/
	public function insert_new_pass($email, $new_password, $secret)
	{		
		$this->db->where(array("email" => $email, "secret" => $secret));
		$this->db->update('users', array("password" => $new_password));
	}
	
	/**
	* Получение списка пользователей по id группы 
	*
	* @param integer $group_id
	* @return array
	*/
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
	
	/**
	* Проверка пренадлежности пользователя к группе
	*
	* @param integer $user_id
	* @param integer $group_id
	* @return bool
	*/
	public function in_group($user_id, $group_id)
	{
		$user = $this->users2users_groups->get_item_by(array("users_group_id" => $group_id, "user_id" => $user_id));
		return $user ? TRUE : FALSE;
	}
}