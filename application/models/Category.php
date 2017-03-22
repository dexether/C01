<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Illuminate\Database\Eloquent\Model as Eloquent;
class Category extends Eloquent
{
    protected $table = 'master_cat';
}
