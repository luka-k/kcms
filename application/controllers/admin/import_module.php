<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* import_module class
*
* @package		kcms
* @subpackage	Controllers
* @category	    import_module
*/
class Import_module extends Admin_Controller 
{

	public function __construct()
	{
		parent::__construct();
		
		$this->load->library('import');
	}
	
	public function index()
	{
		$this->load->config('import');
		$data = array(
			'title' => "Импорт",
			'url' => $this->uri->uri_string(),
			'publishers' => $this->config->item('publishers')
		);	
		
		$data = array_merge($this->standart_data, $data);
	
		$this->load->view('admin/import.php', $data);
	}
	
	public function load()
	{
		if ($_FILES['xml_file']['error'] == 0 && $_FILES['xml_file']['type'] == 'text/xml')
		{
			$this->config->load('upload');
			$upload_path = $this->config->item('import_upload_path');
			$path = $upload_path.'\\'.$_FILES['xml_file']['name'];
			if(move_uploaded_file($_FILES['xml_file']["tmp_name"], $path))
			{
				$publisher = $this->input->post('publisher');
				
				$xmlstr = file_get_contents($path);

				$this->import->$publisher($xmlstr);
			}
		}
		unlink($path);
		echo '<a href="'.base_url().'/admin">На главную</a></br>';
	}
}