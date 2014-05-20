<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//PAges model class

class Pages_model extends CI_Model {

    function __construct()
	{
        parent::__construct();
		$this->load->database();
	}
	
	//��������� �������
	public function get_page($url = FALSE)
	{
		//���� url = false ������ ���������� �������
		//���� ������ ��� ������� ��������� �������� � id = 1, �� ������� ��� �� ������ �����. 
		//��� ������� ���� ��� ������� � ������� ���� main � � ������� true
		//�� ���� ���� ������ ������� ���� �������� �� ����
		if ($url === FALSE)
		{
			$query = $this->db->get_where('pages', array('id' => '1'));
		}
		else
		{
			// ���� ������� url �� �������� ��������������� ������.
			$query = $this->db->get_where('pages', array('url' => $url));
		}
		$data = $query->row_array();
		return $data;
	}
	
	//��������� ����
	//���� ��� meta_title �� ���������� ��� �� ������ �������
	public function get_menu()
	{
		$this->db->select('url, meta_title');
		$query = $this->db->get('pages');
		$menu = $query->result_array();
		return $menu;
	}

	
}
/* End of file pages_model.php */
/* Location: ./application/model/task_4/pages_model.php */