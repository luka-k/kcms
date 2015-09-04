<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Download extends Client_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	
	public function doc($name)
	{
		$article = $this->articles->get_item_by(array('url' => $name));
		$link = trim(strip_tags($article->description));
		if ($link)
			redirect('http://brightberry.ru'.$link);
	}
	
}