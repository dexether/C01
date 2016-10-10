<?php
defined('BASEPATH') or exit('No direct script access allowed');
require('_settings/config.php');
// var_dump($mysql);
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
if ($mall) {
    # code...
    $route['default_controller'] = 'Store';
} else {
    $route['default_controller'] = 'Store/basic';
}

$route['backoffice'] = 'Store/basic';
$route['404_override'] = 'Errorpage/index';
$route['404'] = 'Store/pagenotfound';
$route['translate_uri_dashes'] = false;
$route['c/(:any)'] = 'Store/cat/$1';
$route['c/(:any)/(:any)'] = 'Store/product/$1/$2';
$route['cart'] = 'Buy_sell/showMyCart';
$route['cart/checkout'] = 'Buy_sell/itemCheckout';
$route['cart/add/(:any)/(:num)'] = 'Buy_sell/addProductToChart/$1/$2';
$route['cart/(:any)/checkout'] = 'Buy_sell/userCheckOut/$1';
$route['cart/alter/(:any)'] = 'Buy_sell/deleteProductFromcart/$1';
$route['checkout'] = 'Buy_sell/itemCheckoutPay';
$route['checkout/(:any)/success'] = 'Buy_sell/itemCheckoutSuccess/$1';
$route['about-us'] = 'Store/AboutUs';
$route['terms'] = 'Store/termsAndCondidition';
$route['myproduct'] = 'Buy_sell/myProduct';
$route['myproduct/(:any)'] = 'Buy_sell/myProduct/$1';
$route['product/delete/(:any)'] = 'Buy_sell/deleteProduct/$1';

/* API */
// $route['email/adminapprove/'] = 'api/sendEmailAfterApprove';
$route['email/invoice/(:any)'] = 'api/getEmailInvoice/$1';
$route['api/images'] = 'api/secureGetImage';

/* End of API */

/* Create Product */
$route['product/new'] = 'Buy_sell/sell';
$route['product/edit/(:any)'] = 'Product/editProductByUsers/$1';
$route['product/step/2/(:any)'] = 'Uploader/createProductStepTwo/$1';
$route['product/success/(:any)'] = 'Uploader/successCreatePage/$1';
/* End Create Product */

/* Payment */
$route['payment/transactions'] = 'Buy_sell/userPaymentTransaction';
/* END Payment */

// how to sell
$route['help/how-to-sell'] = 'Store/howToSellProduct';
$route['help/how-to-buy'] = 'Store/howToBuyProduct';
