<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Content extends Admin_Controller 
{

	public function __construct()
	{
		parent::__construct();
	}
	
	public function reThumb()
	{
		$images = $this->images->get_list(array('object_type' => 'products'));
		$upload_path = $this->config->item('upload_path');
		foreach ($images as $i => $im)
		{
			//if ($i <= 900 || $i > 1000) continue;
			echo $upload_path . $im->url.'<br>';
			$this->images->generate_thumbs($upload_path . $im->url);
			flush();
			/*$url = explode('/', $im->url);
			mkdir ('/home/admin/web/riba-service.ru/public_html/sub/bb/download/images/'.$url[1]);
			mkdir ('/home/admin/web/riba-service.ru/public_html/sub/bb/download/images/'.$url[1].'/'.$url[2]);
			$url = $url[count($url) - 1];
			if (file_exists('/home/admin/web/riba-service.ru/public_html/sub/bb/download/images/old/'.$url))
			{
				copy('/home/admin/web/riba-service.ru/public_html/sub/bb/download/images/old/'.$url, '/home/admin/web/riba-service.ru/public_html/sub/bb/download/images/'.$im->url);
				echo $url;
			}*/
		}
	}
	
	public function items($type, $id = FALSE)
	{
		$this->menu = $this->menus->set_active($this->menu, $type);
		
		//При помощи функции editors_field_exists находим поле у которого в третьем параметре указано name
		//Это поле используем как поле для колонки Имя
		//Тем самым избавляемся от привязки к названию name(title) и тд.
		//Например делая сайт каталисту я столкнулся если есть четкая привязка к name то к туровым датам надо указывать имя какоенибудь
		//что не всегда удобно.
		$name = editors_field_exists('name', $this->$type->editors);
		
		isset($this->$type->admin_left_column) ? $left_column = $this->$type->admin_left_column: $left_column = "off";

		$data = array(
			'title' => "Страницы",
			'error' => "",
			'user' => $this->user,
			'menu' => $this->menu,
			'left_column' => $left_column,
			'type' => $type,
			'name' => $name
		);	
				
		$this->db->field_exists('sort', $type) ? $order = "sort" : $order = "name";
		$direction = "acs";
		
		if($this->db->field_exists('parent_id', $type))
		{
			$type == "products" ? $data['tree'] = $this->categories->get_tree(0, "parent_id") : $data['tree'] = $this->$type->get_tree(0, "parent_id");
		}
		
		if($id == FALSE)
		{
			$data['content'] = $this->$type->get_list(FALSE, $from = FALSE, $limit = FALSE, $order, $direction);
			$data['sortable'] = !($this->db->field_exists('parent_id', $type)) ? TRUE : FALSE;
		}
		else
		{
			$type == "emails" ? $parent = "type" : $parent = "parent_id";
			$data["parent_id"] = $id;
			$data['content'] = $this->$type->get_list(array($parent => $id), $from = FALSE, $limit = FALSE, $order, $direction);
			$data['sortable'] = TRUE;
		}
		
		if(editors_field_exists('img', $this->$type->editors))
		{
			$data['content'] = $this->images->get_img_list($data['content'], $type, "catalog_small");
			$data['images'] = TRUE;
		}
		
		$this->load->view('admin/items.php', $data);
	}
	
	public function item($action, $type, $id = FALSE, $exit = FALSE)
	{
		$this->menu = $this->menus->set_active($this->menu, $type);
		
		isset($this->$type->admin_left_column) ? $left_column = $this->$type->admin_left_column: $left_column = "off";
		$name = editors_field_exists('name', $this->$type->editors);
		
		$data = array(
			'title' => "Редактировать",
			'error' => "",
			'user' => $this->user,
			'menu' => $this->menu,
			'left_column' => $left_column,
			'editors' => $this->$type->editors,
			'type' => $type,
			'name' => editors_field_exists('name', $this->$type->editors)
		);
		
		if($this->db->field_exists('parent_id', $type))
		{
			$type == "products" ? $tree = $this->categories->get_tree(0, "parent_id") : $tree = $this->$type->get_tree(0, "parent_id");
			$data['tree'] = $tree;
			$data['producttree'] = $this->categories->get_tree(0, "parent_id");
			$data['selects']['parent_id'] = $tree;
		}
		
		if($type == "emails")
		{
			$data['selects']['users_type'] = $this->users_groups->get_list(FALSE);
		}
		
		if($action == "edit")
		{
			if($id == FALSE)
			{	
				$data['content'] = set_empty_fields($data['editors']);
				
				if($this->db->field_exists('parent_id', $type))
				{
					$parent_id = $this->input->get('parent_id');
					$data['content']->parent_id = $parent_id;
				}
				
				$data['content']->is_active = "1";
				$data['content']->img = NULL;
				
				if($type == "emails") $data['content']->type = 2;
				
				
				$field_name = editors_field_exists('ch', $data['editors']);
				if(!empty($field_name))
				{
					$this->config->load('characteristics_config');
					$data['content']->ch_select = $this->config->item('characteristics_type');
					$data['content']->characteristics = array();
				}
			}	
			else
			{			
				$data['content'] = $this->$type->get_item_by(array('id' => $id));
				$object_info = array(
					"object_type" => $type,
					"object_id" => $data['content']->id
				);
				$data['content']->img = $this->images->get_images($object_info);
				
				if($type == "products" || $type == "articles")
				{
					if($data['content']->img)
					{
						foreach($data['content']->img as $key => $img)
						{
							$categories = $this->images2categories->get_list(array("child_id" => $img->id));
							foreach($categories as $item)
							{
								$data['content']->img[$key]->img_categories[] = $item->category_parent_id;
							}
						}
					}
				}

				$field_name = editors_field_exists('ch', $data['editors']);
				if(!empty($field_name))
				{
					$this->config->load('characteristics_config');
					$data['ch_select'] = $this->config->item('characteristics_type');
					$data['content']->characteristics = $this->characteristics->get_list(array("object_id" => $id,"object_type" => $type));
					foreach($data['content']->characteristics as $characteristic)
					{
						foreach($data['ch_select'] as $key => $type)
						{
							if($characteristic->type == $key) $characteristic->name = $type;
						}
					}
				}
			}
			$this->load->view('admin/item.php', $data);
		}
		elseif($action == "save")
		{
			$data['content'] = $this->$type->editors_post()->data;

			if($this->$type->editors_post()->error == TRUE)
			{
				//Если валидация не прошла выводим сообщение об ошибке
				$this->load->view('admin/item.php', $data);			
			}
			else
			{			
				//Если валидация прошла успешно проверяем переменную id
				if ($type == 'articles' || $type == 'categories' || $type == 'products')
				{
					$data['content']->lastmod = date('Y-m-d');
				}
				if($data['content']->id == FALSE)
				{
					//Если id пустая создаем новую страницу в базе
					$this->$type->insert($data['content']);
					$data['content']->id = $this->db->insert_id();				
				}
				else
				{
					//Если id не пустая вносим изменения.
					$this->$type->update($data['content']->id, $data['content']);
				}
				if ($type == "articles" && $_FILES['file']['tmp_name'])
				{
					if ($_FILES['file']['error'] == 0)
					{
						$ext = explode('.', $_FILES['file']['name']);
						$ext = $ext[count($ext)-1];
						$fname = slug(str_replace('.'.$ext, '', $_FILES['file']['name']));
						$filename = 'download/editor/file/'.$fname.'.'.$ext;
						move_uploaded_file($_FILES['file']['tmp_name'], $filename);
						$this->$type->update($data['content']->id, array('description' => '/'.$filename));
					}
				} 
				$im_changed = false;
				$field_name = editors_field_exists('img', $data['editors']);
				//Получаем id эдитора который предназначен для загрузки изображения
				//Если например нужно две галлереи для товара то делаем в функции editors_field_exists $field_name массивом и пробегаем ниже по нему
				if(!empty($field_name))
				{
					$object_info = array(
						"object_type" => $type,
						"object_id" => $data['content']->id
					);
					
					if($type == "products" || $type == "articles")
					{
						$is_main = $this->input->post('is_main');
						
						foreach( $this->input->post('img_del') as $img_del_id => $on)
						{
							$this->images->delete($img_del_id);
							$im_changed = true;
						}
						
						$this->db->where($object_info)->update('images', array('is_main' => 0));
						
						if($is_main)
						{
							foreach($is_main as $key => $value)	
							{
								$this->images->update($key, array("is_main" => $value));
								$im_changed = true;
							}
						}
						
						$img_ids = $this->input->post('img_ids');
						if($img_ids)
						{
							$this->db->where_in('child_id', $img_ids);
							$this->db->delete('images2categories');
						}
						
						$img2cat = $this->input->post('img2cat');
						if($img2cat)
						{							
							foreach($img2cat as $img_id => $category_id)
							{
								$img_id = explode("-" , $img_id);
								$this->images2categories->insert(array("category_parent_id" => $category_id, "child_id" => $img_id[0]));
								$im_changed = true;
							}
						}

					}
		
					$cover_id = $this->input->post("cover_id");
					if ($cover_id <> NULL) 
					{
						$this->images->set_cover($object_info, $cover_id);
						$im_changed = true;
					}
					if (isset($_FILES[$field_name])) {
						foreach ($_FILES[$field_name]['error'] as $i => $error) {
						  if ($error <> 4) {
							$upload_array = array(
								'name' => $_FILES[$field_name]['name'][$i],
								'tmp_name' => $_FILES[$field_name]['tmp_name'][$i],
								'type' => $_FILES[$field_name]['type'][$i],
								'error' => $_FILES[$field_name]['error'][$i],
								'size' => $_FILES[$field_name]['size'][$i]
							);
							$this->images->upload_image($upload_array, $object_info);
							$im_changed = true;
						  }
						}
					}
					if ($_POST['upload_youtube'])
					{
						$_POST['upload_youtube'] = str_replace('https://youtu.be/', '', $_POST['upload_youtube']);
						$_POST['upload_youtube'] = explode('?', $_POST['upload_youtube']);
						$_POST['upload_youtube'] = $_POST['upload_youtube'][0];
						$thumb = file_get_contents("http://i.ytimg.com/vi/".$_POST['upload_youtube']."/mqdefault.jpg");
						$thumb_filename = "/home/admin/web/brightberry.ru/public_html/download/images/youtube/".$_POST['upload_youtube'].'.jpg';
						file_put_contents($thumb_filename, $thumb);
						$upload_array = array(
							'name' => $_POST['upload_youtube'],
							'tmp_name' => $thumb_filename,
							'error' => 0,
							'size' => 666
						);
						$object_info['caption'] = 'youtube:'.$_POST['upload_youtube'];
						$this->images->upload_image($upload_array, $object_info);
						$im_changed = true;
					}
				}
				
				isset($data['content']->parent_id) ? $p_id = $data['content']->parent_id : $p_id = "";
				if($type == "emails") $p_id = $data['content']->type;
				
				$exit == false ? redirect(base_url().'admin/content/item/edit/'.$type."/".$data['content']->id.($im_changed ? '#tab_3' : '')) : redirect(base_url().'admin/content/items/'.$type."/".$p_id);	
			}
		}
		if($action == "copy")
		{
			$data['content'] = $this->$type->get_item_by(array('id' => $id));
			
			$field_name = editors_field_exists('ch', $data['editors']);
			if(!empty($field_name))	$characteristics = $this->characteristics->get_list(array("object_id" => $data['content']->id));
			
			$data['content']->id = NULL;
			$data['content']->url = "";
			
			foreach($data['content'] as $key => $value)
			{
				if(!$this->db->field_exists($key, $type)) unset($data['content']->$key);
			}
			
			$this->$type->insert($data['content']);
			$new_id = $this->db->insert_id();
			
			if(is_array($characteristics)) foreach($characteristics as $ch)
			{
				$ch->id = NULL;
				$ch->object_id = $new_id;
				$this->characteristics->insert($ch);
			}
			
			redirect(base_url().'admin/content/item/edit/'.$type."/".$new_id);
		}
	}
		
	//Удаление элемента
	public function delete_item($type, $id)
	{
		if($this->$type->delete($id)) redirect(base_url().'admin/content/items/'.$type);
	}
	
	/*--------------Удаление изображения-------------*/
	
	public function delete_img($object_type, $id)
	{
		$object_info = array(
			"object_type" => $object_type,
			"id" => $id
		);
		$item_id = $this->images->delete_img($object_info);
		$this->db->delete('images2categories', array('child_id' => $id)); 
		redirect(base_url().'admin/content/item/edit/'.$object_type."/".$item_id."#tab_3");
	}
	
	public function delete_characteristic($id)
	{
		$ch = $this->characteristics->get_item_by(array("id" => $id));
		if($this->characteristics->delete($id)) redirect(base_url().'admin/content/item/edit/'.$ch->object_type."/".$ch->object_id."#tab_4");
	}
	
	public function main_gallery_sort()
	{
		$this->menu = $this->menus->set_active($this->menu, "settings");
	
		$gallery = $this->images->get_list(array("object_type" => "products", "is_main" => 1), $from = FALSE, $limit = FALSE, "sort", "asc");
		foreach($gallery as $key => $img)
		{
			$gallery[$key] = $this->images->_get_urls($img);
		}

		$data = array(
			'title' => "Сортировка галлереи на главной",
			'error' => "",
			'user' => $this->user,
			'menu' => $this->menu,
			'type' => "images",
			'sortable' => TRUE,
			"content" => $gallery
		);	
		
		
		$this->load->view('admin/gallery_sort.php', $data);
	}
	
	public function update_image_info()
	{
		$info = json_decode(file_get_contents('php://input', true));
		
		$this->images->update($info->id, array($info->type => $info->value));
	}
}