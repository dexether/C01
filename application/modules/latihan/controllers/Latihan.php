<?php
use Carbon\Carbon;
class Latihan extends MY_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->module('mod_ecommerce_invoice/email');
  }
  public function index()
  {
      $this->template->get_user_dashboard();
  }
}
