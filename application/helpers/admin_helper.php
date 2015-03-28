<? if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*************************************************************************************************************************************
*При помощи функции editors_get_name_field находим поле у которого в третьем параметре указано name
*Это поле используем как поле для колонки Имя
*Тем самым избавляемся от привязки к названию name(title) и тд.
*Например делая сайт каталисту я столкнулся если есть четкая привязка к name то к туровым датам надо указывать имя какоенибудь
*что не всегда удобно.
*************************************************************************************************************************************/

function editors_get_name_field($field, $editors)
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

/**
*
* 
*
*/
function editors_key_exists($key, $editors)
{
	foreach($editors as $tab)
	{
		if(array_key_exists($key, $tab)) return TRUE;
	}
	return FALSE;
}

/**
*
*
*/

function get_editors_field($editors, $field_name)
{
	foreach($editors as $tab)
	{
		foreach($tab as $title => $field)
		{
			if($title == $field_name) return $field;
		}
	}
	return FALSE;
}

/***************************************************************************************************************
* set_empty_fields()
* заполняет объект пустыми элеметнами с ключами взятыми c editors
* для дальнейшей передачи в view при создании нового элемента
*
* $editors массив полей
*
* return $content - объект заполненый пустыми значениями
***************************************************************************************************************/

function set_empty_fields($editors)
{
	$content = new stdClass();
	foreach ($editors as $tabs)
	{
		foreach ($tabs as $item => $value)
		{
			$content->$item = "";
		}
	}
	return $content;
}

/**************************************************************************************************************
*
*
*
*
**************************************************************************************************************/

function set_disabled_option($branches, $id)
{
	foreach($branches as $key => $branch)
	{
		if($branch->id == $id) 
		{
			$branches[$key]->disabled = TRUE;
			break;
		}
		if($branch->childs) $branch->childs = set_disabled_option($branch->childs, $id);
		
	}
	
	return $branches;
}

/* End of file editiors_helper.php */
/* Location: ./application/helpers/editors_helper.php */