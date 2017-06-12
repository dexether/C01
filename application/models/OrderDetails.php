<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Illuminate\Database\Eloquent\Model as Eloquent;
class OrderDetails extends Eloquent
{
    protected $table = 'orderDetails';

    public function Order()
    {
        return $this->belongsTo('Order', 'orders_id');
    }
}
