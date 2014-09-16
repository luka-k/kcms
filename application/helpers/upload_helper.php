<? if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function scan_dir($dirname)  
{   
    $count_files = 0; 
    // Открываем текущую директорию  
    $dir = opendir($dirname);  
    // Читаем в цикле директорию  
    while (($file = readdir($dir)) !== false)  
    {  
      // Если файл обрабатываем его содержимое  
      if($file != "." && $file != "..")  
      {  
        // Если имеем дело с файлом - производим в нём замену  
        if(is_file($dirname."/".$file))  
        {  
         $count_files++;  
        }   
      }  
    }  
    // Закрываем директорию  
    closedir($dir); 
	return $count_files;
} 
 
function make_upload_path($file_name, $path = FALSE)
{
	//Преобразуем имя файла в массив каждый элемент которого содержит один символ имени.
	$upload_path = $path;
	$updir_name = str_split($file_name);
	
	if (!file_exists($upload_path) and $upload_path <> FALSE)
	{
		mkdir($upload_path, 0755);
	}
	
	for($i=0; $i<2; $i++)
	{
		if (!file_exists($upload_path."/".$updir_name[$i]))
		{
			$upload_path = $upload_path. "/" .$updir_name[$i];
			if($path <> FALSE)
			{
				mkdir($upload_path, 0755);
			}
		} 
		else 
		{
			$upload_path = $upload_path. "/" .$updir_name[$i];
		}
	}
	$upload_path = $upload_path."/";
	return $upload_path;	
}

/* End of file upload_helper.php */
/* Location: ./application/helpers/upload_helper.php */