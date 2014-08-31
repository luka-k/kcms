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
		$menu = $this->menus->top_menu;
		$menu = $this->menus->set_active($menu, "vacancy");
		
		$settings = $this->settings->get_item_by(array('id' => 1));
		$data = array(
			'title' => "Вакансии",
			'meta_title' => $settings->site_title,
			'meta_keywords' => $settings->site_keywords,
			'meta_description' => $settings->site_description,
			'menu' => $menu
		);
		
		$post = $this->input->post();
		if ($_FILES['resume']['error'] <> 4)
		{
			$file_url = $this->files->upload_file($_FILES['resume']);
		}
		
		$admin_email = $this->config->item('admin_email');
		$subject = 'Резюме';
		$message = 'Клиент '.$post['name'].' заказал обратный звонок на номер - '.$post['phone'];
		$message = 'Получено резюме от '.$post['name'].'<br/>';
		$message = $message.'Контактный телефон - '.$post['phone'].'<br/>';
		$message = $message.'e-mail - '.$post['email'];
		if ($post['about'] <> NULL)
		{
			$message = $message.'Соискатель оставил краткую информацию о себе<br/>';
			$message = $message.$post['about'].'<br/>';
		}
		if ($_FILES['resume']['error'] <> 4)
		{
			$message = $message.'Соискатель приложил файл с резюме<br/>';
			$message = $message.'<a href='.base_url().$file_url.'>Скачать резюме</a>';
		}
		if($this->mail->send_mail($admin_email, $subject, $message))
		{
			$data['callback'] = "Ваше резюме отправлено";
		}
		
		
		$this->load->view('client/vacancy.php', $data);
	}
	
}

/* End of file pages.php */
/* Location: ./application/controllers/news.php */