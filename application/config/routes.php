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
$route['ptqe-2022-sample-papers']='home/ptqe/ptqe-sample-papers';
$route['ptqe-2024']='home/ptqe/ptqe2024';
$route['how-to-register-for-ptqe-2023']='home/ptqe/how-register-ptqe-2023';
$route['ptqe'] = "home/ptqe/register-for-ptqe-2023";
$route['ptqe23result'] = "home/ptqe/ptqe23-result";
$route['ptqe-success'] = "home/ptqe/ptqe-success";

$route['psat-2022-sample-papers']='home/psat/ptqe-sample-papers';
$route['about-psat-2023']='home/psat/about-psat-2022';
$route['how-to-register-for-psat-2022']='home/psat/how-register-psat-2022';
$route['psat2023/register'] = "home/psat/register-for-psat-2022";

$route['our-vision']='home/about/vision';
$route['aims-and-responsibility']='home/about/aimsandres';
$route['our-faculty']='home/about/faculty';
$route['why-pinnacle']='home/about/whypinnacle';
$route['testimonials']='home/about/testimonials';
$route['result-of-seniors']='home/resultsec/resultss';
$route['result-of-juniors']='home/resultsec/resultsj';

$route['admission-process']='home/admission/process';
$route['admission-sample-papers']='home/admission/samplepapers';
$route['admission-register']='home/admission/register';
$route['frequently-asked-questions']='home/pages/faqs';
$route['contact-us']='home/pages/contact';
$route['privacy-policy']='home/pages/privacypolicy';
$route['refund-and-cancellation']='home/pages/refundandcancellation';
$route['terms-and-conditions'] = 'home/pages/termsandcondition';

$route["ntse"]='home/ntse/ntse_register';
$route["ntse/about"] = "home/ntse/ntse_about";

$route['default_controller'] = 'home';
//$route['404_override'] = 'home/index';
$route['translate_uri_dashes'] = FALSE;
