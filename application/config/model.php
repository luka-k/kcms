<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['autoload'] = array(
	'db/products_model', 
	'db/categories_model', 
	'db/articles_model',
	'db/settings_model', 
	'db/users_model', 
	'db/users_groups_model',
	'db/users2users_groups_model',
	'db/orders_model', 
	'db/orders_products_model', 
	'db/images_model', 
	'db/emails_model', 
	'db/mailouts_model',
	'db/dynamic_menus_model',
	'db/menus_items_model',
	'db/characteristics_model',
	'db/characteristics_type_model'
);