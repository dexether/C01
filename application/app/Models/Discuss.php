<?php
namespace App\Models;


use Illuminate\Database\Eloquent\Model as Eloquent;

class Discuss extends Eloquent {

  protected $table = 'product_discuss';

  protected $fillable   = [
    'aecodeid', 'message', 'is_active', 'product_id'
  ];

  public function client_aecode()
  {
    return $this->belongsTo('client_aecode' , 'aecodeid');
  }
  public function discuss_reply()
  {
    return $this->hasMany('App\Models\DiscussReply', 'product_discuss_id');
  }


}
