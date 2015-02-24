<? if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*************************************************************************************************************************************
*При помощи функции editors_field_exists находим поле у которого в третьем параметре указано name
*Это поле используем как поле для колонки Имя
*Тем самым избавляемся от привязки к названию name(title) и тд.
*Например делая сайт каталисту я столкнулся если есть четкая привязка к name то к туровым датам надо указывать имя какоенибудь
*что не всегда удобно.
*************************************************************************************************************************************/

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

/* End of file editiors_helper.php */
/* Location: ./application/helpers/editors_helper.php */