<?php

session_start();
$skip_authentication = 1;
include("../includes/functions.php");
include_once("includes/wr_tools.php");
$lines = "a=1";
if ($mysql['crypt_key'] != '') {
    $crypt_key = $mysql['crypt_key'];
}
$var_to_pass = null;
$output = "false";
if ($_POST["register_birthday"]) {

    $dob = $_POST["register_birthday"]; //yyyy-mm-dd

    $date_regex = '/^(19|20)\d\d[\-\/.](0[1-9]|1[012])[\-\/.](0[1-9]|[12][0-9]|3[01])$/';

    if (!preg_match($date_regex, $dob)) {
        echo $output;
    } else {


        //tradeLog("Check_Birthday-16:" . $dob);
        $variabel = explode("-", $dob); //a=1&account=1234567

        $dob_year = $variabel[0];
        $dob_month = $variabel[1];
        $dob_day = $variabel[2];

        //tradeLog("Check_Birthday-22:" . $dob_day);
        //tradeLog("Check_Birthday-20:" . $dob . " = " . $dob_year . ";" . $dob_month . ";" . $dob_day); //1976/02/28//
        $doblengkap = $dob . " 00:00:00";
        //tradeLog("Check_Birthday-26:" . $doblengkap);
        //$birthday = new DateTime($doblengkap);
        //tradeLog("Check_Birthday-25:" . $dob . " = " . $birthday); //1976/02/28//

        $year = date("Y");
        $month = date("m");
        $day = date("d");
        //seconds in a day = 86400
        $days_in_between = (mktime(0, 0, 0, $month, $day, $year) - mktime(0, 0, 0, $dob_month, $dob_day, $dob_year)) / 86400;
        $age_float = $days_in_between / 365.242199; // Account for leap year
        $age = (int) ($age_float); // Remove decimal places without rounding up once number is + .5

        if ($age >= 17) {
            $output = "true";
        }
        //tradeLog("Check_Birthday-49:" . $age);
    }
}
//tradeLog("Check_Birthday-49:" . $age . " = " . $output);
echo $output;
exit;
function tradeLog($msg) {
    $fp = fopen("trader.log", "a");
    $logdate = date("Y-m-d H:i:s => ");
    $msg = preg_replace("/\s+/", " ", $msg);
    fwrite($fp, $logdate . $msg . "\n");
    fclose($fp);
    return;
}

?>