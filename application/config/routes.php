<?php
defined('BASEPATH') or exit('No direct script access allowed');
require '_settings/config.php';
if ($mall) {
    # code...
    $route['default_controller'] = 'home';
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
$route['c/(:any)/(:any)'] = 'mod_ecommerce_product/View_product/show_product/$1/$2';
// $route['cart'] = 'Buy_sell/showMyCart';
$route['cart'] = 'cart/cart_view';

// $route['cart/add/(:any)/(:num)'] = 'Buy_sell/addProductToChart/$1/$2';
$route['cart/add/(:any)/(:num)'] = 'mod_ecommerce_cart/item_add/$1/$2';

// $route['cart/alter/(:any)'] = 'Buy_sell/deleteProductFromcart/$1';
$route['cart/alter/(:any)'] = 'mod_ecommerce_cart/item_delete/$1';

// $route['cart/checkout'] = 'Buy_sell/itemCheckout';
$route['cart/checkout'] = 'mod_ecommerce_cart/item_checkout';

// $route['cart/(:any)/checkout'] = 'Buy_sell/userCheckOut/$1';
$route['cart/(:any)/checkout'] = 'mod_ecommerce_cart/item_checkout_confirmation/$1';

// $route['checkout'] = 'Buy_sell/itemCheckoutPay';
$route['checkout'] = 'checkout/CheckoutController/index';
$route['checkout/payment'] = 'checkout/CheckoutController/postCheckout';


// $route['about-us'] = 'Store/AboutUs';
$route['about-us'] = 'mod_ecommerce_page/about_us';

// $route['terms'] = 'Store/termsAndCondidition';terms
$route['terms'] = 'mod_ecommerce_page/terms';

// how to sell
$route['help/how-to-sell'] = 'mod_ecommerce_page/how_to_sell_product';
$route['help/how-to-buy'] = 'mod_ecommerce_page/how_to_buy_product';

// $route['email/adminapprove/'] = 'api/sendEmailAfterApprove';
$route['email/invoice/(:any)'] = 'mod_ecommerce_invoice/email/get_email_invoice/$1';
$route['api/images'] = 'transaction/RestController/getImages';
$route['api/sendEmailAfterReject/(:any)'] = 'transaction/RestController/sendEmailAfterReject/$1';

/* End of API */
$route['myproduct'] = 'mod_ecommerce_product/list_product';
$route['myproduct/(:any)'] = 'mod_ecommerce_product/list_product/$1';

$route['product/delete/(:any)'] = 'mod_ecommerce_product/product_edit/deleteProduct/$1';
/* Create Product */
$route['product/new'] = 'mod_ecommerce_product/sell_product';
$route['product/upload'] = 'mod_ecommerce_product/mod_ecommerce_product_upload/secureSaveUploadedImages';
$route['product/success/(:any)'] = 'mod_ecommerce_product/product_add_success/$1';
$route['product/edit/(:any)'] = 'mod_ecommerce_product/product_edit/editProductByUsers/$1';
$route['product/step/2/(:any)'] = 'Uploader/createProductStepTwo/$1';

/* End Create Product */

/* Payment */
$route['payment/transactions'] = 'mod_ecommerce_payment/userPaymentTransaction';
/* END Payment */



// user
$route['user/settings'] = 'mod_ecommerce_users/settings';
// endogf user
/* Authentication */
$route['auth']['get'] = 'mod_authentication/index';
$route['auth']['post'] = 'mod_authentication/login';
$route['auth/signup']['post'] = 'mod_authentication/signup';
$route['auth/logout']['get'] = 'mod_authentication/logout';
$route['auth/activation']['get'] = 'mod_authentication/activation_user';
$route['auth/activation/resend']['get'] = 'mod_authentication/activation_resend';
$route['auth/activation/resend']['post'] = 'mod_authentication/activation_resend_post';

$route['address/new/(:num)'] = 'checkout/CheckoutController/postAddress/$1';

/* == VueJS API == */
$route['address/api/list/(:num)'] = 'address/AddressController/apiGetAddress/$1';
$route['ongkir/post/api/(:num)'] = "Mod_ecommerce_ongkir/getPostApi/$1";
$route['ongkir/api/(:num)/(:num)/(:any)'] = "Mod_ecommerce_ongkir/getOngkos/$1/$2/$3";

// User Dashboard
/** Payemetn **/
$route['payment/purchases/new'] = "payment/PaymentController/index";
$route['payment/purchases/(:any)/confirmation'] = "payment/PaymentController/confirmation/$1";
$route['payment/invoices'] = 'transaction/transactionController/index';
$route['account/bankaccount'] = 'account/AccountBankController/index';
$route['account/bankaccount/new']['get'] = 'account/AccountBankController/createView';
$route['account/bankaccount/new']['post'] = 'account/AccountBankController/createPost';
$route['account/setting'] = 'account/AccountSettingController/index';
$route['payment/invoices/userconfirmation']['post'] = 'transaction/transactionController/userConfirmation';
$route['api/transaction'] = 'transaction/RestController/index';
