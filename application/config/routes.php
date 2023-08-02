<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'home';
$route['404_override'] = 'page/not_found';
$route['translate_uri_dashes'] = FALSE;

//Ion Auth
$route['admin'] = 'admin/auth';
$route['core'] = 'admin/auth';
$route['core/login'] ='admin/auth/login';
$route['core/activate/(:any)'] ='admin/auth/activate/$1';
$route['admin/login'] ='admin/auth/login';
$route['admin/activate/(:any)'] ='admin/auth/activate/$1';
$route['logout'] = 'admin/auth/logout';

// Frontend Section

$route['content/(:any)'] = 'home/content/$1';
$route['article/(:any)'] = 'home/article/$1';
$route['search-result'] = 'home/search_result';

$route['category/(:any)'] = 'home/show_main_category_products/$1';
$route['category/(:any)/(:any)'] = 'home/show_sub_category_products/$1/$2';
$route['product/(:any)'] = 'home/show_product/$1';
$route['show_availability'] = 'home/show_availability';
$route['cart'] = 'home/cart';
$route['show_customer_info'] = 'home/show_customer_info';
$route['add-to-cart'] = 'home/add_to_cart';
$route['thank-you'] = 'home/thank_you';

$route['(:any)'] = 'home/$1';