<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
|	https://codeigniter.com/userguide3/general/routing.html
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
$route['default_controller'] = 'welcome';
$route['404_override'] = '';


$route['works'] = 'WorkController';
$route['works/datatable'] = 'WorkController/datatable';
$route['works/create'] = 'WorkController/create';
$route['works/store'] = 'WorkController/store';
$route['works/edit/(:num)'] = 'WorkController/edit/$1';
$route['works/update/(:num)'] = 'WorkController/update/$1';
$route['works/delete/(:num)'] = 'WorkController/delete/$1';
$route['works/deletes'] = 'WorkController/deletes';

$route['works/exports'] = 'Exports/ExcelController/export_excel_works';
$route['works/imports'] = 'Imports/ExcelController/import_excel_works';


$route['users'] = 'UserController';
$route['users/create'] = 'UserController/create';
$route['users/store'] = 'UserController/store';
$route['users/edit/(:num)'] = 'UserController/edit/$1';
$route['users/update/(:num)'] = 'UserController/update/$1';
$route['users/delete/(:num)'] = 'UserController/delete/$1';


$route['login'] = 'LoginController/login';
$route['postlogin'] = 'LoginController/postLogin';



$route['api/works'] = 'Api/CrudWorkController';
$route['api/works/create'] = 'Api/CrudWorkController/create';
$route['api/works/show/(:num)'] = 'Api/CrudWorkController/show/$1';
$route['api/works/update/(:num)'] = 'Api/CrudWorkController/update/$1';
$route['api/works/delete/(:num)'] = 'Api/CrudWorkController/delete/$1';


$route['translate_uri_dashes'] = FALSE;
