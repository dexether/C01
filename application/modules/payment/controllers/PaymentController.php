<?php
class PaymentController extends AuthController
{
  public function __construct()
  {
    parent::__construct();
  }
  public function index()
  {
    $invoice_id = $this->input->get('invoice_id');
    $payments = Order::where('order_number', $invoice_id)->firstOrFail();
    var_dump($payments);
    $data['payments'] = $payments;
    $data['page'] = "category-page";
    $data['content'] = 'payment/choose_payment_v';
    $this->template->get_main($data);
  }
  public function new_payment()
  {

  }
}
?>
