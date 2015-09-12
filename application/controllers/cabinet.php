<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Cabinet class
*
* @package		kcms
* @subpackage	Controllers
* @category	    Cabinet
*/
class Cabinet extends Client_Controller {

	public $orders; 
	public $orders_info = array();
	
	public function __construct()
	{
		parent::__construct();
	}
	
	/**
	* Обновление информации о пользователе
	*
	* @param string $type
	*/
	public function update_info($type = "info")
	{
		$user = (object)$this->input->post();
		if($type == "pass")
		{
			$user->password = md5($user->password);
			unset($user->conf_password);
		}	
		$this->users->update($user->id, $user);
		
		redirect(base_url().'cabinet');
	}
	
}