<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//Вывод страниц разделов
class Pages extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index($url)
	{		
		$menu = $this->menus->top_menu;
		$menu = $this->menus->set_active($menu, $url);
		
		/*$items = $this->$url_part->get_list(array('is_active' => '1'), $from, $config['per_page']);*/
		
		$settings = $this->settings->get_item_by(array('id' => 1));
		$data = array(
			'title' => $menu[$url][0],
			'meta_title' => $settings->site_title,
			'meta_keywords' => $settings->site_keywords,
			'meta_description' => $settings->site_description,
			'menu' => $menu
		);
		if($url == "works")
		{
			$content = $this->works->get_list(FALSE);
			foreach ($content as $item)
			{
				$images = $this->images->get_images(array("object_id" => $item->id, "object_type" => "works"));
				foreach($images as $img)
				{
					$type = $img->image_type;
					$item->img[$type] = $img->url;
				}
			}
			//var_dump($content);
			$data['content'] = $content;
		}	
		elseif($url == "price")
		{
			$data['calculator'] = $this->calculator->get_list(FALSE);
			$data['calculator'] = $this->images->get_img_list($data['calculator'], 'calculator');
		}
		//var_dump($data['content']);
		$this->load->view('client/'.$url.'.php', $data);		
	}
	
	
	public function resume()
	{
		$post = $this->input->post();
		//var_dump($post);
		//var_dump($_FILES);
		$this->files->upload_file($_FILES['resume']);
		redirect(base_url().'pages/vacancy');
	}
	
}

/* End of file pages.php */
/* Location: ./application/controllers/news.php */