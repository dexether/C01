<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Illuminate\Database\Eloquent\Model as Eloquent;
use Carbon\Carbon;
class Product extends Eloquent
{
    protected $table = 'master_product';
    protected $fillable = [
      'id_cat', 'aecodeid' , 'prod_alias', 'prod_name' , 'prod_desc_long','prod_price' , 'prod_weight'
    ];
     protected $guarded = ['id'];
    public function OrderDetails()
    {
      return $this->hasMany('OrderDetails' , 'orders_id');
    }
    public function ProductImages()
    {
      return $this->hasMany('ProductImages' , 'id_prod');
    }
}