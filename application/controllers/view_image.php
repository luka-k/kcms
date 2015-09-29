<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class View_image extends CI_Controller
{	
	public function index()
	{
		$id = $this->input->get('id');
		if($id <> '')
		{
			$child = $this->child_users->get_item($id);
			header('Content-Type: image/jpeg');
		
			echo $child->image;
		}
		else
		{
			echo '';
		}
	}
}