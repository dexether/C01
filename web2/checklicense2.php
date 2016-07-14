<?php

include_once("$_SERVER[DOCUMENT_ROOT]/includes/functions.php");
include_once("$_SERVER[DOCUMENT_ROOT]/classes/Manager.class.php");
global $user;
global $template;

if (isset($user)) {
    $user;
}
$user = $_SESSION['user'];
if (strtoupper($user->username) == 'THEPROGRAMMER' || strtoupper($user->username) == 'SUPPORT') {
    //TradeLogCheckLicense("CheckLicense-Lanjut-13");
    $lanjut = "iya";
    $accountnya = $user->username;
    set_log_server($accountnya, "Update License Done");
    $_SESSION['page'] = 'checklicense';

    if (isset($_FILES["FileInput"]) && $_FILES["FileInput"]["error"] == UPLOAD_ERR_OK) {
        ############ Edit settings ##############
        $UploadDirectory = $_SERVER['DOCUMENT_ROOT'] . "/includes/";
        //$thefilename = $_FILES["FileInput"]["name"];
        //tradeLogCheckLicense("Upload_Investment2-23-TheFileName:".$UploadDirectory);      
        if (!is_dir($UploadDirectory)) {
            die("Directory " . $UploadDirectory . " is not there");
        } else {
            //tradeLogCheckLicense("Upload_Investment2-28-Folder Ada");
        }
        /*
          Note : You will run into errors or blank page if "memory_limit" or "upload_max_filesize" is set to low in "php.ini".
          Open "php.ini" file, and search for "memory_limit" or "upload_max_filesize" limit
          and set them adequately, also check "post_max_size".
         */

        //check if this is an ajax request
        if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
            die();
        }


        //Is file size is less than allowed size.
        if ($_FILES["FileInput"]["size"] > 5242880) {
            die("File size is too big!");
        }

        //allowed file type Server side check
        tradeLogCheckLicense("Upload_Investment2-47-TheFileName:" . strtolower($_FILES['FileInput']['type']));
        switch (strtolower($_FILES['FileInput']['type'])) {
            //allowed file types
            case 'application/x-httpd-php':
                break;
            case 'application/x-httpd-php-source':
                break;
            case 'application/octet-stream':
                break;
            default:
                die('Unsupported File!'); //output error
        }
        $File_Name = strtolower($_FILES['FileInput']['name']);
        $File_Ext = substr($File_Name, strrpos($File_Name, '.')); //get file extention
        $Random_Number = rand(0, 9999999999); //Random number to be added to name.
        //$NewFileName = $Random_Number . $File_Ext; //new file name
        $NewFileName = $File_Name; //new file name

        if (move_uploaded_file($_FILES['FileInput']['tmp_name'], $UploadDirectory . $NewFileName)) {
            //tradeLogCheckLicense("Upload_Investment.php-61:Product:" . $product . ";Thetitle:" . $thetitle);
            die('Success! File Uploaded.');
        } else {
            die('error uploading File!');
        }
    } else {
        die('Something wrong with upload! Is "upload_max_filesize" set correctly?');
    }
} else {
    $lanjut = "tidak";
    $accountnya = $user->username;
    $_SESSION['messagebox'] = "CheckLicense-72.You do not have permission to access this page.<br>If you feel this is an error, please contact the Administrator.";
    $_SESSION['alamat'] = "index.php";
    $keterangan = "CheckLicense-74.You do not have permission to access this page.<br>If you feel this is an error, please contact the Administrator.";
    set_log_server($accountnya, $keterangan);
    display_error($keterangan, "No Access");
}

function tradeLogCheckLicense($msg) {
    $fp = fopen("trader.log", "a");
    $logdate = date("Y-m-d H:i:s => ");
    $msg = preg_replace("/\s+/", " ", $msg);
    fwrite($fp, $logdate . $msg . "\n");
    fclose($fp);
    return;
}

?>