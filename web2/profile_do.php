<?php
include_once("$_SERVER[DOCUMENT_ROOT]/includes/functions.php");
include_once("$_SERVER[DOCUMENT_ROOT]/classes/Manager.class.php");
require_once("$_SERVER[DOCUMENT_ROOT]/classes/security.csrf.php");
include_once("includes/wr_tools.php");
$var_to_pass = null;
global $user;
global $template;
global $themonth;
global $mysql;
global $DB;
$security = new \security\CSRF;
$error = "success";
$errno = 0;
$subject = "Success !";
$msg = "Your request has been complete";
if (isset($user)) {
    $user;
}
$user = $_SESSION['user'];
$template->assign("user", $user);

//TradeLogUnderConstruct_Secure("Profile-175-Get_PostMode:" . $_POST[postmode]);
$postmode = '';
if (isset($_POST['postmode'])) {
    $postmode = $_POST['postmode'];
}
$identity = "";
if (isset($_POST['identity'])) {
    $identity = $_POST['identity'];
}
$name = "";
if (isset($_POST['name'])) {
    $name = $_POST['name'];
}
$taxid = "";
if (isset($_POST['taxid'])) {
    $taxid = $_POST['taxid'];
}
$mothername = "";
if (isset($_POST['mothername'])) {
    $mothername = $_POST['mothername'];
}
$gender = "";
if (isset($_POST['gender'])) {
    $gender = $_POST['gender'];
}
$martial = "";
if (isset($_POST['martial'])) {
    $martial = $_POST['martial'];
}
$address = "";
if (isset($_POST['address'])) {
    $address = $_POST['address'];
}
$phoneNumberHome = "";
if (isset($_POST['phoneNumberHome'])) {
    $phoneNumberHome = $_POST['phoneNumberHome'];
}
$phoneNumberFax = "";
if (isset($_POST['phoneNumberFax'])) {
    $phoneNumberFax = $_POST['phoneNumberFax'];
}
$phoneNumber = "";
if (isset($_POST['phoneNumber'])) {
    $phoneNumber = $_POST['phoneNumber'];
}
$token = "";
if (isset($_POST['token'])) {
    $token = $_POST['token'];
}
$aecodeid = "";
if (isset($_POST['aecodeid'])) {
    $aecodeid = $_POST['aecodeid'];
}
$register_birthday = "";
if (isset($_POST['register_birthday'])) {
    $register_birthday = $_POST['register_birthday'];
}
$accountname = "";
if (isset($_POST['accountname'])) {
    $accountname = $_POST['accountname'];
}
$accountnumber = "";
if (isset($_POST['accountnumber'])) {
    $accountnumber = $_POST['accountnumber'];
}
$bankname = "";
if (isset($_POST['bankname'])) {
    $bankname = $_POST['bankname'];
}
$country = "";
if (isset($_POST['country'])) {
    $country = $_POST['country'];
}
$currency = "";
if (isset($_POST['currency'])) {
    $currency = $_POST['currency'];
}
$password = "";
if (isset($_POST['password'])) {
    $password = md5($_POST['password']);
}
if ($postmode == 'bank') {
    $query = "SELECT * FROM user WHERE username = '$user->username' AND password = '$password'";
    $result = $DB->execresultset($query);
    if (count($result) >= 1) {
        $errno = 0;
    }else{
        $error = "error";
        $errno = 1;
        $subject = "Error !";
        $msg = "The password you have entered is Wrong, Please try again !";
    }
}
// tradeLogProfile("Profile-85 :" . $aecodeid);
/*==============================
=            coding            =
==============================*/
if ($errno == 0) {
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        if($security->get($token)) {
          $security->delete($token);
          // Insert
          if($postmode != 'upload' && $postmode != 'bank') {
            // tradeLogProfile("Profile-85 :" . $postmode);
            $query = "UPDATE client_aecode SET
            identity = '$identity',
            name = '$name',
            taxid = '$taxid',
            mothername = '$mothername',
            gender = '$gender',
            martial = '$martial',
            address = '$address',
            telephone_home = '$phoneNumberHome',
            telephone_fax = '$phoneNumberFax',
            telephone_mobile = '$phoneNumber',
            bod = '$register_birthday'
            WHERE aecodeid = '$aecodeid';
            ";
            $DB->execonly($query);
      			$query = "UPDATE todo_list SET
      				finished = '1'
      				WHERE aecodeid = '$aecodeid' AND id_todo = '1'";
			      $DB->execonly($query);
          }
          if ($postmode == 'bank') {
              $query = "UPDATE client_aecode_bank SET
              banktype = '$bankname',
              tipe_akun = '$currency',
              aeaccountname = '$accountname',
              aeaccountnumber = '$accountnumber',
              status = '1',
              last_updated = NOW(),
              country = '$country'
              WHERE aecode = '$user->username'
              ";
              $DB->execonly($query);
          }
		  if ($postmode == 'forex') {
              $query = "UPDATE client_aecode SET
              banktype = '$bankname',
              tipe_akun = '$currency',
              aeaccountname = '$accountname',
              aeaccountnumber = '$accountnumber',
              pengalaman = '$pengalaman',
        			tujuan = '$tujuan',
        			keluarga_di_bappebti = '$keluarga_di_bappebti',
        			pailit = '$pailit',
        			penghasilan = '$penghasilan',
        			pekerjaan = '$pekerjaan',
        			darurat_name = '$darurat_name',
        			darurat_alamat = '$darurat_alamat',
        			darurat_telephone = '$darurat_telephone',
        			darurat_hubungan = '$darurat_hubungan'
            WHERE aecodeid = '$aecodeid';
              ";
              $DB->execonly($query);
          }
          if (isset($_POST['thumb' . '_values'])) {
            $thumbfile = $_POST['thumb' . '_values'];
            // tradeLogProfile("Profile-101-ThumbFile:" . $thumbfile);
            $thumbfile1 = stripslashes($thumbfile);
            $json = json_decode($thumbfile1);
            // tradeLogProfile("Profile-104 :" . $json);
            $tmp = explode(',', $json->data);
            $imgdata = base64_decode($tmp[1]);
            //tradeLogProfile("Profile-222-count(imgdata):" . count($imgdata));
            $extension1 = explode('.', $json->name);
            $extension2 = end($extension1);
            $extension = strtolower($extension2);
            //tradeLogProfile("Profile-127-count(imgdata):" .$extension);
            //$fname = 'imagenya' . '.' . $extension;
            $fname = substr($json->name, 0, -(strlen($extension) + 1)) . '.' . $extension;
            // $fname = "profile_".$user->username.".".$extension;
            $serverdir = "images/data/profile/";
            // TradeLogUnderConstruct_Secure("Profile-227-Filenya:" . $fname);
            if ($fname != ".") {
                //tradeLogProfile("Profile-230-ImageData:" . $imgdata);
                $waktucheck1 = date('ymd', strtotime('-1 hour'));
                $waktucheck2 = date('His', strtotime('-1 hour'));
                $fname = "profile_".$aecodeid.".".$extension;

                $theaddress = $serverdir . $fname;
                $query = "UPDATE client_aecode SET foto = '$theaddress' WHERE aecodeid = '$aecodeid'";
                $DB->execonly($query);
                // tradeLogProfile("Profile-123 " . $theaddress);

                //tradeLogProfile("Profile-237-Rotate:".$rotation.";Theaddress:" . $theaddress);
                $handle = fopen($theaddress, 'w');
                //tradeLogProfile("Profile-218-ImageData");
                fwrite($handle, $imgdata);
                //tradeLogProfile("Profile-219");
                fclose($handle);
                //tradeLogProfile("Profile-244");
                /*$file = imagecreatefromjpeg($theaddress); //http://nz2.php.net/manual/en/function.imagecreatefromjpeg.php
                $rotim = imagerotate($file, $rotation, 0);   //http://nz2.php.net/manual/en/function.imagerotate.php
                imagejpeg($rotim, $theaddress); //http://nz2.php.net/manual/en/function.imagejpeg.php
                imagedestroy($file);
                imagedestroy($rotim);*/
            }
        }
          $error = "success";
          $subject = "Succes";
          $msg = "Your request Success";
      } else {
      // echo 'Ga Valid.'; // invalid
          $error = "error";
          $subject = "Oops, Something was happened";
          $msg = "Try refresing the web page";
      }

  }
}

$response = array('status' => $error, 'subject' => $subject, 'msg' => $msg);
// header("Content-Type: application/json;charset=utf-8");
echo json_encode($response);

/*=====  End of coding  ======*/





function myfilter($input_var_outer, $param) {
    global $var_to_pass;
    $var_to_pass = $param;

    function mycallback($input_var_inner) {
        global $var_to_pass;
        return ($input_var_inner == $var_to_pass) ? true : false;
    }

    $return_arr = array_filter($input_var_outer, 'mycallback');
    $return_arr = array_merge(array(), $return_arr);
    return $return_arr;
}

function tradeLogProfile($msg) {
    $fp = fopen("trader.log", "a");
    $logdate = date("Y-m-d H:i:s => ");
    $msg = preg_replace("/\s+/", " ", $msg);
    fwrite($fp, $logdate . $msg . "\n");
    fclose($fp);
    return;
}


?>
