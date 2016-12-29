<?php
class Home extends MY_Controller
{
  public function __construct()
  {
    parent::__construct();
  }
  public function index()
  {
    $data['content'] = 'home/home_v';
    $this->template->get_main($data);
  }
}
?>
