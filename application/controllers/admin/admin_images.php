<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_images extends Admin_Controller 
{

	public function __construct()
	{
		parent::__construct();
	}
	
	public function resize()
	{
		$settings = $this->settings->get_item(1);
		if(!$settings->need_resize) die('Не требуется');
		
		$this->db->select_max('id');
		$max_id = $this->db->get('images')->row()->id;
		
		$this->config->load('upload_config');
			
		$upload_path = $this->config->item('upload_path');
		$thumb_config = $this->config->item('thumb_config');
		
		$from = file_get_contents(FCPATH.'download/resize.txt');
		
		echo 'Старт - '.$from.'<br />';
		
		$this->db->where('id >=', $from);
		$this->db->order_by('id', 'asc');
		$images = $this->db->get('images')->result();

		if(!empty($images))foreach($images as $key => $image)
		{
			file_put_contents(FCPATH.'download/resize.txt', $image->id);
			echo $image->id." - ";
			//if ($image->is_main == 0) continue;

			if (!file_exists('download/images'.$image->url))
			{
				$image->url = str_replace('.jpg', '.tif', $image->url);
				echo '---';
			}
			echo $image->url.'<br>';

			foreach($thumb_config as $path => $param)
			{
				$file_path = $upload_path."/".$path.$image->url;
				if(is_file($file_path)) unlink($file_path);
			}
			
			if(!$this->images->generate_thumbs($upload_path . $image->url) == FALSE)
			{
				file_put_contents(FCPATH.'download/log.log', file_get_contents(FCPATH.'download/log.log')."ERROR: ".$i.':'.$image->id."\n");
				continue;
			}
			
			file_put_contents(FCPATH.'download/log.log', file_get_contents(FCPATH.'download/log.log').$i.':'.$image->id."\n");
						
			if($images->id == $max_id) 
			{
				$this->settings->update(1, array('need_resize' => 0));
				file_put_contents(FCPATH.'download/resize.txt', '0');
			}
		}
	}
}