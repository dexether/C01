<?php

include_once("$_SERVER[DOCUMENT_ROOT]/includes/functions.php");
include_once("$_SERVER[DOCUMENT_ROOT]/classes/Manager.class.php");
require_once("$_SERVER[DOCUMENT_ROOT]/classes/security.csrf.php");
$var_to_pass = null;
global $user;
global $template;
global $themonth;
global $mysql;
global $DB;
global $aecodeid;
$security = new \security\CSRF;
$token = $security->set(6, 3600);
$template->assign("token", $token);
if (isset($user)) {
    $user;
}
$user = $_SESSION['user'];
include_once("$_SERVER[DOCUMENT_ROOT]/classes/FetchAccount.class.php");
$theFetchAccount = new theOtherFetchAccounts();
$cabang_admin = 'semua';
$accounts = $theFetchAccount->fetchAccountslangsung($user, $mysql['meta'], $cabang_admin);

$_SESSION['page'] = 'profile';
$query = "SELECT aecodeid FROM client_aecode WHERE aecode = '$user->username'";
$aecodeid = $DB->execresultset($query);

$query = "SELECT * FROM client_aecode WHERE aecode = '$user->username'";
//tradeLogProfile("Profile-20-Query:".$query);
$rows = $DB->execresultset($query);
$allpersonaldata = array();
foreach ($rows as $key => $row) {
    $allpersonaldata = $row;    
}
$template->assign("alldatas", $allpersonaldata);
//tradeLogProfile("Profile-36");

$direpalce0 = $user->username;
$direpalce1 = str_replace("@", "_", $direpalce0);
$direpalce2 = str_replace(".", "__", $direpalce1);
$dir = "C:/Project/FileUpload/fileupload_foto/" . $direpalce2 . "/";
//tradeLogProfile("Profile-141-Dir:" . $dir);
$file_display = array('jpg', 'jpeg', 'png', 'gif');

function listFolderFiles($dir2, $file_display) {
    global $account;
    //tradeLogProfile("Profile-142-Dir:" . $dir2);
    $urlnya2 = "none";
    if (is_dir($dir2)) {
        //tradeLogProfile("Profile-146");
        $ffs = scandir($dir2);
        //tradeLogProfile("Profile-148-Count:" . count($ffs));
        foreach ($ffs as $ff) {
            if ($ff != '.' && $ff != '..') {
                $haiya = explode('.', $ff);
                $file_type = strtolower(end($haiya));
                //echo '&nbsp;&nbsp;&nbsp; FileType :' . $file_type;
                //tradeLogProfile("Profile-153-FileType:" . $file_type);
                if ($ff !== '.' && $ff !== '..' && in_array($file_type, $file_display) == true) {
                    $imgPath = $dir2 . "/" . $ff;
                    //tradeLogProfile("Profile-155:" . $imgPath);
                    $content = file_get_contents($imgPath);
                    $imgData = base64_encode($content);
                    $urlnya2 = "<img src='data:image/jpeg;base64, $imgData' alt='$account' class='img-circle profile-avatar' style='width:220px;height:220px;' />";
                }
            }
        }//foreach ($ffs as $ff) { 
    }//if (is_dir($dir2)) {
    //tradeLogProfile("Profile-164-Urlnya:" . $urlnya2);
    return $urlnya2;
}

$query = "SELECT * FROM client_aecode_bank WHERE aecode = '$user->username'";
$result = $DB->execresultset($query);
$bankdata = array();
foreach($result as $rows){
    $bankdata = $rows;
}
// var_dump($bankdata);
$template->assign("bankdata", $bankdata);
//tradeLogProfile("Profile-76-Get_PostMode:" . $_GET[postmode]);
$postmode = '';
if (isset($_GET['postmode'])) {
    $postmode = $_GET['postmode'];
}

