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

$route['default_controller'] = "login";
$route['404_override'] = 'error_404';

/*********** GENERAL DEFINED ROUTES *******************/

$route['profile'] 				= "dashboard/profile";
$route['profile/(:any)'] 		= "dashboard/profile/$1";
$route['updateprofile'] 		= "dashboard/profileUpdate";
$route['updateprofile/(:any)'] 	= "dashboard/profileUpdate/$1";

$route['loadChangePass'] 		= "dashboard/loadChangePass";
$route['changePassword'] 		= "dashboard/changePassword";
$route['changePassword/(:any)'] = "dashboard/changePassword/$1";
$route['pageNotFound'] 			= "dashboard/pageNotFound";


/*********** USER DEFINED ROUTES *******************/

$route['loginMe'] = 'login/loginMe';
$route['dashboard'] = 'dashboard';
$route['logout'] = 'dashboard/logout';

$route['userlist'] = 'user/userListing';
$route['userlist/(:num)'] = "user/userListing/$1";
$route['adduser'] = "user/addUser";
$route['savenewuser'] = "user/SaveNewUser";
$route['editolduser'] = "user/editOld";
$route['editolduser/(:num)'] = "user/editOld/$1";
$route['edituser'] = "user/editUser";
$route['deleteUser'] = "user/deleteUser";

$route['checkEmailExists'] = "user/checkEmailExists";
$route['loginhistory'] = "user/loginHistoy";
$route['loginhistory/(:num)'] = "user/loginHistoy/$1";
$route['loginhistory/(:num)/(:num)'] = "user/loginHistoy/$1/$2";

/*********** CUSTOMER DEFINED ROUTES *******************/

$route['customerlist'] = 'customer/customerListing';
$route['customerlist/(:num)'] = "customer/customerListing/$1";
$route['addcustomer'] = "customer/addCustomer";
$route['savenewcustomer'] = "customer/SaveNewCustomer";
$route['editoldcustomer'] = "customer/editOld";
$route['editoldcustomer/(:num)'] = "customer/editOld/$1";
$route['editcustomer'] = "customer/editCustomer";
$route['deleteCustomer'] = "customer/deleteCustomer";

/*********** SERVICES DEFINED ROUTES *******************/

$route['servicelist'] = 'service/serviceListing';
$route['servicelist/(:num)'] = "service/serviceListing/$1";
$route['addservice'] = "service/addService";
$route['savenewservice'] = "service/SaveNewService";
$route['editoldservice'] = "service/editOld";
$route['editoldservice/(:num)'] = "service/editOld/$1";
$route['editservice'] = "service/editService";
$route['deleteService'] = "service/deleteService";

/*********** STAGES DEFINED ROUTES *******************/

$route['stagelist'] = 'stage/stageListing';
$route['stagelist/(:num)'] = "stage/stageListing/$1";
$route['addstage'] = "stage/addStage";
$route['savenewstage'] = "stage/SaveNewStage";
$route['editoldstage'] = "stage/editOld";
$route['editoldstage/(:num)'] = "stage/editOld/$1";
$route['editstage'] = "stage/editStage";
$route['deleteStage'] = "stage/deleteStage";

/*********** TRANSACTION DEFINED ROUTES *******************/

$route['orderlist'] = 'order/orderListing';
$route['orderlist/(:num)'] = "order/orderListing/$1";
$route['addorder'] = "order/addOrder";
$route['saveneworder'] = "order/SaveNewOrder";
$route['editoldorder'] = "order/editOld";
$route['editoldorder/(:num)'] = "order/editOld/$1";
$route['editorder'] = "order/editOrder";
$route['deleteOrder'] = "order/deleteOrder";

/*********** FINISHED ORDER DEFINED ROUTES *******************/

$route['finishedorderlist'] = 'order/finishedorderListing';
$route['finishedorderlist/(:num)'] = "order/finishedorderListing/$1";

/* End of file routes.php */
/* Location: ./application/config/routes.php */
