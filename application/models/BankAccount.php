<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once "Bank.php";
use Illuminate\Database\Eloquent\Model as Eloquent;
class BankAccount extends Eloquent
{
    protected $table = 'client_aecode_bank';
    protected $fillable = ['bank_id', 'aeaccountname' , 'aeaccountnumber', 'aecodeid' , 'aecode'];
    public function bank()
    {
      return $this->belongsTo('bank');
    }
}
