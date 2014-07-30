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
					else
					{
						$data->$key = htmlspecialchars($post[$key]);	
					}
				}
			}
	return $data;
}

/* End of file editiors_helper.php */
/* Location: ./application/helpers/editors_helper.php */