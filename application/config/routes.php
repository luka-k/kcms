<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['404_override'] = 'pages/page_404';

$route['admin/(:any)'] = "admin/$1";
$route['admin/(:any)/(:any)'] = "admin/$1/$2";

$url = $_SERVER['HTTP_HOST'];
$host = explode('.', $url);

if($host[0] == "shop")
{
	$route['default_controller'] = "shop/catalog";
	
	$route['catalog/count'] = 'shop/catalog/count';
	$route['catalog/ajax_more'] = 'shop/catalog/ajax_more';
	$route['catalog/filter/(:any)'] = 'shop/catalog/filter/$1';
	$route['catalog'] = 'shop/catalog/index';
	$route['catalog/(:any)'] = 'shop/catalog/index/$1';
	$route['catalog/(:any)/(:num)'] = 'shop/catalog/index/$1/$2';
}
else
{
	$route['default_controller'] = "index";
	
	$route['catalog'] = 'catalog/catalog/index';
	$route['catalog/(:any)'] = 'catalog/catalog/index/$1';
	$route['catalog/(:any)/(:num)'] = 'catalog/catalog/index/$1/$2';
}

$route['cart'] = 'shop/cart/index';

$route['manufacturer/(:any)'] = 'catalog/manufacturer/index/$1';

$route['getdoc/(:any)'] = 'getdoc/index/$1';

$route['bb'] = 'catalog/brightbild/index';

$route['inventory'] = 'catalog/inventory/index';
$route['inventory/(:any)'] = 'catalog/inventory/index/$1';

$route['vendors'] = 'catalog/prodavcy/index';
$route['vendors/(:any)'] = 'catalog/vendors/index/$1';
$route['vendors/(:any)/(:num)'] = 'catalog/vendors/index/$1/$2';

$route['vendor/(:any)'] = 'catalog/prodavcy/vendor/$1';

$route['prodavcy'] = 'catalog/prodavcy/index';
$route['prodavcy/(:any)'] = 'catalog/prodavcy/index/$1';
$route['prodavcy/(:any)/(:num)'] = 'catalog/prodavcy/index/$1/$2';

$route['contractors'] = 'catalog/podrjadchiki/index';
$route['contractors/(:any)'] = 'catalog/podrjadchiki/index/$1';
$route['contractors/(:any)/(:num)'] = 'catalog/podrjadchiki/index/$1/$2';

$route['contractor/(:any)'] = 'catalog/podrjadchiki/contractor/$1';

$route['podrjadchiki'] = 'catalog/podrjadchiki/index';
$route['podrjadchiki/(:any)'] = 'catalog/podrjadchiki/index/$1';
$route['podrjadchiki/(:any)/(:num)'] = 'catalog/podrjadchiki/index/$1/$2';

$route['cabinet'] = 'shop/cabinet';

$route['order/(:any)/(:num)'] = 'shop/order/$1/$2';

$route['articles'] = 'pages/index';
$route['articles/(:any)'] = 'pages/index/$1';
$route['articles/(:any)/(:num)'] = 'pages/index/$1/$2';

$route['search'] = 'search';

$route['registration/(:any)'] = 'registration/$1';
$route['sitemap.xml'] = 'sitemap/index/xml';

/* End of file routes.php */
/* Location: ./application/config/routes.php */