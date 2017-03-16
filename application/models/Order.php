<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Illuminate\Database\Eloquent\Model as Eloquent;
use Carbon\Carbon;
class Order extends Eloquent
{
    // protected $table = 'Orders';

    public function getExpiredAtAttribute($value)
    {
      return Carbon::parse($value)->formatLocalized('%A %d %B %Y Pukul %H:%M WIB');
    }
    public function getValidAttribute()
    {
      if($this->attributes['expired_at'] <= Carbon::now())
      return false;
      else
      return true;
    }
    public function getAmountAttribute($value)
    {
      return $this->attributes['unix'] + $value;
    }
    public function getAmountWithRpAttribute($value)
    {
      return "Rp. " . number_format($this->attributes['unix'] + $this->attributes['amount'], 0 , ',' , '.');
    }
    public function scopeNotPayed($query, $aecodeid)
    {
      return $query->where('paid', '=', false)->where('expired_at' , '>=', Carbon::now())->where('aecodeid' , $aecodeid);
    }
    public function client_aecode()
    {
      return $this->belongsTo('client_aecode' , 'aecodeid');
    }
    public function command()
    {
      return $this->belongsTo('cmd', 'cmd');
    }
}
