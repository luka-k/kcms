<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Brightbild class
*
* @package		kcms
* @subpackage	Controllers
* @category	    Brightbild
*/
class Brightbild extends Client_Controller {
	
	public function __construct()
	{
		parent::__construct();	
	}
	
	public function index()
	{
		$this->config->load('articles');
		$parent_id = $this->config->item('brightbild_id');
		
		$data = array(
			"title" => "Брайтбилд - комплектация объектов",
			'meta_description' => '',
			'meta_keywords' => '',
			'top_active' => 'bb',
			"brightbild" => $this->articles->prepare_list($this->articles->get_list(array("parent_id" => $parent_id))),
			"last_news" => $this->articles->prepare_list($this->articles->get_list(array("parent_id" => 1), 10, 0, "date", "asc")),
		);
		
		//my_dump($data['brightbild']);
		
		$data = array_merge($this->standart_data, $data);
		$this->load->view("client/catalog/brightbild", $data);
	}
}