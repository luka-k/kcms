<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Temp_model extends CI_Model {

	function view_temp($temp, $data, $path)
	{
		$this->load->view("{$path}/header", $data);
		for ($i=0; $i<count($temp); $i++)
		{
			$this->load->view($path."/".$temp[$i], $data);
		}
		$this->load->view("{$path}/footer", $data);
	}

}
	
/* End of file reg_model.php */
/* Location: ./application/model/task_3/reg_model.php */