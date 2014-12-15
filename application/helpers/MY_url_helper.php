<? if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function get_filter_string($query_string)
{
	parse_str($query_string, $filter);
	unset($filter['order']);
	unset($filter['direction']);
	$query_string = http_build_query($filter);

	return $query_string;
}