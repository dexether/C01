<?php
// tradeLog("Check_Agent_Code-2:");
session_start();
$skip_authentication = 1;
include("../includes/functions.php");
include_once("includes/wr_tools.php");
$output = "true";
if ($_POST["description2"]) {
    //$description1 = $_POST["description1"];
    $description2 = $_POST["description2"];
    $description2 = strtoupper($description2);
    //tradeLog("Check_Agent_Code-17-Desc1:" . $description1 . ";Description2:" . $description2);
    $output = "true";
    if ($description2 == 'admin@apexregent.com') {
        echo $output;
        // tradeLog("Check_Agent_Code-21 :". $output);
        exit;
    }

    $level01_3 = substr($description2, 0, 3);
    // tradeLog("Check_Agent_Code-25-Level01_3:" . $level01_3);
    if ($level01_3 != 'APR') {
        $output = "false";
        echo $output;
        // tradeLog("Check_Agent_Code-30 :". $output);
        exit;
    }

    $level02_1 = substr($description2, 3, 1);
    //tradeLog("Check_Agent_Code-27 :" . $level02_1);
    if ($level02_1 == 'P' || $level02_1 == 'B' || $level02_1 == 'R') {
        
    } else {
        $output = "false";
        echo $output;
        // tradeLog("Check_Agent_Code-41 :". $output);
        exit;
    }

    $level03_strip = substr($description2, 4, 1);
    //tradeLog("Check_Agent_Code-27 :" . $level03_strip);
    if ($level03_strip != '-') {
        $output = "false";
        echo $output;
        // tradeLog("Check_Agent_Code-50 :". $output);
        exit;
    }

    $level04_number = substr($description2, 5, 1);
    //tradeLog("Check_Agent_Code-46 :" . $level04_number);
    $thenumeric = get_numeric($level04_number);
    //tradeLog("Check_Agent_Code-48 :" . $thenumeric);
    if ($thenumeric > 0) {
        
    } else {
        $output = "false";
        echo $output;
        // tradeLog("Check_Agent_Code-63 :". $output);
        exit;
    }

    $level05_AZ = substr($description2, 6, 1);
    //tradeLog("Check_Agent_Code-59 :" . $level05_AZ);
    if (preg_match('/^[a-zA-Z]/', $level05_AZ)) { /*   "/i" means case independent */
        //tradeLog("Check_Agent_Code-61 ok");
    } else {
        $output = "false";
        echo $output;
        exit;
    }

    $level06_Strip2a = explode("-", $description2);
    $level06_Strip2b = $level06_Strip2a[1];
    //tradeLog("Check_Agent_Code-70 :" . $level06_Strip2b); //3A1
    $level06_Strip2c_len = strlen($level06_Strip2b);
    $level06_Strip2d = substr($level06_Strip2b, 2, $level06_Strip2c_len);
    //tradeLog("Check_Agent_Code-73 :" . $level06_Strip2d); //3A1
    $thenumeric = get_numeric($level06_Strip2d);
    if ($thenumeric > 0 && $thenumeric < 1000) {
        
    } else {
        $output = "false";
        echo $output;
        exit;
    }

    $level07_0_9999 = $level06_Strip2a[2]; //1005
    //tradeLog("Check_Agent_Code-83 :" . $level07_0_9999); //
    $thenumeric = get_numericnol($level07_0_9999);
    //tradeLog("Check_Agent_Code-91 :" . $thenumeric); //
    if ($thenumeric > -1 && $thenumeric < 10000) {
        
    } else {
        $output = "false";
        echo $output;
        exit;
    }
    //tradeLog("Check_Agent_Code-93 :" . $level07_0_9999); //



    /*
      $query2 = "SELECT * FROM client_aecode WHERE aecode = '$username'";
      //tradeLog("Check_Afiliasi_Account-24:" . $query);
      $result2 = $DB->query($query2);
      while ($row = $DB->fetch_array($result2)) {
      $output = "true";
      }
     */
    //tradeLog("Check_Afiliasi_Account-32:" . $output);
}
// $output = "false";
echo $output;
// tradeLog("Check_Agent_Code-114 : " . $output);
function get_numeric($val) {
    if (is_numeric($val)) {
        if ($val > 0) {
            return $val + 0;
        } else {
            return false;
        }//if ($val > 0) {
    }// if (is_numeric($val)) {
    return false;
}

function get_numericnol($val) {
    if (is_numeric($val)) {
        if ($val > -1) {
            return $val + 0;
        } else {
            return false;
        }//if ($val > 0) {
    }// if (is_numeric($val)) {
    return false;
}

function tradeLog($msg) {
    $fp = fopen("trader3.log", "a");
    $logdate = date("Y-m-d H:i:s => ");
    $msg = preg_replace("/\s+/", " ", $msg);
    fwrite($fp, $logdate . $msg . "\n");
    fclose($fp);
    return;
}

?>