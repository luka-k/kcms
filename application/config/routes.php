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

$route['admin'] = 'admin';
$route['admin/(:any)'] = 'admin/$1';
$route['registration/(:any)'] = 'registration/$1';
$route['shop'] = 'catalog/index';
$route['shop/(:any)'] = 'catalog/index/$1';
$route['shop/(:any)/(:num)'] = 'catalog/index/$1/$2';
$route['product/(:any)'] = 'catalog/product/$1';
$route['catalog/(:any)'] = 'catalog/index/$1';
$route['registration/(:any)'] = 'registration/$1';
$route['cart/(:any)'] = 'cart/$1';
$route['cart/(:any)/(:num)'] = 'cart/$1/$2';
$route['order/(:any)/(:num)'] = 'order/$1/$2';
$route['ajax/(:any)'] = 'ajax/$1';
$route['pages/cart'] = 'pages/cart';
$route['pages/(:any)'] = 'pages/index/$1';
$route['pages/(:any)/(:num)'] = 'pages/index/$1/$2';
$route['(:any)/(:num)'] = 'pages/index/$1/$2';
$route['default_controller'] = "main/index";
$route['404_override'] = '';


/* End of file routes.php */
/* Location: ./application/config/routes.php */