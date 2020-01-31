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
$route['default_controller'] = 'Main/board';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['login'] = "Main/login";
$route['fb-login'] = "Main/fb_login";
// $route['fb-callback'] = "Process/fb_callback";
$route['register'] = "Main/register";
$route['info'] = "Main/info";
$route['write'] = "Main/write";
$route['edit/(:num)'] = "Main/edit/$1";
$route['post/(:num)'] = "Main/post/$1";

$route['/process/login'] = "Process/login";
// $route['/process/social/login'] = "Process/fblogin";
$route['/process/logout'] = "Process/logout";
$route['/process/register'] = "Process/register";
$route['/process/withdrawal'] = "Process/withdrawal";
$route['/process/write'] = "Process/write";
$route['/process/edit'] = "Process/edit";
$route['/process/delete/(:num)'] = "Process/delete/$1";
$route['/process/comment_write'] = "Process/comment_write";

