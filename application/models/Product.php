<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class Product extends Eloquent
{
    protected $guarded = ['id'];
    protected $table = 'master_product';
    protected $fillable = [
      'id_cat', 'aecodeid' , 'prod_alias', 'prod_name' , 'prod_desc_long','prod_price' , 'prod_weight'
    ];
    public function OrderDetails()
    {
      return $this->hasMany('OrderDetails' , 'prod_id');
    }
    public function ProductImages()
    {
      return $this->hasMany('ProductImages' , 'id_prod');
    }


    public static function productSelling($aecodeid)
    {
      $data = [];
       $query = self::select('*')
       ->where('aecodeid', $aecodeid)
       ->get();
       foreach($query as $key => $row):
         $data[] = $row->OrderDetails->count();
       endforeach;
       return array_sum($data);
    }
    public static function getUserProduct($aecodeid)
    {
      return $query = self::where('aecodeid', $aecodeid);
    }

    public function category()
    {
      return $this->belongsTo('Category', 'id_cat');
    }
    public function review()
    {
      return $this->hasMany('App\Models\Review', 'prod_id');
    }
}
