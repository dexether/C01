<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Illuminate\Database\Eloquent\Model as Eloquent;
class Wishlist extends Eloquent
{
    protected $primaryKey = "id";
    protected $table = 'wishlists';
    protected $guard = ['id'];
    protected $fillable = ['product_id', 'aecodeid'];


    public function product()
    {
      return $this->belongsTo('Product', 'product_id');
    }
}
