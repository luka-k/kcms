<? if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function editors_post($editors, $post)
{
			foreach ($editors as $edit)
			{
				foreach ($edit as $key => $value)
				{
					if ($value[1] == 'tiny')
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