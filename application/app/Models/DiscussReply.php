<?php
namespace App\Models;


use Illuminate\Database\Eloquent\Model as Eloquent;

class DiscussReply extends Eloquent {

  protected $table = 'product_discuss_reply';

  protected $fillable   = [
    'aecodeid', 'message', 'product_discuss_id'
  ];

  public function client_aecode()
  {
    return $this->belongsTo('client_aecode' , 'aecodeid');
  }

}
