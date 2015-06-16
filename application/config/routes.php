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
$route['default_controller'] = "index";
$route['404_override'] = 'pages/page_404';

$route['admin/(:any)'] = "admin/$1";
$route['admin/(:any)/(:any)'] = "admin/$1/$2";

/**
* Магазин
*/
$route['shop/catalog/count'] = 'shop/catalog/count';
$route['shop/catalog/ajax_more'] = 'shop/catalog/ajax_more';
$route['shop/catalog/filter/(:any)'] = 'shop/catalog/filter/$1';
$route['shop/catalog'] = 'shop/catalog/index';
$route['shop/catalog/(:any)'] = 'shop/catalog/index/$1';
$route['shop/catalog/(:any)/(:num)'] = 'shop/catalog/index/$1/$2';

/**
* Каталог
*/

$route['catalog'] = 'catalog/catalog/index';
$route['catalog/(:any)'] = 'catalog/catalog/index/$1';
$route['catalog/(:any)/(:num)'] = 'catalog/catalog/index/$1/$2';

$route['manufacturer/(:any)'] = 'catalog/manufacturer/index/$1';

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