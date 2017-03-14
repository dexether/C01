<?php
class PaymentController extends AuthController
{
  public function __construct()
  {
    parent::__construct();
    $this->load->library('cart');
  }
  public function index()
  {
    $invoice_id = $this->input->get('invoice_id');
    $payments = Order::where('order_number', $invoice_id)->first();
    $data['payments'] = $payments;
    $data['page'] = "category-page";
    $data['content'] = 'payment/choose_payment_v';
    $this->template->get_main($data);
  }
  public function confirmation($order_number)
  {
    $order = Order::where('order_number', $order_number)->first();
    $this->cart->destroy();
    if($order == null)
            show_404();
    $data['order'] = $order;
    $data['page'] = "category-page";
    $data['content'] = 'payment/confirmation_payment_v';
    $this->template->get_main($data);
  }
}
?>
