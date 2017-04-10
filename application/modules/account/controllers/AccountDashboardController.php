<?php defined('BASEPATH') OR exit('No direct script access allowed');
use Illuminate\Support\Facades\DB;
class AccountDashboardController extends AuthController
{
  public function __construct()
  {
    parent::__construct();
  }
  public function index()
  {
    $data['userProductActive'] = Product::getUserProduct($this->session->aecodeid)->where('is_active', true)->count();
    $data['userProductNotActive'] = Product::getUserProduct($this->session->aecodeid)->where('is_active', false)->count();
    $data['invoiceNotPay'] = Order::getInvoice($this->session->aecodeid);
    $data['allInvoice'] = Order::getInvoice($this->session->aecodeid, true);
    $data['productSelling'] = Product::productSelling($this->session->aecodeid);
    $clientAddress = Address::where('aecodeid', $this->session->aecodeid)->orderBy('is_primary')->take(1)->first();
    $data['clientAddress'] = $clientAddress;
    $data['contentDashboard'] = 'account/DetailAccount';
    $this->template->get_user_dashboard($data);
  }
}
