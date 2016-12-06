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
$route['404_override'] = '';

$route['terms_conditions'] = "index/terms_conditions";
$route['training'] = "index/training";
$route['datasheets'] = "index/datasheets";
$route['about_us'] = "index/about_us";

$route['products_sub/(:any)'] = "products/sub/$1";
$route['products_detail/(:any)'] = "products/detail/$1";

$route['request_catalogue'] = "catalogue/send_request";
$route['catalogue_download/(:any)'] = "catalogue/download/$1";
$route['catalogue_download_error/(:any)'] = "catalogue/download_error/$1";
$route['generate_catalogue'] = "catalogue/generate_pdf";
$route['download_catalogue/(:any)'] = "catalogue/download_pdf/$1";

$route['request_contact'] = "contact_us/send_contact_us";

/* End of file routes.php */
/* Location: ./application/config/routes.php */