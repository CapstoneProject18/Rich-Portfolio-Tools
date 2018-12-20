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
$route['default_controller'] = 'Home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//Frontend
$route['company/(:any)'] = 'Company/index/$1';
$route['jobs/(:any)'] = 'Job_details/index/$1';
$route['job_listing/(:any)'] = 'Job_listing/index/$1';
$route['(:any).html'] = 'Content/index/$1';
$route['login'] = 'User/login/$1';
$route['logout'] = 'User/logout/$1';
$route['forgot'] = 'User/forgot/$1';
$route['search-jobs'] = 'Job_search/index/$1';
$route['search-jobs/(:any)'] = 'Job_search/index/$1';
$route['search-jobs/(:any)/(:any)'] = 'Job_search/index/$1/$2';
$route['search-resume'] = 'Resume_search/index/$1';
$route['search-resume/(:any)'] = 'Resume_search/index/$1';
$route['search/(:any)'] = 'Search/index/$1';
$route['candidate/(:any)'] = 'Candidate/index/$1';
$route['industry/(:any)'] = 'Industry/index/$1';
$route['employer-signup'] = 'Employer_signup';
$route['jobseeker-signup'] = 'Jobseeker_signup';
$route['contact-us'] = 'Contact_us';
//Employer Section
$route['employer/job_applications/send_message_to_candidate'] 	= 'Employer/job_applications/send_message_to_candidate/$1';
$route['employer/job_applications/(:any)'] 	= 'Employer/job_applications/index/$1';
$route['employer/my_posted_jobs/(:any)'] 	= 'Employer/my_posted_jobs/index/$1';
$route['employer/edit_posted_job/(:num)'] 	= 'Employer/edit_posted_job/index/$1';
//Backend
$route['admin/employers/(:num)'] 	= 'admin/Employers/index/$1';
$route['admin/job_seekers/(:num)'] = 'admin/Job_seekers/index/$1';
$route['admin/posted_jobs/(:num)'] = 'admin/Posted_jobs/index/$1';

$route['admin/menu/load_menu_pages/(:num)'] = 'admin/Menu/load_menu_pages/$1';
