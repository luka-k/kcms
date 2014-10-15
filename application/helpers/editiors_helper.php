<? if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function editors_post($editors, $post, $type)
{
			foreach ($editors as $edit)
			{
				foreach ($edit as $key => $value)
				{
					if ($this->db->field_exists($key, $type))
					{
				
					if (($value[1] == 'tiny')||($value[1] == 'select')||($value[1] == 'select_2'))
					{
						$data->$key = $post[$key];				
					}
					elseif (($value[1] == 'checkbox') and (!array_key_exists($key, $post)))
					{
						$data->$key = 0;
					}
					else
					{
						$data->$key = htmlspecialchars($post[$key]);	
					}
					
					if(($value[2] == 'url'))
					{
						if (isset($post['url']))
						{
							if(empty($post['url']))
							{
								$data->url = $post[$key];
							}
						}
					}
					}
				}
			}
	return $data;
}

function editors_key_exists($field, $editors)
{
	foreach($editors as $item)
	{
		if(array_key_exists($field, $item))
		{
			return TRUE;
		}
	}
	return FALSE;
}


/* End of file editiors_helper.php */
/* Location: ./application/helpers/editors_helper.php */