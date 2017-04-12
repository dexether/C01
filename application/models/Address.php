<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Illuminate\Database\Eloquent\Model as Eloquent;
class Address extends Eloquent
{
    protected $primaryKey = "address_id";
    protected $table = 'client_aecode_address';
}
