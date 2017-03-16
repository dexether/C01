<?php

use Carbon\Carbon;
class transactionController extends AuthController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('BankAccount');
        $this->load->library('slim');
    }
    public function index()
    {

        $bankAccounts = BankAccount::where('aecodeid' , $this->session->userdata('aecodeid'))->get();
        Carbon::setLocale('id');
        $order = Order::where('aecodeid' , $this->session->userdata('aecodeid'))->orderBy('updated_at' , 'DESC')->get();
        $orders = [];
        foreach($order as $key => $od):
            $carbon =  Carbon::parse($od->created_at);
            $orders[$key] = $od;
            $orders[$key]['human_times'] = $carbon->diffForHumans() . ", Pukul " . $carbon->format('h:i');
            $orders[$key]['amountWithRp'] = $od->amountWithRp;
        endforeach;
        $data['du_menu'] = "du_transaction";
        $data['bankAccounts'] = $bankAccounts;
        $data['orders'] = $orders;
        $data['contentDashboard'] = "transaction/transaction_dashboard_v";
        $this->template->get_user_dashboard($data);
    }
    public function userConfirmation()
    {
        $images = Slim::getImages();
        
        if($images):
            foreach ($images as $image) {
                $file = Slim::saveFile($image['output']['data'], $this->format->url_dash($image['input']['name']), 'assets/images/invoice/');
            }
            $proof = $file['path'];
        else:
            $proof = NULL;
        endif;        
        $order_number = $this->input->post('order_number');
        $payment_date = $this->input->post('payment_date');
        $order_id = Order::where('order_number', $order_number)->first();
        $order_id = ($order_id != null) ? $order_id->id : '1';
        $bank_id = $this->input->post('rekening_number');
        $order = Order::find($order_id);
        $order->cmd = 10;
        $order->proof = $proof;
        $order->save();
        $this->session->set_flashdata('success', 'Berhasil mengkonfirmasi Pembayaran');
        // return redirect('/payment/invoices/' . $order_id);
        return redirect('/payment/invoices/');
    }
}
