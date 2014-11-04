<? if ( ! defined('BASEPATH')) exit('No direct script access allowed');


function editors_field_exists($field, $editors)
{
	$field_name = "";
	foreach ($editors as $edit)
	{
		foreach ($edit as $key => $value)
		{
			if (isset($value[2]))
			{
				$items = explode("|", $value[2]);
				foreach($items as $item)
				{
					if($item == $field)
					{
						$field_name = $key;
					}
				}
			}
		}
	}
	return $field_name;
}

/* End of file editiors_helper.php */
/* Location: ./application/helpers/editors_helper.php */