<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Illuminate\Database\Eloquent\Model as Eloquent;
class Users extends Eloquent
{
    protected $primaryKey = "id";
    protected $table = 'user';
    public $timestamps = false;
    
}
