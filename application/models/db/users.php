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
			'secret' => array('secret', 'hidden'),
			'name' => array('Имя', 'text', 'trim|name', 'require'),
			'rank' => array('Должность', 'text', 'trim'),
			'users2users_groups' => array('Группа', 'u2u_g', 'users2users_groups'),
			'email' => array('Почта', 'text', 'trim', 'require|email|unique'),
			'vk_link' => array('Cсылка vk', 'text', 'trim'),
			'phone' => array('Телефон', 'text', 'trim'),
			'description' => array('Описание', 'tiny', 'trim'),
			'password' => array('Пароль', 'pass', 'trim|md5')
		),
		'Изображения' => array(
			'upload_image' => array('Загрузить изображение', 'image_gallery', 'img')
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
		$users_id = $this->table2table->get_fixing('users2users_groups', 'user_id', 'users_group_id', $group_id);
		
		$users = array();
		if(!empty($users_id))
		{
			$this->db->where_in('id', $users_id);
			$this->db->order_by('sort');
			$users = $this->db->get($this->_table)->result();
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
	
	function prepare($item, $cover = TRUE)
	{
		if(!empty($item))
		{
			$object_info = array(
				"object_type" => 'users',
				"object_id" => $item->id
			);
			
			$item->img = $this->images->get_cover($object_info);
			
			return $item;
		}
	}
}