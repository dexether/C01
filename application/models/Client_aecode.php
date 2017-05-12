<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Illuminate\Database\Eloquent\Model as Eloquent;
class Client_aecode extends Eloquent
{
    protected $table = 'client_aecode';
    protected $primaryKey = "aecodeid";
    const CREATED_AT = 'last_updated';
    const UPDATED_AT = 'last_updated';
}
