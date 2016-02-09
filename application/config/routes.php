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

$route['default_controller'] = "login/index";

$route['admin'] = 'login/index';
$route['logout'] = 'admin/logout';
$route['admin/dashboard'] = 'admin/index';

$route['admin/programmering'] = 'programmering';
$route['admin/programmering/(:num)/episode/(:any)'] = 'programmering/episode/$1/$2';
$route['admin/programmering/(:any)'] = 'programmering/$1';

$route['admin/teksttv'] = 'teksttv/index';
$route['admin/teksttv/(:any)'] = 'teksttv/$1';

$route['admin/templates'] = 'teksttv/templates';
$route['admin/templates/(:any)'] = 'teksttv/templates_$1';

$route['admin/music'] = 'music/index';
$route['admin/music/(:any)'] = 'music/$1';

$route['admin/sources'] = 'sources/index';
$route['admin/sources/(:any)'] = 'sources/$1';

$route['admin/ads'] = 'ads/index';
$route['admin/ads/(:any)'] = 'ads/$1';

$route['admin/scheduling'] = 'scheduling/index';
$route['admin/scheduling/(:any)'] = 'scheduling/$1';

$route['admin/programmes'] = 'programmes/index';
$route['admin/programmes/(:any)'] = 'programmes/$1';

$route['api/videos'] = 'api/videos';

$route['404_override'] = '';


/* End of file routes.php */
/* Location: ./application/config/routes.php */