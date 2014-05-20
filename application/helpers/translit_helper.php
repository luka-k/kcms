<? if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//Функция очишения от лишних символов
function clean_symbol($to_clean)
{
	//Замена пробелов на нижнее подчеркивание
    $to_clean = str_replace(' ', '-', $to_clean);
	//Замена -- на -
    $to_clean = str_replace('--', '-', $to_clean);
	//Замена & на -and-
    $to_clean = str_replace('&', '-and-', $to_clean);
	//Очишение строки от всего кроме слов (\w) цифр (\d) и _ - и точки
    $to_clean = trim(preg_replace('/[^\w\d_ -.]/si', '', $to_clean));
    return $to_clean;
}
	
function translit($str)
{
	//Делаем замену кирилистичесикх символов на латинсикие
    $str = strtr(iconv("UTF-8", "windows-1251//IGNORE", $str), 
        iconv("UTF-8", "windows-1251", "абвгдежзийклмнопрстуфыэАБВГДЕЖЗИЙКЛМНОПРСТУФЫЭ"),
                  "abvgdegziyklmnoprstufieabvgdegziyklmnoprstufie"
        );
	//Делаем замену оставшихся кирилистичесикх символов на латинсикие	
    $str = strtr($str, array(
            iconv("UTF-8", "windows-1251//IGNORE", 'ё')=>"jo",    
            iconv("UTF-8", "windows-1251//IGNORE", 'х')=>"h",  
            iconv("UTF-8", "windows-1251//IGNORE", 'ц')=>"c",  
            iconv("UTF-8", "windows-1251//IGNORE", 'ч')=>"ch", 
            iconv("UTF-8", "windows-1251//IGNORE", 'ш')=>"sh",  
            iconv("UTF-8", "windows-1251//IGNORE", 'щ')=>"shh",  
            iconv("UTF-8", "windows-1251//IGNORE", 'ъ')=>'#',   
            iconv("UTF-8", "windows-1251//IGNORE", 'ь')=>'',    
            iconv("UTF-8", "windows-1251//IGNORE", 'ю')=>"ju", 
            iconv("UTF-8", "windows-1251//IGNORE", 'я')=>"ja",
            iconv("UTF-8", "windows-1251//IGNORE", 'Ё')=>"jo",    
            iconv("UTF-8", "windows-1251//IGNORE", 'Х')=>"h",  
            iconv("UTF-8", "windows-1251//IGNORE", 'Ц')=>"c",  
            iconv("UTF-8", "windows-1251//IGNORE", 'Ч')=>"ch", 
            iconv("UTF-8", "windows-1251//IGNORE", 'Ш')=>"sh",
            iconv("UTF-8", "windows-1251//IGNORE", 'Щ')=>"shh",  
            iconv("UTF-8", "windows-1251//IGNORE", 'Ъ')=>'#',   
            iconv("UTF-8", "windows-1251//IGNORE", 'Ь')=>'',    
            iconv("UTF-8", "windows-1251//IGNORE", 'Ю')=>"ju", 
            iconv("UTF-8", "windows-1251//IGNORE", 'Я')=>"ja"
        ));
	//Приводим все символы к нижнему регистру.
    $str = strtolower($str);
	//Возвращаем строку
    return $str;
}
	
function translit_url($url_str)
{
	//Очишаем строку от точки
	$url_str = preg_replace('/[^\w\d_ -]/si', '', clean_symbol(translit($url_str)));
	//Возвращаем строку
	return $url_str;
}
	
/* End of file translit_helper.php */
/* Location: ./application/helpers/translit_helper.php */