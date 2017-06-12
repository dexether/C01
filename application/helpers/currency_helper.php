<?php

defined('BASEPATH') or exit('No direct script access allowed');

if (! function_exists('currency')) {

    function currency($input, $label = true)
    {
        $ci = & get_instance();
        $currency = 'Rp. ';
        $number = number_format($input);
        $number = $currency . $number;
        return $number;
    }
}
