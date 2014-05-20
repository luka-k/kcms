<? if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function end_maker($word, $counter)
{
	if ($word == 'day')
	{
		$form_1 = 'день';
		$form_2 = 'дней';
		$form_3 = 'дня';
		$counter = $counter % 100;
		if ($counter >= 20)
			$counter = $counter % 10;
		if ($counter > 4 | $counter == 0)
			return $form_2;
		if ($counter > 1 && $counter < 5)
			return $form_3;
		return $form_1;  
	} 
	else 
	{
		$form_1 = 'товар';
		$form_2 = 'товаров';
		$form_3 = 'товара';
		$counter = $counter % 100;
		if ($counter >= 20)
			$counter = $counter % 10;
		if ($counter > 4 | $counter == 0)
			return $form_2;
		if ($counter > 1 && $counter < 5)
			return $form_3;
		return $form_1;
	}    
}

/* End of file end_helper.php */
/* Location: ./application/helpers/end_helper.php */