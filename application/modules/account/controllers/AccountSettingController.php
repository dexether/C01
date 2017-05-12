<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class AccountSettingController extends AuthController
{
  public function __construct()
  {
    parent::__construct();
  }
  public function index()
  {
    redirect('account/address');
  }
}
?>
