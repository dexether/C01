<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
// include_once("$_SERVER[DOCUMENT_ROOT]/includes/functions.php");
// include_once("$_SERVER[DOCUMENT_ROOT]/classes/Manager.class.php");

class Format
{
    public function seoUrl($string)
    {
        //Lower case everything
        $string = strtolower($string);
        //Make alphanumeric (removes all other characters)
        $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
        //Clean up multiple dashes or whitespaces
        $string = preg_replace("/[\s-]+/", " ", $string);
        //Convert whitespaces and underscore to dash
        $string = preg_replace("/[\s_]/", "-", $string);
        return $string;
    }
    public function getFirstNameWithEs($name){
      // var_dump($name);
        if($name != NULL):
        $pecah = explode(" ", $name);
        if (count($pecah > 0)) {
            # code...

            return array_shift($pecah)."'s";
        }else{
            return NULL;
        }
      else:
        return NULL;
      endif;
    }
    public function url_dash($string)
    {
        // Lower case everything
        $string = strtolower($string);
        $string = preg_replace("/[^a-z0-9._\s-]/", "-", $string);
        $string = preg_replace("/[\s_]/", "-", $string);
        return $string;
    }
    public function rating($star)
    {
      $html = "";
      for ($i= 1; $i < 6; $i++) {
        if ($star >= $i):
          $html .= '<i class="fa fa-star"></i>'."\n";
        elseif($i - $star == 0.5):
          $html .= '<i class="fa fa-star-half-o"></i>'."\n";
        else:
          $html .= '<i class="fa fa-star-o"></i>'."\n";
        endif;
      }
      return $html;
    }
    public function clean_html($str)
    {
        $t = preg_replace('/<[^<|>]+?>/', '', htmlspecialchars_decode($str));
        $t = htmlentities($t, ENT_QUOTES, "UTF-8");
        return $t;
    }
}
