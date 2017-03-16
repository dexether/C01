<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Illuminate\Database\Eloquent\Model as Eloquent;
class Cmd extends Eloquent
{
    protected $table = 'master_cmd';
    protected $primaryKey = 'cmd';
}
