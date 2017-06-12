<?php
use Carbon\Carbon;
class RestController extends MY_Controller
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
    public function getImages()
    {
        $image = base64_decode($this->input->get('callback'));
        $imageExt = pathinfo($image);
        header('Content-Type:image/jpg');
        readfile($image);
    }
    public function sendEmailAfterReject($invoice){

        $this->load->view('api/sendemailafterreject', array("invoice" => $invoice));
    }
}