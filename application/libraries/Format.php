<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
// include_once("$_SERVER[DOCUMENT_ROOT]/includes/functions.php");
// include_once("$_SERVER[DOCUMENT_ROOT]/classes/Manager.class.php");

class Format
{
    public function __construct()
    {

    }

    public function set_rp($number = 0)
    {
        $data = number_format($number);

        return "Rp. ". $data;
    }
}
