<?php defined('BASEPATH') OR exit('No direct script access allowed');
class AccountDashboardController extends AuthController
{
  public function __construct()
  {
    parent::__construct();
  }
  public function index()
  {
    $data['contentDashboard'] = 'account/DetailAccount';
    $this->template->get_user_dashboard($data);
  }
}
