<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Filers_cache class
*
* @package		kcms
* @subpackage	Models
* @category	    Filters_cache
*/
class Filters_cache extends MY_Model
{
	function __construct()
	{
        parent::__construct();
	}
	
	public function insert($cache_id, $cache_data, $type = FALSE, $semantic_url = FALSE)
	{
		$data = array(
			'id' => $cache_id,
			'cache_data' => serialize($cache_data),
			'semantic_url' => ''
		);
		
		if($semantic_url) $data['semantic_url'] = $semantic_url;
		if($type) $data['type'] = $type;

		$this->db->insert($this->_table, $data);
	}
	
	public function get($cache_id)
	{
		$cache = $this->get_item_by(array("id" => $cache_id));
		return $cache ? unserialize($cache->cache_data): FALSE;
	}
	
	public function set_last($cache_id)
	{
		$this->session->set_userdata(array('last_cache_id' => $cache_id));
	}
}