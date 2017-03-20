<?php

use Carbon\Carbon;
class transactionSellingController extends AuthController
{
    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        $orders = Product::whereHas('OrderDetails', function($query){
            $query->whereHas('Order', function($query){

            });
        })->get();
        var_dump($orders);
        $data['du_menu'] = "du_transaction";
        $data['contentDashboard'] = "transaction/transaction_selling_v";
        $this->template->get_user_dashboard($data);
    }
}