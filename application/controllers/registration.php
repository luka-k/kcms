<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Управление пользователями

class Registration extends CI_Controller 
{	
	public function __construct()
	{
		parent::__construct();
		
		$data = array(
			'title' => "Вход",
			'meta_title' => "Вход",
			'error' => " "
		);

		if (!$this->session->userdata('logged_in'))
		{
			$this->load->view('admin/enter.php', $data);	
		} 
	}
	
	
	//Пользователи
	public function users()
	{
		$menu = $this->menus->admin_menu;
		$menu = $this->menus->set_active($menu, 'users');
		$data = array(
			'title' => "Пользователи",
			'meta_title' => "Пользователи",
			'error' => "",
			'name' => $this->session->userdata('user_name'),
			'tree' => $this->parts->get_list(FALSE),
			'menu' => $menu,
			'users' => $this->users->get_list(FALSE)
		);	
		$this->load->view('admin/users.php', $data);	
	}
	
	//Информация о пользователе
	public function user($id = FALSE)
	{
		$menu = $this->menus->admin_menu;
		$menu = $this->menus->set_active($menu, 'users');
		$data = array(
			'title' => "Редактировать пользователя",
			'meta_title' => "Редактировать пользователя",
			'error' => "",
			'name' => $this->session->userdata('user_name'),
			'menu' => $menu,
			'tree' => $this->parts->get_sub_tree(0, "parent")				
		);
			
		if ($id == FALSE)
		{
			//Если id нет выводи пустую форму для долбавления пользователя
			$data['editors'] = $this->users->new_editors;
			$user = new stdClass();
			foreach ($data['editors'] as $tabs)
			{
				foreach ($tabs as $item => $value)
				{
					$user->$item = "";
				}
			}
			$data['content'] = $user;
			$this->load->view('admin/new-user.php', $data);
		}
		else
		//Если id не пустой выводим инфу о пользователе
		{
			$data['editors'] = $this->users->editors;
			$data['content'] = $this->users->get_item_by(array('id' => $id));
			$data['content']->secret = md5($this->config->item('allowed_types'));
			$this->users->update($id, array('secret' => $data['content']->secret));
			$data['content']->password = NULL;
			$this->load->view('admin/user.php', $data);
		}
	}
	
	/*Изменение данных пользователя*/
	public function edit_user($id = FALSE)
	{
		$menu = $this->menus->admin_menu;
		$menu = $this->menus->set_active($menu, 'users');
		$data = array(
			'title' => "Редактировать пользователя",
			'meta_title' => "Редактировать пользователя",
			'error' => "",
			'name' => $this->session->userdata('user_name'),
			'menu' => $menu,
			'tree' => $this->parts->get_sub_tree(0, "parent")			
		);
			
		if ($id == NULL)
		{
			$editors = $this->users->new_editors;
			$post = $this->input->post();
		
			$data['content'] = editors_post($editors, $post);			
			$data['editors'] = $editors;

			$this->form_validation->set_rules('email', 'Email', 'trim|xss_clean|required|valid_email|callback_email_not_exists');
			$this->form_validation->set_rules( 'name','Name','trim|xss_clean|required|min_length[4]|max_length[25]|callback_username_not_exists');	
					
			$this->form_validation->set_rules('password', 'Password', 'trim|xss_clean|required');
			$this->form_validation->set_rules('conf_password',  'Confirm password',  'required|min_length[3]|matches[password]');
					
			//Валидация формы
			if($this->form_validation->run() == FALSE)
			{
				//Если валидация не прошла выводим сообщение об ошибке
				$this->load->view('admin/new-user.php', $data);			
			}
			else
			{	
				//Если id пустой то добавляем нового пользователя
				if (!$this->users->non_requrrent(array('name'=>$data['content']->name)))
				{
					$data['error'] ="Пользователь с таким именем уже зарегистрирован";
					$this->load->view('admin/new-user.php', $data);
				} 
				elseif (!$this->users->non_requrrent(array('email'=>$data['content']->email)))
				{
					$data['error'] ="Такой email уже зарегистрирован";
					$this->load->view('admin/new-user.php', $data);					
				} 
				else 
				{	
					$this->users->insert($data['content']);
					redirect(base_url().'admin/users');
				}
			}						
		}
		else
		{
			$editors = $this->users->editors;
			$post = $this->input->post();
		
			$data['content'] = editors_post($editors, $post);			
			$data['editors'] = $editors;

			$this->form_validation->set_rules('email', 'Email', 'trim|xss_clean|required|valid_email|callback_email_not_exists');
			$this->form_validation->set_rules( 'name','Name','trim|xss_clean|required|min_length[4]|max_length[25]|callback_username_not_exists');	
					
			//Валидация формы
			if($this->form_validation->run() == FALSE)
			{
				//Если валидация не прошла выводим сообщение об ошибке
				$this->load->view('admin/user.php', $data);			
			}
			else
			{					
				//Если id не пустой обновляем не пустые поля
				foreach($data['content'] as $field=>$value)
				{
					if ($value <> NULL)
					{
						$this->db->set($field, $value);
					}
				}
				$this->users->update($data['content']->id);
				redirect(base_url().'admin/users');
			}
		}	
	}
	
	//Удаление пользователя
	public function delete_user($id)
	{
		if($this->users->delete($id))
		{
			redirect(base_url().'admin/users');
		}	
	}	
}