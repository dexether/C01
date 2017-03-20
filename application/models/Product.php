<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Illuminate\Database\Eloquent\Model as Eloquent;
use Carbon\Carbon;
class Product extends Eloquent
{
    protected $table = 'master_product';

    public function OrderDetails()
    {
      return $this->hasMany('OrderDetails' , 'orders_id');
    }
}