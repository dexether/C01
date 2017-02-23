<?php
class CheckoutController extends AuthController
{
  public function __construct()
  {
    parent::__construct();
  }
  public function index()
  {
    $data['page'] = "category-page";
    $data['content'] = "checkout/checkout_v";
    $this->template->get_main($data);
  }
}
