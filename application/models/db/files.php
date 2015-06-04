<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Files class
*
* @package		kcms
* @subpackage	Models
* @category	    Files
*/
class Files extends MY_Model
{
	function __construct()
	{
        parent::__construct();
		$this->config->load('upload');
	}
	
	public function upload($file, $object_info)
	{
		$upload_path = $this->config->item('files_upload_path');
		
		$file_info = $this->images->get_unique_info($file['name']);
		$file_path = trim(make_upload_path($file_info->name, $upload_path).$file_info->name);
					
		if(!move_uploaded_file($file["tmp_name"], $file_path)) return FALSE;
		
		$data = array(
			"object_type" => $object_info['object_type'],
			"object_id" => $object_info['object_id'],
			"url" => $file_info->url
		);	
	
		$this->insert($data);
		
		return $file_info->url;
	}
	
	public function delete($id)
	{
		$file = $this->get_item($id);
		$this->db->delete($this->_table, array('id' => $id));
		
		$upload_path = $this->config->item('files_upload_path');
		unlink($upload_path."/".$file->url);
		
		return $file->object_id;
	}
	
	public function prepare($item)
	{
		if(!empty($item))
		{
			if(!is_object($item)) $item = (object)$item;
			$item->full_url = base_url()."download/files".$item->url;
			return $item;
		}	
	}
	
}