if ($postmode != '') {
    //tradeLogProfile("Profile-83-PostMode:" . $postmode);
    $aecode = '';
    if (isset($_POST['aecode'])) {
        $aecode = anti_injection($_POST['aecode']);
    }
    if ($postmode == "updateprofilenya" && $aecode != '') {
        $telephone_home = '';
        if (isset($_POST['telephone_home'])) {
            $telephone_home = anti_injection($_POST['telephone_home']);
        }

        $telephone_fax = '';
        if (isset($_POST['telephone_fax'])) {
            $telephone_fax = anti_injection($_POST['telephone_fax']);
        }

        $telephone_mobile = '';
        if (isset($_POST['telephone_mobile'])) {
            $telephone_mobile = anti_injection($_POST['telephone_mobile']);
        }

        $telephone_office = '';
        if (isset($_POST['telephone_office'])) {
            $telephone_office = anti_injection($_POST['telephone_office']);
        }
		
		$pekerjaan = '';
        if (isset($_POST['job'])) {
            $pekerjaan = anti_injection($_POST['job']);
        }
		
        $address = '';
        if (isset($_POST['address'])) {
            $address = anti_injection($_POST['address']);
        }

        $nationality = '';
        if (isset($_POST['nationality'])) {
            $nationality = anti_injection($_POST['nationality']);
            //tradeLogProfile("Profile-119-Nationality:" . $nationality);
        }
		
        $bod = '';
        if (isset($_POST['register_birthday'])) {
            $bod = anti_injection($_POST['register_birthday']);
        }
		
        $no_identitas = '';
        if (isset($_POST['no_identitas'])) {
            $no_identitas = anti_injection($_POST['no_identitas']);
        }

        $rotation = '';
        if (isset($_POST['rotation'])) {
            $rotation = anti_injection($_POST['rotation']);
        }

        $query = "UPDATE client_aecode SET 
                telephone_home = '$telephone_home',
                telephone_mobile = '$telephone_mobile', 
                telephone_office = '$telephone_office',
                address = '$address',  
                nationality = '$nationality',   
                bod = '$bod',
				pengalaman = '$pengalaman',
				tujuan = '$tujuan',
				penghasilan = '$penghasilan',
				pekerjaan = '$pekerjaan',
                no_identitas = '$no_identitas',    
                telephone_fax = '$telephone_fax'    
                WHERE aecode = '$aecode'";
        //tradeLogProfile("Profile-108:" . $query);
        $DB->execonly($query);
		$query = "UPDATE todo_list SET
				finished = '1'
				WHERE aecodeid = '$aecodeid' AND id_todo = '1'";
		$DB->execonly($query);
        if (!is_dir($dir)) {
            mkdir($dir);
        }

        $error = false;
        $absolutedir = dirname(__FILE__);
        $serverdir = $dir;
        //tradeLogProfile("Profile-204:" . $serverdir);
        $filename = array();
        $thumbfile = '';
        if (isset($_POST['thumb' . '_values'])) {
            $thumbfile = $_POST['thumb' . '_values'];
            //tradeLogProfile("Profile-122-ThumbFile:" . $thumbfile);
            $thumbfile1 = stripslashes($thumbfile);
            $json = json_decode($thumbfile1);
            $tmp = explode(',', $json->data);
            $imgdata = base64_decode($tmp[1]);
            //tradeLogProfile("Profile-222-count(imgdata):" . count($imgdata));
            $extension1 = explode('.', $json->name);
            $extension2 = end($extension1);
            $extension = strtolower($extension2);
            //tradeLogProfile("Profile-127-count(imgdata):" .$extension);
            //$fname = 'imagenya' . '.' . $extension;
            $fname = substr($json->name, 0, -(strlen($extension) + 1)) . '.' . $extension;

            //tradeLogProfile("Profile-227-Filenya:" . $fname);
            if ($fname != ".") {
                //tradeLogProfile("Profile-230-ImageData:" . $imgdata);
                $waktucheck1 = date('ymd', strtotime('-1 hour'));
                $waktucheck2 = date('His', strtotime('-1 hour'));
                $fname = $waktucheck1.$waktucheck2.".".$extension;

                $theaddress = $serverdir . $fname;
                //tradeLogProfile("Profile-181-Rotate:".$rotation.";Theaddress:" . $theaddress);
                if ($rotation == 90) {
                    $rotation = 270;
                } elseif ($rotation == 270) {
                    $rotation = 90;
                }
                //tradeLogProfile("Profile-237-Rotate:".$rotation.";Theaddress:" . $theaddress);
                $handle = fopen($theaddress, 'w');
                //tradeLogProfile("Profile-218-ImageData");
                fwrite($handle, $imgdata);
                //tradeLogProfile("Profile-219");
                fclose($handle);
                //tradeLogProfile("Profile-244");
                $file = imagecreatefromjpeg($theaddress); //http://nz2.php.net/manual/en/function.imagecreatefromjpeg.php
                $rotim = imagerotate($file, $rotation, 0);   //http://nz2.php.net/manual/en/function.imagerotate.php      
                imagejpeg($rotim, $theaddress); //http://nz2.php.net/manual/en/function.imagejpeg.php
                imagedestroy($file);
                imagedestroy($rotim);
            }
        }
        echo 0;
        exit;
    } else {
        echo "Debugging-160";
        exit;
    }
}

$query = "SELECT * FROM client_document WHERE aecodeid = '$allpersonaldata[aecodeid]'";
$result = $DB->execresultset($query);
$template->assign('userdoc', $result);
//tradeLogProfile("Profile-158");


/* Bank List */
$query = "SELECT id, bank_name FROM master_bank ORDER BY bank_name ASC";
$result = $DB->execresultset($query);
$template->assign('bank_list', $result);

function tradeLogProfile($msg) {
    $fp = fopen("trader.log", "a");
    $logdate = date("Y-m-d H:i:s => ");
    $msg = preg_replace("/\s+/", " ", $msg);
    fwrite($fp, $logdate . $msg . "\n");
    fclose($fp);
    return;
}

$template->assign("user", $user);

$template->display("profile.htm");
?>