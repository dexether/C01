<?php
namespace App\Models;

defined('BASEPATH') OR exit('No direct script access allowed');

use Illuminate\Database\Eloquent\Model as Eloquent;

class Review extends Eloquent {

  protected $table    = 'master_product_rating';
  protected $guard    = ['id'];
  protected $fillable = ['prod_id', 'aecodeid' , 'rating_star', 'rating_subject', 'rating_comm'];
  protected $dates    = ['created_at', 'updated_at'];

  public function client_aecode()
  {
    return $this->belongsTo('client_aecode' , 'aecodeid');
  }
}
