<? if ( ! defined('BASEPATH')) exit('No direct script access allowed');

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