<? if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function my_dump($dump)
{
	if(ENVIRONMENT == "development") var_dump($dump);
}