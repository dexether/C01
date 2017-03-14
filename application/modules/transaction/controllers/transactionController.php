<?php

use Carbon\Carbon;
class transactionController extends AuthController
{
    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        Carbon::setLocale('id');
        $order = Order::where('aecodeid' , $this->session->userdata('aecodeid'))->orderBy('updated_at' , 'DESC')->get();
        foreach($order as $key => $od):
            $carbon =  Carbon::parse($od->created_at);
            $orders[$key] = $od;
            $orders[$key]['human_times'] = $carbon->diffForHumans() . ", Pukul " . $carbon->format('h:i');
            $orders[$key]['amountWithRp'] = $od->amountWithRp;
        endforeach;
        $data['orders'] = $orders;
        $data['contentDashboard'] = "transaction/transaction_dashboard_v";
        $this->template->get_user_dashboard($data);
    }
}