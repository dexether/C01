<?php
defined('BASEPATH') or exit('No direct script access allowed');
require('_settings/config.php');
if ($mall) {
    # code...
    $route['default_controller'] = 'dashboard';
} else {
    $route['default_controller'] = 'Store/basic';
}
// $route['latihan'] = 'Store/termsAndCondidition';
$route['backoffice'] = 'Store/basic';
$route['404_override'] = 'Errorpage/index';
$route['404'] = 'Store/pagenotfound';
$route['translate_uri_dashes'] = false;
// $route['c/(:any)'] = 'Store/cat/$1';
$route['c/(:any)'] = 'mod_ecommerce_category/show_product/$1';
// $route['c/(:any)/(:any)'] = 'Store/product/$1/$2';
$route['c/(:any)/(:any)'] = 'mod_ecommerce_product/show_product/$1/$2';
// $route['cart'] = 'Buy_sell/showMyCart';
$route['cart'] = 'mod_ecommerce_cart/show_cart';
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


// user
$route['user/settings'] = 'Pengguna/settings';
// endogf user
