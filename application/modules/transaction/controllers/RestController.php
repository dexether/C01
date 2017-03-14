<?php
use Carbon\Carbon;
class RestController extends AuthController
{
    public function index()
    {
        // setlocale(LC_ALL, 'id-ID');
        Carbon::setLocale('id');
        $order = Order::where('aecodeid' , $this->session->userdata('aecodeid'))->get();
        foreach($order as $key => $od):
            $carbon =  Carbon::parse($od->created_at);
            $orders[$key] = $od;
            $orders[$key]['human_times'] = $carbon->diffForHumans() . ", Pukul " . $carbon->format('h:i');
            $orders[$key]['amountWithRp'] = $od->amountWithRp;
        endforeach;
        return $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($orders , JSON_PRETTY_PRINT));
    }
}