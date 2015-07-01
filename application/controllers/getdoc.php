<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Getdoc class
*
* @package		kcms
* @subpackage	Controllers
* @category	    Getdoc
*/
class Getdoc extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	
	public function index($code)
	{
		$file = $this->files->get_item_by(array("download_code" => $code));
		if($file)
		{
			header('Content-Description: File Transfer');
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename='.str_replace(' ', '_', $file->name));
			header('Content-Transfer-Encoding: binary');
			header('Expires: 0');
			header('Cache-Control: must-revalidate');
			header('Pragma: public');

			echo file_get_contents(DOCUMENTS_PATH.$file->url);
		}
	}
}