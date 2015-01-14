<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// ���������� ��������������

class Registration extends Admin_Controller 
{	
	public function __construct()
	{
		parent::__construct();
		$this->config->load('order_config');
	}
	
	public function admin_enter()
	{
		$data = array(
			'title' => "����",
			'meta_title' => "����",
			'error' => " "
		);
		$this->load->view('admin/enter.php', $data);
	}
	
	/*����������� ������������*/	
	public function do_enter()
	{
		$data = array(
			'title' => "����",
			'meta_title' => "����",
			'error' => " "
		);
		
		$email = $this->input->post('email');
		$password = md5($this->input->post('password'));			
		$authdata = $this->users->login($email, $password);

		if (!$authdata['logged_in'])
		{
			$data['error'] = "������ �� �����. ��������� ����";		
			$this->load->view('admin/enter.php', $data);	
		} 
		else 
		{
			redirect(base_url().'admin');	
		}	
	}
	
	//�����
	public function logout()
	{
		$role = $this->session->userdata('role');
		$authdata = array(
			'user_id' => '',
			'user_name' => '',
			'logged_in' => ''
			);
		$this->session->unset_userdata($authdata);
		
		redirect(base_url().'admin');
	}
	
	/*����� ����� ������������� ������*/
	public function forgot_pass()
	{
		$data = array(
			'title' => "������������� ������",
			'meta_title' => "������������� ������",
			'error' => " "
		);
		$this->load->view('admin/forgot_form.php', $data);			
	}
	
	/*������������� ������*/	
	public function forgot_password()
	{
		$this->form_validation->set_rules('email', 'E-mail', 'trim|xss_clean|required|valid_email');
		if($this->form_validation->run() == FALSE)
		{
			$data = array(
				'title' => "������������� ������",
				'meta_title' => "������������� ������",
				'error' => "�� ��������� ������ e-mail"
			);

			$this->load->view('admin/forgot_form.php', $data);	
        } 
		else 
		{
			$user_email = $this->users->get_user_email($this->input->post('email'));

			if($user_email) 
			{
				$secret = md5($this->config->item('secret'));
				$email = $this->users->get_item_by(array('email' => $user_email));
				$this->users->update($email->id, array('secret' => $secret));
				$subject = '������������� ������';
				$message = '��������� �� ������ ��� ��������� ������ '.base_url()."registration/reset_password.html?email=$user_email&secret=$secret";
				
				if (!$this->mail->send_mail($user_email, $subject, $message))
				{
				
					$data = array(
						'title' => '������������� ������',
						'meta_title' => "������������� ������",
						'error' => "�� ������� ��������� ������ ��� ������������� ������"
					);

					$this->load->view('admin/forgot_form.php', $data);	
				}
				else
				{					
					$data = array(
						'title' => "����",
						'meta_title' => "����",
						'error' => ""
					);	
					
					$email->role == "admin" ? redirect(base_url().'admin') : redirect(base_url().'cart');			
				}
			} 
			else
			{
				$data = array(
					'title' => "������������� ������",
					'meta_title' => "������������� ������",
					'error' => "E-mail �� ��������������� � �������. ������� ���������� e-mail � ��������� �������."
				);

				$this->load->view('admin/forgot_form.php', $data);	
			}
		}
	}
		
	/*����� ������*/
	public function change_pwd() 
	{
		$this->form_validation->set_rules('password', 'Password', 'trim|xss_clean|required');
		$this->form_validation->set_rules('conf_password',  'Confirm password',  'required|min_length[3]|matches[password]');
			
		if($this->form_validation->run() == FALSE)
		{
			$data = array(
				'title' => "������������� ������",
				'meta_title' => "������������� ������",
				'error' => "",
				'email' => $this->input->get('email'),
				'secret' => $this->input->get('secret')
			);	
			
			$this->load->view('admin/new_pass.php', $data);
		} 
		else 
		{
			$user_email = $this->input->post('user_email');
			$secret = $this->input->post('secret');
			$password = $this->input->post('password');
			$new_password = md5($password);
			
			$this->users->insert_new_pass($user_email, $new_password, $secret); 
			
			$email = $this->users->get_item_by(array('email' => $user_email));
			$this->users->update($email->id, array('secret' => ""));			

			$message_info = array(
				"user_name" => $email->name,
				"login" => $email->email,
				"password" => $this->input->post('password')
			);
				
			$this->emails->send_mail($email->email, 'change_password', $message_info);			
		}

		$email->role == "admin" ? redirect(base_url().'admin') : redirect(base_url().'cart');		
	}
}